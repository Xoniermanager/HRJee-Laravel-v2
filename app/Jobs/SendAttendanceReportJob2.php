<?php

namespace App\Jobs;

use Maatwebsite\Excel\Facades\Excel;
use App\Mail\SendAttendanceReportMail;
use App\Exports\AttendanceExport;
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

    protected $user, $users, $month, $year;

    public function __construct($user, $allEmployeeDetails, $month = null, $year = null)
    {
        $this->user = $user;
        $this->users = $allEmployeeDetails;
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

        // Export file
        $fileName = "Attendance_{$startDate}_to_{$endDate}.xlsx";
        Excel::store(new AttendanceExport($this->users, $startDate, $endDate, $this->month, $this->year), $fileName);

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
