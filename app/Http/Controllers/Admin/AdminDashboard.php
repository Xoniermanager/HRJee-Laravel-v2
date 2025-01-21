<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Company;
use App\Models\EmployeeAttendance;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminDashboard extends Controller
{
    public function index()
    {
        $dashboardData = [
            'all_company' => Company::count(),
            'all_employee' => User::count(),
            'total_active_company' => Company::where('status', '1')->count(),
            'total_inactive_company' => Company::where('status', '0')->count(),
            'total_active_employee' => User::where('status', '1')->count(),
            'total_inactive_employee' => User::where('status', '0')->count(),
        ];
        // Get the current date and the start of the current month
        $today = Carbon::today();
        $startOfMonth = $today->copy()->startOfMonth();

        // Query attendance records for the current month until today
        $attendanceData = EmployeeAttendance::whereBetween('punch_in', [$startOfMonth, $today])
            ->selectRaw('DATE(punch_in) as date, COUNT(*) as total_punch_in')
            ->groupBy(DB::raw('DATE(punch_in)'))
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($attendance) {
                $attendance->date = date('dM', strtotime($attendance->date)); // Format date as '11 Jan'
                return $attendance;
            })->toArray();
        return view('admin.dashboard', compact('dashboardData', 'attendanceData'));
    }
}
