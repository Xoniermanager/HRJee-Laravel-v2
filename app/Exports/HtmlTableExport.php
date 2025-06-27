<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class HtmlTableExport implements FromView, WithEvents
{
    protected $html;

    public function __construct(string $html)
    {
        $this->html = $html;
    }

    public function view(): View
    {
        return view('excel-view', [
            'html' => $this->html,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Merge heading row (e.g., A1 to F1)
                $sheet->mergeCells('A1:F1');

                // Center and bold the heading row
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                $highestCol = $sheet->getHighestColumn();
                $highestRow = $sheet->getHighestRow();
                $range = "A1:{$highestCol}{$highestRow}";

                $sheet->getStyle($range)->applyFromArray([
                    'font' => [
                        'name' => 'Arial',
                        'size' => 10,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                        'wrapText' => true,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);

                // Bold 2nd row as header (data table headers)
                $sheet->getStyle("2:2")->getFont()->setBold(true);

                // Freeze at 3rd row to lock header while scrolling
                $sheet->freezePane('A3');
            }
        ];
    }
}
