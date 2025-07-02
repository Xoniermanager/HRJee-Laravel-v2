<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class LeadExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    protected $allLeadDetails;

    public function __construct($allLeadDetails)
    {
        $this->allLeadDetails = $allLeadDetails; 
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->allLeadDetails; 
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
            'Case ID',
            'Customer ID',
            'Version',
            'Loan Type',
            'Request Loan Amount',
            'Loan Tenure In Year',
            'Contact Name',
            'Customer Phone Number',
            'Customer Email ID',
            'Applicant Type',
            'Applicant Sub Type',
            'Customer Gender',
            'Customer DOB',
            'Customer Pan Number',
            'Customer GST Number',
            'Customer Pincode',
            'Customer City',
            'Customer State',
            'Net Monthly Income',
            'No Of Years In Business',
            'Business Turnover Yearly',
        ];
    }

    /**
     * Map the data to include serial number, date, and working hours.
     *
     * @param $connectorDetail
     * @return array
     */
    public function map($leadDetail): array
    {
        static $serialNumber = 1;
        static $version = 'V2';
        return [
            $serialNumber++,
            $leadDetail->case_id,
            $leadDetail->customer_id,
            $version,
            $leadDetail->loan->productName->type,
            $leadDetail->loan->amount,
            $leadDetail->loan->tenure,
            $leadDetail->customer_name,
            $leadDetail->customer_number,
            $leadDetail->email,
            $leadDetail->applicant_type,
            $leadDetail->business_type,
            $leadDetail->gender,
            $leadDetail->dob,
            $leadDetail->pan,
            $leadDetail->gst,
            $leadDetail->pincode,
            $leadDetail->city,
            $leadDetail->state,
            $leadDetail->incomeDetails->total_loan_outstanding ?? '',
            $leadDetail->incomeDetails->no_of_years ?? '',
            $leadDetail->incomeDetails->previous_turnover ?? '',
        ];
    }

    public function styles($sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => 'FFFF00', 
                    ],
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                // Auto-size columns based on the content
                foreach (range('A', 'U') as $column) { // Adjust range based on your headings
                    $event->sheet->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }
}
