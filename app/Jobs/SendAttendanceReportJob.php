<?php

namespace App\Jobs;

use App\Exports\HtmlTableExport;
use App\Mail\SendAttendanceReportMail;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

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
        if ($this->month && $this->year) {
            $startDate = Carbon::create($this->year, $this->month, 1)->startOfMonth()->toDateString();
            $endDate = Carbon::create($this->year, $this->month, 1)->endOfMonth()->toDateString();
        } else {
            [$startDate, $endDate] = $this->calculateDateRange($this->range, $this->from, $this->to);
        }

        $start = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        $days = $end->diffInDays($start) + 1;

        $tableColumns = 6 + ($days * 4);

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
            <th colspan='7'></th>"; // updated for S.No. column

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
    $html .= "<td>" . ($user->details->phone ?? '-') . "</td>";
    $html .= "<td>" . ($user->details->companyBranch->name ?? '-') . "</td>";

    $attendances = $user->getPreviousMonthAttendanceWithLeave($this->month, $this->year);

    for ($i = 0; $i < $days; $i++) {
        $currentDate = $start->copy()->addDays($i)->toDateString();
        $entry = collect($attendances)->firstWhere('date', $currentDate);

        $in = $out = $hours = $workFrom = '-';

        if ($entry) {
            $status = $entry['status'];
            $details = $entry['details'];

            if ($status === 'Present' && $details) {
                if ($details instanceof \Illuminate\Support\Collection) {
                    $details = $details->first();
                }

                $in = $details && $details->punch_in ? Carbon::parse($details->punch_in)->format('H:i') : '-';
                $out = $details && $details->punch_out ? Carbon::parse($details->punch_out)->format('H:i') : '-';
                $hours = ($details && $details->punch_in && $details->punch_out)
                    ? Carbon::parse($details->punch_out)->diff(Carbon::parse($details->punch_in))->format('%H:%I')
                    : '-';
                $workFrom = $details->work_from ?? '-';
            } elseif ($status === 'On Leave') {
                $in = $out = $hours = 'NA';
                $workFrom = 'Leave';
            }
        }

        $html .= "<td>{$in}</td><td>{$out}</td><td>{$hours}</td><td>{$workFrom}</td>";
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
