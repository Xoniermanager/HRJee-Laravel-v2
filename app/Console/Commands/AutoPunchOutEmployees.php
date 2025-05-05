<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use App\Models\EmployeeAttendance;
use App\Models\UserShiftLog;
use Illuminate\Console\Command;

class AutoPunchOutEmployees extends Command
{
    protected $signature = 'attendance:auto-punchout';
    protected $description = 'Automatically punch out employees after 24 hours from shift start';

    public function handle()
    {
        $now = Carbon::now();
        // Get all records where punch out is null
        $attendances = EmployeeAttendance::whereNull('punch_out')->get();
        foreach ($attendances as $attendance) {
            $userShift = UserShiftLog::where('user_id', $attendance->user_id)
                ->whereDate('date', '<=', Carbon::parse($attendance->punch_in)->toDateString())
                ->latest()
                ->first();
            if (!$userShift || !$userShift->officeShift) {
                continue;
            }

            $shiftStart = Carbon::parse($attendance->punch_in);
            $forceOutTime = $shiftStart->copy()->addHours(22);

            if ($now->gte($forceOutTime)) {
                $attendance->punch_out = $forceOutTime;
                $attendance->is_auto_punch_out = 1;
                $attendance->save();
                $this->info("Auto punched out user {$attendance->user_id} at {$forceOutTime}");
            }
        }
        $this->info("Checked and updated all auto punch-outs.");
    }
}
