<?php
namespace App\Imports;

use App\Models\User;
use App\Models\UserDetail;
use Maatwebsite\Excel\Row;
use Illuminate\Support\Str;
use App\Models\EmployeeType;
use App\Models\CompanyBranch;
use App\Models\EmployeeStatus;
use App\Models\UserActiveLocation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Log;

class UserImport implements
    ToCollection,
    WithHeadingRow,
    WithValidation,
    SkipsOnFailure,
    WithChunkReading,
    WithBatchInserts
{
    use SkipsFailures;

    public $count = 0;
    protected $failures = [];
    protected $skippedRows = [];
    protected $companyId;
    protected $userId;
    protected $branchCache = [];
    protected $coordinatesCache = [];
    protected $existingUsers = [];
    protected $processedInCurrentBatch = [];
    protected $currentRowIndex = 0;

    // Pre-load data to avoid repeated queries
    protected $genderMap = [
        'male' => 'M',
        'female' => 'F',
        'other' => 'O',
    ];

    public function __construct()
    {
        // Set execution time limit
        set_time_limit(300); // 5 minutes
        ini_set('memory_limit', '512M');

        // Cache company and user ID to avoid repeated auth() calls
        $this->companyId = auth()->user()->company_id;
        $this->userId = auth()->user()->id;

        // Pre-load all company branches and existing users
        $this->preloadBranches();
        $this->preloadExistingUsers();
    }

    protected function preloadBranches()
    {
        $branches = CompanyBranch::where('company_id', $this->companyId)
            ->select('id', 'name', 'address')
            ->get();

        foreach ($branches as $branch) {
            $this->branchCache[strtolower(trim($branch->name))] = $branch;
        }
    }

    protected function preloadExistingUsers()
    {
        // Get all existing emails and emp_ids in one query
        $existingEmails = User::managerFilter()->where('company_id', $this->companyId)
            ->pluck('email')
            ->mapWithKeys(function ($email) {
                return [strtolower(trim($email)) => true];
            })
            ->toArray();

        $existingEmpIds = UserDetail::whereHas('user', function ($query) {
                $query->where('company_id', $this->companyId);
            })
            ->pluck('emp_id')
            ->mapWithKeys(function ($empId) {
                return [strtolower(trim($empId)) => true];
            })
            ->toArray();

        $this->existingUsers = [
            'emails' => $existingEmails,
            'emp_ids' => $existingEmpIds
        ];
    }

    public function collection(Collection $rows)
    {
        // Reset batch-specific tracking
        $this->processedInCurrentBatch = ['emails' => [], 'emp_ids' => []];

        // Filter valid rows first
        $validRows = $this->filterValidRows($rows);

        if (empty($validRows)) {
            return;
        }

        // Prepare batch data arrays
        $users = [];
        $userDetails = [];
        $userActiveLocations = [];

                    foreach ($validRows as $index => $row) {
            try {
                $branch = $this->getBranch($row['company_branch']);
                if (!$branch) {
                    $this->addSkippedRow($index, $row, "Branch '{$row['company_branch']}' not found");
                    continue;
                }

                // Validate dates
                $dateOfBirth = $this->parseDate($row['date_of_birth']);
                $joiningDate = $this->parseDate($row['joining_date']);

                if (!$dateOfBirth) {
                    $this->addSkippedRow($index, $row, "Invalid date of birth format");
                    continue;
                }

                if (!$joiningDate) {
                    $this->addSkippedRow($index, $row, "Invalid joining date format");
                    continue;
                }

                // Generate unique temporary ID for batch relationships
                $tempUserId = 'temp_' . uniqid();

                // Prepare user data
                $users[] = [
                    'temp_id' => $tempUserId,
                    'name' => trim($row['name']),
                    'email' => trim($row['email']),
                    'password' => Hash::make(trim($row['password'] ?? 'password')),
                    'company_id' => $this->companyId,
                    'created_by' => $this->userId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Prepare user details data
                $userDetails[] = [
                    'temp_user_id' => $tempUserId,
                    'emp_id' => trim($row['emp_id']),
                    'official_email_id' => trim($row['official_email_id'] ?? ''),
                    'phone' => trim($row['phone'] ?? ''),
                    'date_of_birth' => $dateOfBirth,
                    'joining_date' => $joiningDate,
                    'father_name' => trim($row['father_name'] ?? ''),
                    'mother_name' => trim($row['mother_name'] ?? ''),
                    'gender' => $this->genderMap[strtolower(trim($row['gender']))] ?? 'O',
                    'blood_group' => 'N/A',
                    'marital_status' => 'N/A',
                    'last_login_ip' => request()->ip(),
                    'employee_type_id' => EmployeeType::NEWJOINEE,
                    'employee_status_id' => EmployeeStatus::CURRENT,
                    'company_branch_id' => $branch->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Prepare user active location data (skip geocoding for performance)
                $userActiveLocations[] = [
                    'temp_user_id' => $tempUserId,
                    'address' => $branch->address,
                    'latitude' => 0, // Default coordinates
                    'longitude' => 0, // Default coordinates
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $this->count++;

            } catch (\Exception $e) {
                $this->addSkippedRow($index, $row, "Processing error: " . $e->getMessage());
                Log::error("Error processing row {$index}: " . $e->getMessage(), ['row_data' => $row]);
                continue;
            }
        }

        // Batch insert all data
        if (!empty($users)) {
            $this->batchInsertUsers($users, $userDetails, $userActiveLocations);
        }
    }

    protected function filterValidRows(Collection $rows)
    {
        $validRows = [];

        foreach ($rows as $index => $row) {
            $this->currentRowIndex = $index + 2; // +2 because Excel starts at 1 and we have headers

            $email = strtolower(trim($row['email'] ?? ''));
            $empId = strtolower(trim($row['emp_id'] ?? ''));
            $name = trim($row['name'] ?? '');
            $branch = trim($row['company_branch'] ?? '');

            // Skip if empty required fields
            if (empty($email)) {
                $this->addSkippedRow($index, $row, 'Missing email address');
                continue;
            }

            if (empty($empId)) {
                $this->addSkippedRow($index, $row, 'Missing employee ID');
                continue;
            }

            if (empty($name)) {
                $this->addSkippedRow($index, $row, 'Missing employee name');
                continue;
            }

            if (empty($branch)) {
                $this->addSkippedRow($index, $row, 'Missing company branch');
                continue;
            }

            // Skip if already exists in database
            if (isset($this->existingUsers['emails'][$email])) {
                // $this->addSkippedRow($index, $row, 'Email already exists in database');
                continue;
            }

            if (isset($this->existingUsers['emp_ids'][$empId])) {
                // $this->addSkippedRow($index, $row, 'Employee ID already exists in database');
                continue;
            }

            // Skip if already processed in current batch
            if (isset($this->processedInCurrentBatch['emails'][$email])) {
                // $this->addSkippedRow($index, $row, 'Duplicate email in current import file');
                continue;
            }

            if (isset($this->processedInCurrentBatch['emp_ids'][$empId])) {
                // $this->addSkippedRow($index, $row, 'Duplicate employee ID in current import file');
                continue;
            }

            // Check if branch exists
            if (!$this->getBranch($branch)) {
                $this->addSkippedRow($index, $row, "Branch '{$branch}' not found");
                continue;
            }

            // Mark as processed in current batch
            $this->processedInCurrentBatch['emails'][$email] = true;
            $this->processedInCurrentBatch['emp_ids'][$empId] = true;

            $validRows[$index] = $row;
        }

        return $validRows;
    }

    protected function addSkippedRow($index, $row, $reason)
    {
        $this->skippedRows[] = [
            'row_number' => $index + 2, // +2 because Excel starts at 1 and we have headers
            'emp_id' => $row['emp_id'] ?? 'N/A',
            'name' => $row['name'] ?? 'N/A',
            'email' => $row['email'] ?? 'N/A',
            'company_branch' => $row['company_branch'] ?? 'N/A',
            'reason' => $reason,
            'data' => $row // Store full row data for reference
        ];

        Log::info("Skipped row {$this->currentRowIndex}: {$reason}", [
            'emp_id' => $row['emp_id'] ?? 'N/A',
            'email' => $row['email'] ?? 'N/A'
        ]);
    }

    protected function batchInsertUsers($users, $userDetails, $userActiveLocations)
    {
        DB::beginTransaction();
        try {
            // Disable foreign key checks temporarily for better performance
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            // Insert users without temp_id
            $usersForInsert = collect($users)->map(function ($user) {
                unset($user['temp_id']);
                return $user;
            })->toArray();

            // Use insertOrIgnore to handle any potential duplicates gracefully
            DB::table('users')->insertOrIgnore($usersForInsert);

            // Get the inserted users with their IDs using a more efficient query
            $emails = collect($users)->pluck('email')->toArray();
            $insertedUsers = DB::table('users')
                ->whereIn('email', $emails)
                ->where('company_id', $this->companyId)
                ->select('id', 'email')
                ->get()
                ->keyBy('email');

            // Map temp IDs to real IDs
            $tempToRealId = [];
            foreach ($users as $user) {
                $realUser = $insertedUsers->get($user['email']);
                if ($realUser) {
                    $tempToRealId[$user['temp_id']] = $realUser->id;
                }
            }

            // Insert user details
            $userDetailsForInsert = [];
            foreach ($userDetails as $detail) {
                if (isset($tempToRealId[$detail['temp_user_id']])) {
                    $realUserId = $tempToRealId[$detail['temp_user_id']];
                    unset($detail['temp_user_id']);
                    $detail['user_id'] = $realUserId;
                    $userDetailsForInsert[] = $detail;
                }
            }

            if (!empty($userDetailsForInsert)) {
                DB::table('user_details')->insertOrIgnore($userDetailsForInsert);
            }

            // Insert user active locations
            $locationsForInsert = [];
            foreach ($userActiveLocations as $location) {
                if (isset($tempToRealId[$location['temp_user_id']])) {
                    $realUserId = $tempToRealId[$location['temp_user_id']];
                    unset($location['temp_user_id']);
                    $location['user_id'] = $realUserId;
                    $locationsForInsert[] = $location;
                }
            }

            if (!empty($locationsForInsert)) {
                DB::table('user_active_locations')->insertOrIgnore($locationsForInsert);
            }

            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

             DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            Log::error("Batch insert failed: " . $e->getMessage());
            throw $e;
        }
    }

    protected function getBranch($branchName)
    {
        $key = strtolower(trim($branchName));
        return $this->branchCache[$key] ?? null;
    }

    // Removed geocoding for performance - can be done asynchronously later
    protected function getCoordinates($branch)
    {
        return ['latitude' => 0, 'longitude' => 0];
    }

    protected function parseDate($dateString)
    {
        if (empty($dateString)) {
            return null;
        }

        try {
            // Handle common date formats more efficiently
            if (is_numeric($dateString)) {
                // Excel date serial number
                return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateString)->format('Y-m-d');
            }

            return date('Y-m-d', strtotime($dateString));
        } catch (\Exception $e) {
            Log::warning("Date parsing failed for: {$dateString}");
            return null;
        }
    }

    public function rules(): array
    {
        return [
            // 'name' => 'required|string|max:255',
            // 'emp_id' => 'required',
            // 'email' => 'required|email',
            // 'official_email_id' => 'nullable|email',
            // 'father_name' => 'nullable|string|max:255',
            // 'mother_name' => 'nullable|string|max:255',
            // 'gender' => 'required',
            // 'phone' => 'nullable',
            // 'date_of_birth' => 'required',
            // 'joining_date' => 'required',
            // 'company_branch' => 'required|string',
        ];
    }

    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $failure) {
            $this->failures[] = [
                'row' => $failure->row(),
                'attribute' => $failure->attribute(),
                'errors' => $failure->errors(),
                'values' => $failure->values() // Include the actual row values
            ];

            // Also log validation failures
            Log::warning("Validation failed for row {$failure->row()}", [
                'attribute' => $failure->attribute(),
                'errors' => $failure->errors(),
                'values' => $failure->values()
            ]);
        }
    }

    public function getFailures()
    {
        return $this->failures;
    }

    public function getSkippedRows()
    {
        return $this->skippedRows;
    }

    public function getImportSummary()
    {
        return [
            'total_processed' => $this->count + count($this->skippedRows) + count($this->failures),
            'successful_imports' => $this->count,
            'skipped_rows' => count($this->skippedRows),
            'validation_failures' => count($this->failures),
            'skipped_details' => $this->skippedRows,
            'validation_details' => $this->failures
        ];
    }

    public function chunkSize(): int
    {
        return 200; // Smaller chunks for sync processing
    }

    public function batchSize(): int
    {
        return 200; // Smaller batches for sync processing
    }
}
