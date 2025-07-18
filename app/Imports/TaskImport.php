<?php

namespace App\Imports;

use App\Models\AssignTask;
use App\Models\UserDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class TaskImport implements ToCollection, WithChunkReading
{
    protected $header;

    public function collection(Collection $rows)
    {
        if (!$this->header) {
            $this->header = $rows->first()
                ->map(fn($v) => strtoupper(trim($v)))
                ->toArray();

            $rows = $rows->skip(1); // skip header row
        }

        DB::beginTransaction();

        try {
            $errors = [];

            foreach ($rows as $rowNumber => $row) {
                $rowAssoc = array_combine($this->header, $row->toArray());

                // Validate EMP_ID
                if (empty($rowAssoc['EMP_ID'])) {
                    $errors[] = "Row " . ($rowNumber + 2) . ": EMP_ID is required.";
                    continue;
                }

                $user = UserDetail::where('emp_id', $rowAssoc['EMP_ID'])->first();
                if (!$user) {
                    $errors[] = "Row " . ($rowNumber + 2) . ": No user found with EMP_ID: {$rowAssoc['EMP_ID']}";
                    continue;
                }

                // Geocode address
                [$latitude, $longitude] = $this->tryGeocode($rowAssoc['VISIT_ADDRESS'] ?? '');

                // Extract dynamic fields
                $dynamicFields = $this->extractDynamicFields($rowAssoc);

                // Save task
                AssignTask::create([
                    'user_id' => $user->user_id,
                    'visit_address' => $rowAssoc['VISIT_ADDRESS'] ?? null,
                    'remark' => $rowAssoc['REMARK'] ?? null,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'response_data' => json_encode($dynamicFields),
                    'company_id' => Auth::user()->company_id,
                    'created_by' => Auth::id(),
                ]);
            }

            if (count($errors) > 0) {
                // Rollback and throw validation with all errors
                DB::rollBack();
                throw ValidationException::withMessages(['import_errors' => $errors]);
            }

            DB::commit();

        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function extractDynamicFields(array $row): array
    {
        // Fixed fields to exclude; everything else is dynamic
        unset($row['SR_NO'], $row['EMP_ID'], $row['VISIT_ADDRESS'], $row['REMARK']);
        // Convert keys to lowercase + under_score
        $formatted = [];
        foreach ($row as $key => $value) {
            $newKey = strtolower(trim($key));                   // lowercase
            $newKey = preg_replace('/\s+/', '_', $newKey);      // replace spaces with underscore
            $formatted[$newKey] = $value;
        }
        return $formatted;
    }

    private function tryGeocode(string $address): array
    {
        if (empty($address))
            return [null, null];

        try {
            $results = app('geocoder')->geocode($address)->get();

            if ($results->isNotEmpty()) {
                $coordinates = $results[0]->getCoordinates();
                return [$coordinates->getLatitude(), $coordinates->getLongitude()];
            }
        } catch (\Throwable $e) {
            \Log::error('Geocode failed: ' . $e->getMessage());
        }

        return [null, null];
    }

    public function chunkSize(): int
    {
        return 500;
    }
}
