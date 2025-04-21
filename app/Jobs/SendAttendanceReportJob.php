<?php

namespace App\Jobs;

use Maatwebsite\Excel\Facades\Excel;
use App\Mail\SendAttendanceReportMail;
use App\Exports\AttendanceExport;
use App\Exports\HtmlTableExport;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendAttendanceReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user, $users, $range, $from, $to, $month, $year;

    public function __construct($user, $allEmployeeDetails, $range, $from = null, $to = null, $month = null, $year = null)
    {
        $this->user = $user;
        $this->users = $allEmployeeDetails;
        $this->range = $range;
        $this->from = $from;
        $this->to = $to;
        $this->month = $month;
        $this->year = $year;
    }

    public function handle()
    {
        if($this->month != null && $this->year != null) {
            // Start date (first day of the month)
            $startDate = Carbon::create($this->year, $this->month, 1)->startOfMonth()->toDateString();
            // End date (last day of the month)
            $endDate = Carbon::create($this->year, $this->month, 1)->endOfMonth()->toDateString();
        } else {
            // Get dynamic date range
            [$startDate, $endDate] = $this->calculateDateRange($this->range, $this->from, $this->to);
        }
        

        $html = "<!DOCTYPE html><html><head><meta charset='UTF-8'></head><body>&gt;<table border='1'><thead><tr><th colspan='6'></th>";

        $date = Carbon::create(2025, 03, 1);
        $days = $date->daysInMonth;
        for ($i = 1; $i <= $days; $i++) {
            $html .= "<th class='date-header' colspan='4'>2025-3-".$i."</th>";
        }

        // $html .= "<th>Total Leaves</th>
        //        <th>Total Half Day</th>
        //        <th>Total Late</th>
        //        <th>On Time</th>
        //        <th>Total Punch-IN</th>
        //        <th>Absent (Not Punch-IN)</th>
        //        <th>Total Weekend/Holiday</th>
        //        <th>Total Absent</th>
        //        <th>Total Active Days</th>
        //        <th>Salary</th>";

        $html .= '</tr><tr><th>Name</th><th>Emp ID</th><th>Designation</th><th>Gender</th><th>Mobile</th><th>Branch</th>';

        for ($i = 1; $i <= $days; $i++) {
            $html .= '<th>In Time</th><th>Out Time</th><th>Working Hours</th><th>Address</th>
           ';
        }

        $html .= '</tr></thead><tbody>';

        foreach($this->users as $user) {
            $html .= '<tr><td>' . $user->name . '</td><td>' . $user->id . '</td><td>' . $user->details->designation->name . '</td><td>' . $user->details->gender . '</td><td>' . $user->details->phone . '</td><td>' . $user->details->companyBranch->name . '</td>';

            $attendances = $user->getPreviousMonthAttendanceWithLeave(3, 2025);

            foreach ($attendances as $entry) {
                $status = $entry['status'];
                $details = ($status != "Absent" ? (is_array($entry['details']) ? $entry['details'] : $entry['details']->first()) : NULL);
    
                if ($status === 'Present' && $details) {
                    $in = $details->punch_in ? Carbon::parse($details->punch_in)->format('H:i') : '-';
                    $out = $details->punch_out ? Carbon::parse($details->punch_out)->format('H:i') : '-';
                    $hours = ($details->punch_in && $details->punch_out)
                        ? Carbon::parse($details->punch_out)->diff(Carbon::parse($details->punch_in))->format('%H:%I')
                        : '-';
                    $address = $details->work_from ?? '-';
                } elseif ($status === 'Leave') {
                    $in = $out = $hours = 'NA';
                    $address = 'Leave';
                } else {
                    $in = $out = $hours = $address = '-';
                }

                $html .= '<td>' . $in . '</td>';
                $html .= '<td>' . $out . '</td>';
                $html .= '<td>' . $hours . '</td>';
                $html .= '<td>' . $address . '</td>';
            }

            $html .= '</tr>';

            // $html .= '<td>435</td><td>435</td><td>4</td><td>3</td><td>3</td><td>34</td><td>4</td><td>2</td><td>3</td><td>1</td>';		
        }

        $html .= '</tr>';
        $html .= '</tr>';
        
        $html .= '<tbody></table></body></html>';
        // dd($html);

        // Export file
        $fileName = "Attendance_{$this->user->id}_{$startDate}_to_{$endDate}.xlsx";
        // Excel::store(new AttendanceExport($users, $startDate, $endDate, $this->month, $this->year), $fileName);
        Excel::store(new HtmlTableExport($html), $fileName);

        // Email
        Mail::to($this->user->email)->send(new SendAttendanceReportMail($fileName, $startDate, $endDate));
    }

    protected function calculateDateRange($range, $from, $to)
    {
        $now = now();
        switch ($range) {
            case 'previous_month':
                return [$now->copy()->subMonth()->startOfMonth()->toDateString(), $now->copy()->subMonth()->endOfMonth()->toDateString()];
            case 'previous_year':
                return [$now->copy()->subYear()->startOfYear()->toDateString(), $now->copy()->subYear()->endOfYear()->toDateString()];
            case 'previous_quarter':
                $currentQuarter = ceil($now->month / 3);
                $previousQuarterEnd = $now->copy()->startOfQuarter()->subDay();
                $previousQuarterStart = $previousQuarterEnd->copy()->subMonths(2)->startOfMonth();
                return [$previousQuarterStart->toDateString(), $previousQuarterEnd->toDateString()];
            case 'current_month':
                return [$now->startOfMonth()->toDateString(), $now->endOfMonth()->toDateString()];
            case 'current_year':
                return [$now->startOfYear()->toDateString(), $now->endOfYear()->toDateString()];
            case 'current_quarter':
                return [$now->startOfQuarter()->toDateString(), $now->endOfQuarter()->toDateString()];
            case 'custom':
                return [Carbon::parse($from)->toDateString(), Carbon::parse($to)->toDateString()];
        }
    }
}

?>
