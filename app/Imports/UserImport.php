<?php

namespace App\Imports;

use App\Models\User;
use App\Models\UserDetail;
use App\Models\EmployeeType;
use App\Models\CompanyBranch;
use App\Models\EmployeeStatus;
use App\Models\UserActiveLocation;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;  // This is the correct Collection to use

class UserImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    public $count = 0;
    protected $failures = [];  // Array to store the failure messages

    /**
     * Handle the imported data
     *
     * @param Collection $collection
     * @return void
     */
    public function collection(Collection $collection)
    {
        $this->count = $collection->count() - 1;

        $activeUsers = User::where([
            'status' => 1,
            'company_id' => Auth()->user()->company_id,
            'type' => 'user'
        ])->count();

        if (($this->count + $activeUsers) < auth()->user()->companyDetails->company_size) {
            $data = $collection->skip(0);

            foreach ($data as $row) {
                // Process the password for the users table
                $password = Hash::make(trim($row['password'] ?? 'password'));

                // Create user data for the 'users' table
                $userData = [
                    'name' => $row['name'],
                    'password' => $password,
                    'email' => $row['email'],
                    'company_id' => Auth()->user()->company_id,
                    'created_by' =>  Auth()->user()->id
                ];

                // Insert the user data into the users table
                $user = User::create($userData);

                // Prepare data for the 'user_details' table
                $genderMap = [
                    'Male' => 'M',
                    'Female' => 'F',
                    'Other' => 'O',
                ];

                $userDetailData = [
                    'phone' => $row['phone'],
                    'emp_id' => $row['emp_id'],
                    'date_of_birth' => date('Y-m-d', strtotime($row['date_of_birth'])),
                    'joining_date' => date('Y-m-d', strtotime($row['joining_date'])),
                    'user_id' => $user->id,  // Link user details to the newly created user
                    'official_email_id' => $row['official_email_id'],
                    'father_name' => $row['father_name'],
                    'mother_name' => $row['mother_name'],
                    'gender' => $genderMap[$row['gender']], // Default to 'Other' if gender is missing
                    'blood_group' => 'N/A',  // Default value for blood group
                    'marital_status' => 'N/A',  // Default value for marital status
                    'last_login_ip' => request()->ip(),
                    'employee_type_id' => EmployeeType::NEWJOINEE,
                    'employee_status_id' => EmployeeStatus::CURRENT,
                    'company_branch_id' => CompanyBranch::where('name', $row['company_branch'])->first()->id,
                ];
                // Insert the user details into the user_details table
                $userCreated = UserDetail::create($userDetailData);
                if ($userCreated) {
                    $branchDetails = CompanyBranch::find($userCreated->company_branch_id);
                    $address = $branchDetails->address;
                    $result = app('geocoder')->geocode($address)->get();
                    $coordinates = $result[0]->getCoordinates();
                    $lat = $coordinates->getLatitude();
                    $long = $coordinates->getLongitude();
                    UserActiveLocation::create([
                        'user_id' => $user->id,
                        'address' => $address,
                        'latitude' => $lat,
                        'longitude' => $long
                    ]);
                }
            }

            return response()->json(false);
        } else {

            return response()->json(false);
        }
    }

    public function rules(): array
    {
        return [
            'sr_no' => 'required|integer',
            'name' => 'required|string|max:255',
            'emp_id' => 'required|unique:user_details,emp_id',
            'email' => 'required|email|unique:users,email',
            'official_email_id' => 'nullable|email|unique:user_details,official_email_id',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'phone' => 'nullable|unique:user_details,phone',
            'date_of_birth' => 'required',
            'joining_date' => 'required',
            'password' => 'required|min:8',
            'company_branch' => 'required|exists:company_branches,name,company_id,' . Auth()->user()->company_id,
        ];
    }

    /**
     * Handles validation failures.
     *
     * @param Failure ...$failures
     * @return void
     */
    public function onFailure(Failure ...$failures)
    {
        // Collect failure messages
        foreach ($failures as $failure) {
            $this->failures[] = [
                'row' => $failure->row(),
                'attribute' => $failure->attribute(),
                'errors' => $failure->errors()
            ];
        }
    }

    public function getFailures()
    {
        return $this->failures;
    }

    public function islimitExceeded()
    {
        $activeUsers = User::where([
            'status' => 1,
            'company_id' => Auth()->user()->company_id,
            'type' => 'user'
        ])->count();

        return $activeUsers;
    }
}
