<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use App\Models\EmployeeAttendance;
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
            $autoPunchoutTime = (int) $attendance->shift->auto_punch_out; // in minutes
            $shiftEndTime = $attendance->shift->end_time;
            $shiftEnd = Carbon::parse($shiftEndTime);
            $forceOutTime = $shiftEnd->copy()->addMinutes($autoPunchoutTime);
            // Perform auto punch out if current time >= force out time and not already punched out
            if (now()->gte($forceOutTime) && !$attendance->punch_out) {
                $attendance->punch_out = $forceOutTime;
                $attendance->is_auto_punch_out = 1;
                $attendance->save();
                $this->info("Auto punched out user {$attendance->user_id} at {$forceOutTime}");
            }

        }
        $this->info("Checked and updated all auto punch-outs.");
    }
}
