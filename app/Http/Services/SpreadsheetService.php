<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\File;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Font;


class SpreadsheetService
{
  public function createSpreadsheet($data, $filePath)
  {
    $directory = dirname($filePath);
    if (!File::exists($directory)) {
      File::makeDirectory($directory, 0755, true);
    }
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    foreach ($data as $rowIndex => $row) {
      foreach ($row as $colIndex => $value) {
        $cell = $this->getCellByColumnAndRow($colIndex + 1, $rowIndex + 1);
        $sheet->setCellValue($cell, $value);
      }
    }
    $sheet->getStyle('A1:' . $this->getCellByColumnAndRow(count($data[0]), 1))->getFont()->setBold(true);
    // Set column widths
    $columns = range('A', 'Z'); // Adjust this range if you have more columns
    foreach ($columns as $column) {
      $sheet->getColumnDimension($column)->setAutoSize(true); // Auto-size
      // $sheet->getColumnDimension($column)->setWidth(20); // Fixed width example
    }
    $writer = new Xlsx($spreadsheet);
    $writer->save($filePath);
  }


  private function getCellByColumnAndRow($col, $row)
  {
    $letters = range('A', 'Z');
    $column = '';
    while ($col > 0) {
      $column = $letters[($col - 1) % 26] . $column;
      $col = floor(($col - 1) / 26);
    }
    return $column . $row;
  }
}
