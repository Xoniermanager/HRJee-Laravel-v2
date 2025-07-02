<?php

namespace App\Imports;

use App\Models\Lead;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;  // This is the correct Collection to use

class LeadImport implements ToCollection, WithHeadingRow, WithValidation, SkipsOnFailure
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
            $data = $collection->skip(1);

            foreach ($data as $row) {
                
                // Create lead data for the 'leads' table
                $leadData = [
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'company_id' => Auth()->user()->company_id,
                ];

                // Insert the lead data into the leads table
                $user = Lead::create($leadData);

                // Prepare data for the 'lead_details' table
                $genderMap = [
                    'Male' => 'M',
                    'Female' => 'F',
                    'Other' => 'O',
                ];

                $leadDetailData = [
                    
                ];
                // Insert the user details into the user_details table
                // $userCreated = UserDetail::create($userDetailData);
                // if ($userCreated) {
                    
                // }
            }

            return response()->json(false);
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
            'date_of_birth' => 'required|date_format:Y-m-d|before:today',
            'joining_date' => 'required|date_format:Y-m-d|before:today',
            'password' => 'required|string|min:8',
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

}
