<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use Carbon\Carbon;

class AttendanceExport implements FromCollection, WithHeadings, WithEvents, WithMapping
{
    protected $users, $startDate, $endDate, $month, $year;

    public function __construct($users, $startDate, $endDate, $month, $year)
    {
        $this->users = $users;
        $this->startDate = Carbon::parse($startDate);
        $this->endDate = Carbon::parse($endDate);
        $this->month = $month;
        $this->year = $year;
    }

    public function collection()
    {
        return collect($this->users);

        // Similar logic to our earlier discussion
        // $report = [];

        // foreach ($this->users as $key => $user) {
        //     dd($user->getPreviousMonthAttendanceWithLeave());
        // }

        // $attendances = EmployeeAttendance::where('user_id', $this->user->id)
        //     ->whereBetween('punch_in', [$this->startDate, $this->endDate])
        //     ->get()
        //     ->groupBy(function ($item) {
        //         return Carbon::parse($item->punch_in)->toDateString();
        //     });

        // $leaves = Leave::where('user_id', $this->user->id)
        //     ->where(function ($query) {
        //         $query->whereBetween('from', [$this->startDate, $this->endDate])
        //               ->orWhereBetween('to', [$this->startDate, $this->endDate])
        //               ->orWhere(function ($q) {
        //                   $q->where('from', '<', $this->startDate)
        //                     ->where('to', '>', $this->endDate);
        //               });
        //     })
        //     ->get();

        // $period = CarbonPeriod::create($this->startDate, $this->endDate);

        // foreach ($period as $date) {
        //     $dateStr = $date->toDateString();
        //     $status = 'Absent';
        //     $details = '';

        //     if (isset($attendances[$dateStr])) {
        //         $status = 'Present';
        //         $details = 'Punched in at ' . $attendances[$dateStr]->first()->punch_in;
        //     } else {
        //         $leave = $leaves->first(function ($leave) use ($dateStr) {
        //             return $dateStr >= $leave->from && $dateStr <= $leave->to;
        //         });

        //         if ($leave) {
        //             $status = 'On Leave';
        //             $details = 'Leave Type: ' . $leave->leave_type_id . ', Reason: ' . $leave->reason;
        //         }
        //     }

        //     $report[] = [
        //         'Date' => $dateStr,
        //         'Status' => $status,
        //         'Details' => $details,
        //     ];
        // }

        // return collect($report);
    }

    public function map($user): array
    {
        // $row = [
        //     $user->name,
        //     $user->employee_id,
        // ];

        // $details = $user->details;
        // $attendances = $user->getPreviousMonthAttendanceWithLeave($this->month, $this->year);

        // $attendanceData = [];
        // foreach ($attendances as $entry) {
        //     $status = $entry['status'];
        //     $details = ($status != "Absent" ? (is_array($entry['details']) ? $entry['details'] : $entry['details']->first()) : NULL);

        //     if ($status === 'Present' && $details) {
        //         $in = $details->punch_in ? Carbon::parse($details->punch_in)->format('H:i') : '-';
        //         $out = $details->punch_out ? Carbon::parse($details->punch_out)->format('H:i') : '-';
        //         $hours = ($details->punch_in && $details->punch_out)
        //             ? Carbon::parse($details->punch_out)->diff(Carbon::parse($details->punch_in))->format('%H:%I')
        //             : '-';
        //         $address = $details->work_from ?? '-';
        //     } elseif ($status === 'Leave') {
        //         $in = $out = $hours = '-';
        //         $address = 'Leave';
        //     } else {
        //         $in = $out = $hours = $address = '-';
        //     }

        //     $row[] = $in;
        //     $row[] = $out;
        //     $row[] = $hours;
        //     $row[] = $address;
        
        // }

        return [];
        // return array_merge($baseData, $attendanceData);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $column = 3; // Column C (index 3)

                $date = Carbon::create($this->year, $this->month, 1);
                $days = $date->daysInMonth;

                $dayHeadings = [];
                for ($i = 1; $i <= $days; $i++) {
                    $dayHeadings[] = $this->year."-".$this->month."-".$i;
                }
    
                foreach ($dayHeadings as $date) {
                    $start = Coordinate::stringFromColumnIndex($column);
                    $end = Coordinate::stringFromColumnIndex($column + 3);
                    $sheet->mergeCells("{$start}1:{$end}1");
    
                    // Center-align merged header
                    $sheet->getStyle("{$start}1:{$end}1")->applyFromArray([
                        'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                        'font' => ['bold' => true],
                    ]);
    
                    $column += 4;
                }
    
                // Bold subheadings in row 2
                $totalCols = 2 + count($dayHeadings) * 4;
                $lastColLetter = Coordinate::stringFromColumnIndex($totalCols);
                $sheet->getStyle("A2:{$lastColLetter}2")->getFont()->setBold(true);
            },
        ];
    }

    public function headings(): array
    {
        $row1 = ['', '']; // A1 and B1 are blank

        $date = Carbon::create($this->year, $this->month, 1);
        $days = $date->daysInMonth;

        $dayHeadings = [];
        for ($i = 1; $i <= $days; $i++) {
            $row1[] = $this->year."-".$this->month."-".$i;
            $row1[] = '';
            $row1[] = '';
            $row1[] = '';
        }

        // $row1 = ['', '', ...collect($dayHeadings)->flatMap(fn($date) => [$date, '', '', ''])->toArray()];
        $row2 = ['Name', 'Emp ID'];
        foreach ($dayHeadings as $date) {
            $row2[] = 'In Time';
            $row2[] = 'Out Time';
            $row2[] = 'Working Hours';
            $row2[] = 'Address';

        }

        // Combine both heading rows
        return [$row1, $row2];
    }
}

?>
