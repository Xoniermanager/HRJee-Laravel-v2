<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Carbon\Carbon;

class ConnectorExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents
{
    protected $allConnectorDetails;

    public function __construct($allConnectorDetails)
    {
        $this->allConnectorDetails = $allConnectorDetails; 
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->allConnectorDetails; 
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
            'Connector Name',
            'Connector ID',
            'Email',
            'Mobile',
            'Connector Business ID',
            'Connector Business Name',
            'Assigned RM Name',
            'Assigned RM ID',
            'Status',
            'Created Date',
            'Address',
        ];
    }

    /**
     * Map the data to include serial number, date, and working hours.
     *
     * @param $connectorDetail
     * @return array
     */
    public function map($connectorDetail): array
    {
        static $serialNumber = 1;
        return [
            $serialNumber++,
            $connectorDetail->connector_name,
            $connectorDetail->connector_id,
            $connectorDetail->email,
            $connectorDetail->msisdn,
            $connectorDetail->bussiness_id,
            $connectorDetail->connector_name,
            $connectorDetail->user->name,
            $connectorDetail->user['details']->emp_id,
            $connectorDetail->status,
            Carbon::parse($connectorDetail->created_at)->format('Y-m-d H:i:s'), 
            $connectorDetail->address,
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
                foreach (range('A', 'I') as $column) { // Adjust range based on your headings
                    $event->sheet->getColumnDimension($column)->setAutoSize(true);
                }
            },
        ];
    }
}
