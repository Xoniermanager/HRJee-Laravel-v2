<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Leave;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DepartmentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LeaveRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Leave::class;
    }

    public function getTotalLeaveByUserIDByMonth($userId, $month, $year)
    {
        $totalLeaves = $this->model::where('user_id', '=', $userId)
            ->where('leave_status_id', '=', 2)
            ->where(function ($query) use ($month, $year) {
                $query->whereMonth('from', $month)
                    ->whereYear('from', $year)
                    ->orWhere(function ($query) use ($month, $year) {
                        $query->whereMonth('to', $month)
                            ->whereYear('to', $year);
                    });
            })
            ->get();
        $leaveSummaries = $totalLeaves->groupBy('user_id')->mapWithKeys(function ($userLeaves) {
            $totalLeaveDays = $userLeaves->sum(function ($leave) {
                // Ensure 'from' and 'to' are Carbon instances
                $from = Carbon::parse($leave->from);
                $to = Carbon::parse($leave->to);

                // Check if 'to' date is in the next month and adjust it
                $currentMonth = Carbon::now()->month;
                if ($to->month > $currentMonth) {
                    // Set the 'to' date to the last day of the current month
                    $to = Carbon::now()->endOfMonth();
                }

                // Calculate leave days based on half day or full day
                if ($leave->is_half_day) {
                    return 0.5;
                }

                // If 'from' date equals 'to' date, it's a single day leave
                if ($from->isSameDay($to)) {
                    return 1;
                }

                // Otherwise calculate the difference in days (inclusive)
                return $from->diffInDays($to) + 1;
            });

            // Return user_id as the key and the total leave days as the value
            return ["total_leave" =>  $totalLeaveDays];
        });
        return $leaveSummaries['total_leave'] ?? '0';
    }
}
