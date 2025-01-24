<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{

    protected $allEmployeeDetails;

    public function __construct($allEmployeeDetails)
    {
        $this->allEmployeeDetails = $allEmployeeDetails;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection(): mixed
    {
        return $this->allEmployeeDetails;
    }
    /**
     * Add headers for the export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Sr.',
            'Employee Name',
            'Employee ID',
            'Email',
            'Official Email',
            'Father Name',
            'Mother Name',
            'Blood Group',
            'Gender',
            'Marital Status',
            'Date Of Birth',
            'Joining Date',
            'Department',
            'Designation',
            'Company Branch',
            'Account Name',
            'Account Number',
            'Bank Name',
            'IFSC Code',
        ];
    }

    /**
     * Map the data to include serial number, date, and working hours.
     *
     * @param $allEmployeeDetails
     * @return array
     */
    public function map($allEmployeeDetails): array
    {
        static $serialNumber = 1;
        if ($allEmployeeDetails->gender == 'M') {
            $allEmployeeDetails->gender = "Male";
        }
        if ($allEmployeeDetails->gender == 'F') {
            $allEmployeeDetails->gender = "Female";
        }
        if ($allEmployeeDetails->gender == 'O') {
            $allEmployeeDetails->gender = "Other";
        }
        if ($allEmployeeDetails->marital_status == 'M') {
            $allEmployeeDetails->marital_status = "Maried";
        }
        if ($allEmployeeDetails->marital_status == 'S') {
            $allEmployeeDetails->marital_status = "Single";
        }

        return [
            $serialNumber++,
            $allEmployeeDetails->name,
            $allEmployeeDetails->emp_id,
            $allEmployeeDetails->email,
            $allEmployeeDetails->official_email_id,
            $allEmployeeDetails->father_name,
            $allEmployeeDetails->mother_name,
            $allEmployeeDetails->blood_group,
            $allEmployeeDetails->gender,
            $allEmployeeDetails->marital_status,
            getFormattedDate($allEmployeeDetails->date_of_birth),
            getFormattedDate($allEmployeeDetails->joining_date),
            $allEmployeeDetails->department->name,
            $allEmployeeDetails->designation->name,
            $allEmployeeDetails->companyBranch->name,
            $allEmployeeDetails->bankDetails->account_name,
            $allEmployeeDetails->bankDetails->account_number,
            $allEmployeeDetails->bankDetails->bank_name,
            $allEmployeeDetails->bankDetails->ifsc_code,
        ];
    }
    public function styles($sheet)
    {
        return [
            // Make the header row bold
            1 => [
                'font' => [
                    'bold' => true,
                ],
            ],
        ];
    }
    public function sheet($sheet)
    {
        // Auto-size columns based on the content
        foreach (range('A', 'Z') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }
}
