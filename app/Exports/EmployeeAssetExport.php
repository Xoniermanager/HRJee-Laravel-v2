<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeAssetExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $allEmployeeAssetDetails;

    public function __construct($allEmployeeAssetDetails)
    {
        $this->allEmployeeAssetDetails = $allEmployeeAssetDetails;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection(): mixed
    {
        return $this->allEmployeeAssetDetails;
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
            'Asset Name',
            'Employee Name',
            'Employee Email',
            'Asset Category',
            'Asset Manufacturer',
            'Asset Status',
            'Model',
            'Serial No',
            'Invoice No',
            'Invoice Date',
            'Purchase Value',
            'Validation Upto',
            'Allocation Status',
            'Ownership',
            'Assigned Date',
            'Returned Date',
            'Comment',
        ];
    }

    /**
     * Map the data to include serial number, date, and other fields.
     *
     * @param  $allEmployeeAssetDetails
     * @return array
     */
    public function map($allEmployeeAssetDetails): array
    {
        static $serialNumber = 1;

        // Access userAsset safely, check if it exists first
        $userAsset = $allEmployeeAssetDetails->userAsset;

        return [
            $serialNumber++,
            $allEmployeeAssetDetails->name,
            $userAsset?->user->name ?? 'N/A',  // Check if userAsset and user exist
            $userAsset?->user->email ?? 'N/A', // Check if userAsset and user exist
            $allEmployeeAssetDetails->assetCategories->name,
            $allEmployeeAssetDetails->assetManufacturers->name,
            $allEmployeeAssetDetails->assetStatus->name,
            $allEmployeeAssetDetails->model,
            $allEmployeeAssetDetails->serial_no,
            $allEmployeeAssetDetails->invoice_no,
            getFormattedDate($allEmployeeAssetDetails->invoice_date),
            $allEmployeeAssetDetails->purchase_value,
            getFormattedDate($allEmployeeAssetDetails->validation_upto),
            ucfirst($allEmployeeAssetDetails->allocation_status),
            ucfirst($allEmployeeAssetDetails->ownership),
            $userAsset?->assigned_date ? getFormattedDate($userAsset->assigned_date) : '',
            $userAsset?->returned_date ? getFormattedDate($userAsset->returned_date) : '',
            $userAsset?->comment ?? ''
        ];
    }


    /**
     * Apply styles to the sheet.
     *
     * @param $sheet
     * @return array
     */
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

    /**
     * Auto-size columns based on content.
     *
     * @param $sheet
     * @return void
     */
    public function sheet($sheet)
    {
        // Auto-size columns from A to Z based on the content
        foreach (range('A', 'Z') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }
}
