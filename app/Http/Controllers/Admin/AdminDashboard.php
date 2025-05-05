<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Company;
use App\Models\CompanyDetail;
use App\Models\EmployeeAttendance;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminDashboard extends Controller
{
    public function index()
    {
        $dashboardData = [
            'all_company' => User::where('type', 'company')->count(),
            'total_active_company' => User::where(['type' => 'company','status' => 1])->count(),
            'total_inactive_company' => User::where(['type' => 'company','status' => 0])->count(),
            'all_employee' => User::where('type', 'user')->count(),
            'total_active_employee' => User::where(['type' => 'user','status' => 1])->count(),
            'total_inactive_employee' => User::where(['type' => 'user','status' => 0])->count(),
        ];
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::today()->endOfDay();
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

        $expiredDate = date('Y-m-d', strtotime('+7 days'));
        $subscriptionExpiredCompanies = CompanyDetail::with('user', 'subscriptionPlan')->where('subscription_expiry_date', '<=', $expiredDate)->get();
        
        return view('admin.dashboard', compact('dashboardData', 'allAttendanceDetails', 'subscriptionExpiredCompanies'));
    }
    
    public function attendanceDetails()
    {
        $allCompanyDetails = User::where('type', 'company')->paginate(10); 

        return view('admin.attendance', compact('allCompanyDetails'));
    }
}
