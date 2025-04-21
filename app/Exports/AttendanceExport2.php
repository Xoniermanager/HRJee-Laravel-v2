<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\EmployeeAttendance;
use App\Models\Leave;
use Carbon\CarbonPeriod;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class AttendanceExport implements FromCollection, WithHeadings
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
        // Similar logic to our earlier discussion
        $report = [];
        foreach ($this->users as $key => $user) {
            $report[] = [
                $key + 1,
                $user->details->emp_id,
                $user->name,
                (string)$user->totalPresent,
                $user->totalLeave,
                (string)$user->totalHoliday,

            ];
        }

        return collect($report);
    }

    public function headings(): array
    {
        return ['Sr. No', 'Employee Name', 'Employee ID', 'Total Present', 'Total Leave', 'Total Holiday'];
    }
}

?>
