<?php
namespace App\Exports;

use App\Models\LogActivity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class LogActivityExport implements FromCollection, WithHeadings, WithStyles, WithMapping, ShouldAutoSize
{
    /**
     * Fetch log activity records older than a week
     */
    public function collection()
    {
        return LogActivity::whereDate('created_at', '<', today()->subWeek())->get();
    }

    /**
     * Define column headings
     */
    public function headings(): array
    {
        return [
            'ID', 'URL', 'Method', 'IP Address', 'Response Code', 'Response Body',
            'Request Body', 'User ID', 'User Name', 'User Type', 'Company ID',
            'Created At', 'Updated At'
        ];
    }

    /**
     * Format date & time correctly in the exported CSV
     */
    public function map($log): array
    {
        return [
            $log->id,
            $log->url,
            $log->method,
            $log->ip,
            $log->response_code,
            $log->response_body,
            $log->request_body,
            $log->user_id,
            $log->user_name,
            $log->user_type,
            $log->company_id,
            Carbon::parse($log->created_at)->format('Y-m-d H:i:s'), // Keep date-time format unchanged
            Carbon::parse($log->updated_at)->format('Y-m-d H:i:s'),
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
        foreach (range('A', 'H') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    }
}
