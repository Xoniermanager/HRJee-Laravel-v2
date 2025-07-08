<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use App\Exports\HtmlTableExport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Services\WeekendService;
use App\Http\Services\HolidayServices;
use App\Mail\SendAttendanceReportMail;
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
        $weekendService = app(WeekendService::class);
        $holidayService = app(HolidayServices::class);

        if ($this->month && $this->year) {
            $startDate = Carbon::create($this->year, $this->month, 1)->startOfMonth()->toDateString();

            // Check if selected month/year is current
            $isCurrentMonth = Carbon::create($this->year, $this->month, 1)->isSameMonth(now());

            // If current month, endDate should be today
            if ($isCurrentMonth) {
                $endDate = now()->toDateString();
            } else {
                $endDate = Carbon::create($this->year, $this->month, 1)->endOfMonth()->toDateString();
            }
        }

        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        $days = $end->diffInDays($start) + 1;

        $tableColumns = 6 + 6 + ($days * 4); // 6 employee details + 6 summary + days * 4

        $html = "<!DOCTYPE html>
            <html>
            <head>
                <meta charset='UTF-8'>
                <style>
                    body { font-family: Arial, sans-serif; font-size: 12px; }
                    table { border-collapse: collapse; width: 100%; }
                    th, td {
                        border: 1px solid #ccc;
                        padding: 6px;
                        text-align: center;
                        vertical-align: middle;
                        white-space: nowrap;
                    }
                    th {
                        background-color: #f2f2f2;
                        font-weight: bold;
                    }
                    tr:nth-child(even) { background-color: #f9f9f9; }
                    .summary-header {
                        background-color: #e6f3ff;
                        font-weight: bold;
                    }
                    /* Force text format for phone numbers */
                    .phone-number {
                        mso-number-format: \"@\";
                        text-align: left;
                    }
                </style>
            </head>
            <body>
            <table>
                <thead>
                    <tr>
                        <th colspan='" . ($tableColumns + 1) . "' style='font-size:16px; font-weight:bold; text-align:center; vertical-align:middle; padding:10px;'>
                            Employee Attendance Report - " . Carbon::parse($startDate)->format('F Y') . "
                        </th>
                    </tr>
                    <tr>
                        <th colspan='7'></th>"; // Employee details columns

        // Summary columns header
        $html .= "<th colspan='6' class='summary-header'>Summary</th>";

        // Date columns header
        for ($i = 0; $i < $days; $i++) {
            $dayLabel = $start->copy()->addDays($i)->format('d M');
            $html .= "<th colspan='4'>{$dayLabel}</th>";
        }

        $html .= "</tr>
                    <tr>
                        <th>S. No.</th>
                        <th>Name</th>
                        <th>Emp ID</th>
                        <th>Designation</th>
                        <th>Gender</th>
                        <th>Mobile</th>
                        <th>Branch</th>";

        // Summary column headers
        $html .= "<th class='summary-header'>Present</th>";
        $html .= "<th class='summary-header'>Absent</th>";
        $html .= "<th class='summary-header'>Leave</th>";
        $html .= "<th class='summary-header'>Late</th>";
        $html .= "<th class='summary-header'>Half Day</th>";
        $html .= "<th class='summary-header'>Short Att.</th>";

        // Date column headers
        for ($i = 0; $i < $days; $i++) {
            $html .= "<th>In</th><th>Out</th><th>Hrs</th><th>WF</th>";
        }

        $html .= "</tr>
                </thead>
                <tbody>";

        $serial = 1;

        foreach ($this->users as $user) {
            $html .= "<tr>";
            $html .= "<td>{$serial}</td>"; // Serial number
            $html .= "<td>{$user->name}</td>";
            $html .= "<td>{$user->details->emp_id}</td>";
            $html .= "<td>" . ($user->details->designation->name ?? '-') . "</td>";
            $html .= "<td>" . ($user->details->gender ?? '-') . "</td>";
            

            $phoneNumber = $user->details->phone ?? '-';
            if ($phoneNumber !== '-' && is_numeric($phoneNumber)) {
                $phoneNumber = "&#8203;" . $phoneNumber;
            }
            $html .= "<td class='phone-number'>{$phoneNumber}</td>";

            $html .= "<td>" . ($user->details->companyBranch->name ?? '-') . "</td>";

            $attendances = $user->getPreviousMonthAttendanceWithLeave($this->month, $this->year);

            // Initialize counters for summary
            $totalPresent = 0;
            $totalAbsent = 0;
            $totalLeave = 0;
            $totalLate = 0;
            $totalHalfDay = 0;
            $totalShortAttendance = 0;

            // Collect daily attendance data first
            $dailyAttendanceData = [];

            for ($i = 0; $i < $days; $i++) {
                $currentDate = $start->copy()->addDays($i)->toDateString();
                $entry = collect($attendances)->firstWhere('date', $currentDate);

                $in = $out = $hours = $workFrom = '-';

                if ($entry) {
                    $status = $entry['status'];
                    $details = $entry['details'];

                    if ($status === 'Present' && $details) {
                        $totalPresent++;

                        if ($details instanceof \Illuminate\Support\Collection) {
                            $details = $details->first();
                        }

                        $in = $details && $details->punch_in ? Carbon::parse($details->punch_in)->format('H:i') : '-';
                        $out = $details && $details->punch_out ? Carbon::parse($details->punch_out)->format('H:i') : '-';

                        if ($details && $details->punch_in && $details->punch_out) {
                            $punchIn = Carbon::parse($details->punch_in);
                            $punchOut = Carbon::parse($details->punch_out);
                            $hours = $punchOut->diff($punchIn)->format('%H:%I');

                            if ($details->late) {
                                $totalLate++;
                            }

                            if ($details->status == 2) {
                                $totalHalfDay++;
                            }

                            if ($details->is_short_attendance) {
                                $totalShortAttendance++;
                            }
                        } else {
                            $hours = '-';
                        }

                        $workFrom = $details->work_from ?? '-';
                    } elseif ($status === 'On Leave') {
                        $totalLeave++;
                        $in = $out = $hours = 'NA';
                        $workFrom = 'Leave';
                    } else {
                        $checkWeekend = $weekendService->getWeekendDetailByWeekdayId(
                            $user->company_id,
                            $user->details->company_branch_id,
                            $user->details->department_id,
                            $currentDate
                        );

                        $checkHoliday = $holidayService->getHolidayByDate($user->company_id, $startDate, $user->details->company_branch_id)->exists();

                        if (!$checkWeekend && !$checkHoliday) {
                            $totalAbsent++;
                        }
                    }
                } else {
                    $totalAbsent++;
                }

                $dailyAttendanceData[] = [
                    'in' => $in,
                    'out' => $out,
                    'hours' => $hours,
                    'workFrom' => $workFrom
                ];
            }

            // Add summary columns first
            $html .= "<td style='background-color: #e6f3ff; font-weight: bold;'>{$totalPresent}</td>";
            $html .= "<td style='background-color: #e6f3ff; font-weight: bold;'>{$totalAbsent}</td>";
            $html .= "<td style='background-color: #e6f3ff; font-weight: bold;'>{$totalLeave}</td>";
            $html .= "<td style='background-color: #e6f3ff; font-weight: bold;'>{$totalLate}</td>";
            $html .= "<td style='background-color: #e6f3ff; font-weight: bold;'>{$totalHalfDay}</td>";
            $html .= "<td style='background-color: #e6f3ff; font-weight: bold;'>{$totalShortAttendance}</td>";

            // Then add daily attendance data
            foreach ($dailyAttendanceData as $dayData) {
                $html .= "<td>{$dayData['in']}</td><td>{$dayData['out']}</td><td>{$dayData['hours']}</td><td>{$dayData['workFrom']}</td>";
            }

            $html .= "</tr>";
            $serial++;
        }

        $html .= "</tbody>
            </table>
            </body>
        </html>";

        $fileName = "Attendance_{$this->user->id}_{$startDate}_to_{$endDate}.xlsx";
        Excel::store(new HtmlTableExport($html), $fileName);
        Mail::to($this->user->email)->send(new SendAttendanceReportMail($fileName, $startDate, $endDate));
    }

    protected function calculateDateRange($range, $from, $to)
    {
        $now = now();

        switch ($range) {
            case 'previous_month':
                return [
                    $now->copy()->subMonth()->startOfMonth()->toDateString(),
                    $now->copy()->subMonth()->endOfMonth()->toDateString()
                ];
            case 'previous_year':
                return [
                    $now->copy()->subYear()->startOfYear()->toDateString(),
                    $now->copy()->subYear()->endOfYear()->toDateString()
                ];
            case 'previous_quarter':
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
            default:
                return [$now->startOfMonth()->toDateString(), $now->endOfMonth()->toDateString()];
        }
    }
}