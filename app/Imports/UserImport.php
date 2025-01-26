<?php

namespace App\Imports;

use App\Models\User;
use App\Models\EmployeeType;
use App\Models\CompanyBranch;
use App\Models\EmployeeStatus;
use Illuminate\Support\Facades\Auth;
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

    protected $failures = [];  // Array to store the failure messages

    /**
     * Handle the imported data
     *
     * @param Collection $collection
     * @return void
     */
    public function collection(Collection $collection)
    {
        $data = $collection->skip(1);
        foreach ($data as $row) {
            $row['password'] = Hash::make(trim($row['password'] ?? '123456'));
            $genderMap = [
                'Male' => 'M',
                'Female' => 'F',
                'Other' => 'O',
            ];
            $row['gender'] = $genderMap[$row['gender']];


            //default value for employee import payload
            $row['created_at'] = now();
            $row['updated_at'] = now();
            $row['blood_group'] = 'N/A';
            $row['marital_status'] = 'N/A';
            $row['last_login_ip'] = request()->ip();
            $row['company_id'] = Auth::guard('company')->user()->company_id;
            $row['employee_type_id'] = EmployeeType::NEWJOINEE;
            $row['role_id'] = '2';
            $companyBranch = CompanyBranch::where('name', $row['company_branch'])->first();
            $row['employee_status_id'] = EmployeeStatus::CURRENT;
            $row['company_branch_id'] = $companyBranch->id;
            unset($row['sr_no']);
            unset($row['company_branch']);
        }
        $this->insertData($data);
    }

    protected function insertData($payload)
    {
        return User::insert($payload->toArray());
    }

    public function rules(): array
    {
        return [
            'sr_no' => 'required|integer',
            'name' => 'required|string|max:255',
            'emp_id' => 'required|unique:users,emp_id',
            'email' => 'required|email|unique:users,email',
            'official_email_id' => 'nullable|email|unique:users,official_email_id',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'gender' => 'required|in:Male,Female,Other',
            'date_of_birth' => 'required|date_format:Y-m-d|before:today',
            'joining_date' => 'required|date_format:Y-m-d|before:today',
            'password' => 'required|string|min:8',
            'company_branch' => 'required|exists:company_branches,name',
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
