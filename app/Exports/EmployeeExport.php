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
        if ($allEmployeeDetails->details->gender == 'M') {
            $allEmployeeDetails->details->gender = "Male";
        }
        if ($allEmployeeDetails->details->gender == 'F') {
            $allEmployeeDetails->details->gender = "Female";
        }
        if ($allEmployeeDetails->details->gender == 'N/A') {
            $allEmployeeDetails->details->gender = "N/A";
        }
        if ($allEmployeeDetails->details->gender == 'O') {
            $allEmployeeDetails->details->gender = "Other";
        }
        if ($allEmployeeDetails->details->marital_status == 'M') {
            $allEmployeeDetails->details->marital_status = "Maried";
        }
        if ($allEmployeeDetails->details->marital_status == 'S') {
            $allEmployeeDetails->details->marital_status = "Single";
        }
        if ($allEmployeeDetails->details->marital_status == 'N/A') {
            $allEmployeeDetails->details->marital_status = "N/A";
        }
        return [
            $serialNumber++,
            $allEmployeeDetails->name,
            $allEmployeeDetails->details->emp_id,
            $allEmployeeDetails->email,
            $allEmployeeDetails->details->official_email_id,
            $allEmployeeDetails->details->father_name,
            $allEmployeeDetails->details->mother_name,
            $allEmployeeDetails->details->blood_group,
            $allEmployeeDetails->details->gender,
            $allEmployeeDetails->details->marital_status,
            getFormattedDate($allEmployeeDetails->details->date_of_birth),
            getFormattedDate($allEmployeeDetails->details->joining_date),
            $allEmployeeDetails->details->department->name ?? '',
            $allEmployeeDetails->details->designation->name ?? '',
            $allEmployeeDetails->details->companyBranch->name ?? '',
            $allEmployeeDetails->bankDetails->account_name ?? '',
            $allEmployeeDetails->bankDetails->account_number ?? '',
            $allEmployeeDetails->bankDetails->bank_name ?? '',
            $allEmployeeDetails->bankDetails->ifsc_code ?? '',
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
