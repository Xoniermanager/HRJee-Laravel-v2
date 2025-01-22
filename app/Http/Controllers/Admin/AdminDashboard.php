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
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::today();
        $dateRange = collect();
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $dateRange->push($currentDate->format('Y-m-d'));
            $currentDate->addDay();
        }
        $attendanceData = EmployeeAttendance::whereBetween('punch_in', [$startDate, $endDate])
            ->selectRaw('DATE(punch_in) as date, COUNT(*) as total_punch_in')
            ->groupBy(DB::raw('DATE(punch_in)'))
            ->pluck('total_punch_in', 'date');
        $allAttendanceDetails = $dateRange->map(function ($date) use ($attendanceData) {
            return [
                'date' => Carbon::parse($date)->format('dM'),  // Format date as '11 Jan'
                'total_punch_in' => $attendanceData->get($date, 0),  // Default to 0 if no attendance for that date
            ];
        });
        return view('admin.dashboard', compact('dashboardData', 'allAttendanceDetails'));
    }
    public function attendanceDetails()
    {
        $allCompanyDetails = Company::select('id', 'name', 'email', 'contact_no', 'company_address')
            ->withCount(['users as activeEmployee' => function ($query) {
                $query->where('status', 1);
            }])
            ->withCount(['users as inactiveEmployee' => function ($query) {
                $query->where('status', 0);
            }])
            ->withCount(['employeeAttendances as totalAttendance' => function ($query) {
                $query->whereDate('punch_in', today());
            }])
            ->paginate(10);
        return view('admin.attendance', compact('allCompanyDetails'));
    }
}
