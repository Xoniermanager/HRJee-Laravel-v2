<?php

namespace App\Exports;

use App\Models\EmployeeAttendance;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class EmployeeAttendanceExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $attendanceDetails;
    public function __construct($attendanceDetails)
    {
        $this->attendanceDetails = $attendanceDetails;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection(): mixed
    {
        return $this->attendanceDetails;
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
            'Date',
            'Employee Name',
            'Employee ID',
            'Punch IN',
            'Punch Out',
            'Total Working Hours',
            'Attendance Using By',
            'Attendance Marked By',
            'Remark',
        ];
    }

    /**
     * Map the data to include serial number, date, and working hours.
     *
     * @param $attendance
     * @return array
     */
    public function map($attendance): array
    {
        static $serialNumber = 1;
        $workingHours = getTotalWorkingHour($attendance->punch_in, $attendance->punch_out);
        $date = getFormattedDate($attendance->punch_in);
        $punchInTime = date('h:i A', strtotime($attendance->punch_in));
        $punchOutTime = date('h:i A', strtotime($attendance->punch_in));
        return [
            $serialNumber++,
            $date,
            $attendance->user->name,
            $attendance->user->details->emp_id,
            $punchInTime,
            $punchOutTime,
            $workingHours,
            $attendance->punch_in_using,
            $attendance->punch_in_by,
            $attendance->remark,
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
