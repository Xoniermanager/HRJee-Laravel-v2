<?php

namespace App\Exports;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TaskImportTemplateExport implements FromCollection, WithHeadings, WithStyles
{
    protected $dynamicFields;

    public function __construct(array $dynamicFields)
    {
        // Convert dynamic fields to uppercase for header
        $this->dynamicFields = array_map('strtoupper', $dynamicFields);
    }

    public function headings(): array
    {
        // Add SR_NO at the start, then fixed fields, then dynamic fields
        return array_merge(
            ['SR_NO', 'EMP_ID', 'VISIT_ADDRESS','REMARK'],
            $this->dynamicFields
        );
    }

    public function collection()
    {
        // Demo data: SR_NO = 1, COM_ID = 123, PROJECT_NAME = Demo Project
        $row = [
            1,
            '123',
            'Demo Project',
            'testing'
        ];

        // Add demo data for dynamic fields
        foreach ($this->dynamicFields as $index => $field) {
            $row[] = 'Sample Data ' . ($index + 1);
        }

        return new Collection([$row]);
    }

    public function styles(Worksheet $sheet)
    {
        // Apply bold and background color to header (row 1)
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9E1F2'] // light blue
                ]
            ],
        ];
    }
}
