<?php

namespace App\Http\Controllers\Company;

use Carbon\Carbon;
use App\Models\News;
use App\Models\User;
use App\Models\Leave;
use App\Models\Policy;
use App\Models\UserDetail;
use App\Mail\ContactUsMail;
use App\Models\KpiEmployee;
use App\Models\Announcement;
use App\Models\EmployeeType;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Services\BranchServices;
use App\Http\Services\EmployeeServices;
use App\Http\Services\DepartmentServices;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\DesignationServices;
use App\Http\Services\AttendanceRequestService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class CompanyDashboardController extends Controller
{
    public $departmentService;
    public $designationService;
    public $companyBranchService;
    public $employeeService;
    public $attendanceRequestService;

    public function __construct(DepartmentServices $departmentService, DesignationServices $designationService, BranchServices $companyBranchService, EmployeeServices $employeeService, AttendanceRequestService $attendanceRequestService)
    {
        $this->departmentService = $departmentService;
        $this->designationService = $designationService;
        $this->companyBranchService = $companyBranchService;
        $this->employeeService = $employeeService;
        $this->attendanceRequestService = $attendanceRequestService;
    }

    public function index(Request $request)
    {
        $companyId = auth()->user()->company_id;
        $companyIDs = getCompanyIDs();
        $daysLeft = 10;

        if (auth()->user()->type === "company" && auth()->user()->companyDetails->subscription_expiry_date) {
            $subscriptionExpiry = auth()->user()->companyDetails->subscription_expiry_date;
            $daysLeft = Carbon::now()->diffInDays(Carbon::parse($subscriptionExpiry), false);
        }

        $today = today();

        // Shared query builder
        $query = User::managerFilter()->with(['details', 'details.designation'])
            ->where('company_id', $companyId)
            ->where('type', 'user')
            ->where('status', 1)
            ->whereHas('details', function ($q) {
                $q->whereNull('exit_date');
            });

        // Filters (if any from request)
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('branch')) {
            $query->whereHas('details', fn($q) => $q->where('company_branch_id', $request->branch));
        }

        if ($request->filled('department')) {
            $query->whereHas('details', fn($q) => $q->where('department_id', $request->department));
        }

        if ($request->filled('designation')) {
            $query->whereHas('details', fn($q) => $q->where('designation_id', $request->designation));
        }

        // Attendance filtering (manual after fetching)
        if ($request->filled('attendance_check')) {
            $allUsers = $query->get();

            $filtered = $allUsers->filter(function ($user) use ($request) {
                $status = $request->attendance_check;
                $isPresent = $user->todaysAttendance() !== null;
                $isOnLeave = $user->todaysLeave() !== null;

                return match ($status) {
                    'present' => $isPresent && !$isOnLeave,
                    'leave' => !$isPresent && $isOnLeave,
                    'absent' => !$isPresent && !$isOnLeave,
                    default => true,
                };
            });

            $page = $request->get('page', 1);
            $perPage = 10;
            $employees = new \Illuminate\Pagination\LengthAwarePaginator(
                $filtered->forPage($page, $perPage)->values(),
                $filtered->count(),
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );
        } else {
            $employees = $query->paginate(10);
        }

        // Attendance Chart Data (delegated to helper method)
        [$chartLabels, $chartData] = $this->getAttendanceChartData($companyId);

        // Return partial table if AJAX
        if ($request->ajax()) {
            return view('company.dashboard.list', compact('employees'))->render();
        }

        // Get all employee types from master
        $staticColors = [
            '#1642b3',
            '#ffa502',
            '#1e90ff',
            '#70a1ff',
            '#2ed573',
            '#ff4757',
            '#5352ed',
        ];

        $employeeTypes = EmployeeType::all();
        $employeeChart = [];
        $totalEmployees = User::managerFilter()->where('company_id', $companyId)
            ->where('type', 'user')
            ->where('status', 1)
            ->count();

        foreach ($employeeTypes as $index => $type) {
            $count = User::where('company_id', $companyId)
                ->where('type', 'user')
                ->where('status', 1)
                ->whereHas('details', fn($q) => $q->where('employee_type_id', $type->id))
                ->count();

            $employeeChart[] = [
                'label' => $type->name,
                'count' => $count,
                'percentage' => $totalEmployees > 0 ? round(($count / $totalEmployees) * 100) : 0,
                'color' => $staticColors[$index % count($staticColors)], // ⬅️ This must exist
            ];
        }

        $year = Carbon::now()->year;

        // Get count of KPI assigned per month
        $monthlyKpiCounts = KpiEmployee::selectRaw('MONTH(created_at) as month, COUNT(*) as total_kpi')
            ->where('company_id', $companyId)
            ->whereYear('created_at', $year)
            ->groupByRaw('MONTH(created_at)')
            ->orderByRaw('MONTH(created_at)')
            ->pluck('total_kpi', 'month'); // [1 => 5, 2 => 8, ...]

        $kpiData = [];
        for ($i = 1; $i <= 12; $i++) {
            $kpiData[] = $monthlyKpiCounts[$i] ?? 0;
        }
        // Full dashboard view
        $dashboardData = [
            'allCompanyBranch' => $this->companyBranchService->getAllCompanyBranchByCompanyId($companyIDs),
            'allDepartment' => $this->departmentService->getAllDepartmentsByCompanyId($companyIDs),
            'total_present' => EmployeeAttendance::whereDate('punch_in', $today)
                ->whereHas('user', fn($query) => $query->where('company_id', $companyId))
                ->count(),
            'total_employee' => User::managerFilter()->with(['details', 'details.designation'])
                ->where('company_id', $companyId)
                ->where('type', 'user')
                ->where('status', 1)
                ->whereHas('details', function ($q) {
                    $q->whereNull('exit_date');
                })->count(),
            'total_active_employee' => User::managerFilter()->with(['details', 'details.designation'])
                ->where('company_id', $companyId)
                ->where('type', 'user')
                ->where('status', 1)
                ->whereHas('details', function ($q) {
                    $q->whereNull('exit_date');
                })->count(),
            'total_inactive_employee' => User::managerFilter()->with(['details', 'details.designation'])
                ->where('company_id', $companyId)
                ->where('type', 'user')
                ->where('status', 0)
                ->whereHas('details', function ($q) {
                    $q->whereNull('exit_date');
                })->count(),
            'total_leave' => Leave::whereDate('from', '<=', $today)->whereDate('to', '>=', $today)
                ->where('leave_status_id', 2)
                ->whereHas('user', fn($query) => $query->where('company_id', $companyId))
                ->count(),
            'total_request_leave' => Leave::whereDate('from', '<=', $today)->whereDate('to', '>=', $today)
                ->where('leave_status_id', 1)
                ->whereHas('user', fn($query) => $query->where('company_id', $companyId))
                ->count(),
            'all_users_details' => $employees,
            'total_attendance_request' => $this->attendanceRequestService->getAttendanceRequestByCompanyId($companyIDs)->count(),
            'attendance_chart_labels' => $chartLabels,
            'attendance_chart_data' => $chartData,
            'total_employee_type' => $totalEmployees,
            'employee_chart' => $chartData,
            'employee_type_chart' => $employeeChart,
            'kpiData' => $kpiData
        ];

        return view('company.dashboard.dashboard', compact('dashboardData', 'daysLeft'));
    }

    private function getAttendanceChartData($companyId)
    {
        $endDate = Carbon::now();
        $startDate = $endDate->copy()->subDays(6);

        $dates = collect();
        for ($date = $startDate->copy(); $date <= $endDate; $date->addDay()) {
            $dates->push($date->format('Y-m-d'));
        }

        $employeeIds = User::managerFilter()->where('company_id', $companyId)->pluck('id');
        $employeeCount = $employeeIds->count();

        $rawData = EmployeeAttendance::whereBetween(DB::raw('DATE(punch_in)'), [$startDate->format('Y-m-d'), $endDate->format('Y-m-d')])
            ->whereIn('user_id', $employeeIds)
            ->get()
            ->groupBy(fn($attendance) => Carbon::parse($attendance->punch_in)->format('Y-m-d'));

        $chartLabels = [];
        $chartData = [];

        foreach ($dates as $date) {
            $label = Carbon::parse($date)->format('j M');
            $chartLabels[] = $label;

            $attendances = $rawData[$date] ?? collect();

            $onTime = $attendances->where('status', '1')->where('late', 0)->count();
            $late = $attendances->where('status', '1')->where('late', 1)->count();
            $present = $onTime + $late;
            $absent = $employeeCount - $present;

            $onTimePercent = $employeeCount > 0 ? round(($onTime / $employeeCount) * 100, 2) : 0;
            $latePercent = $employeeCount > 0 ? round(($late / $employeeCount) * 100, 2) : 0;
            $absentPercent = max(0, 100 - $onTimePercent - $latePercent);

            $chartData[$label] = [
                'on_time' => $onTimePercent,
                'late' => $latePercent,
                'absent' => $absentPercent,
            ];
        }

        return [$chartLabels, $chartData];
    }



    public function sendMailForSubscription(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $payload = [
            "name" => auth()->user()->name,
            "email" => auth()->user()->email,
            "subject" => $request->get('subject'),
            "message" => $request->get('message'),
        ];

        // Email
        Mail::to("hr@xonierconnect.com")->send(new ContactUsMail($payload['name'], $payload['email'], $payload['subject'], $payload['message']));

        return response()->json(['status' => true, 'message' => 'Your enquiry has been submitted. We will get back to you soon!']);
    }
    public function getEvents(Request $request)
    {
        $date = Carbon::parse($request->date)->toDateString(); // Y-m-d
        $companyId = getCompanyIDs();
        $events = [];

        // 🎂 Birthdays
        $birthdays = UserDetail::with('user')
            ->whereHas('user', function ($q) use ($companyId) {
                $q->where('company_id', $companyId)->where('type', 'user')->where('status', 1);
            })
            ->whereMonth('date_of_birth', Carbon::parse($date)->month)
            ->whereDay('date_of_birth', Carbon::parse($date)->day)
            ->get();

        foreach ($birthdays as $detail) {
            if ($detail->user) {
                $events[] = [
                    'type' => 'birthday',
                    'title' => "Birthday: {$detail->user->name} ({$detail->emp_id})"
                ];
            }
        }

        // 🎉 Anniversaries
        $anniversaries = UserDetail::with('user')
            ->whereHas('user', function ($q) use ($companyId) {
                $q->where('company_id', $companyId)->where('type', 'user')->where('status', 1);
            })
            ->whereMonth('joining_date', Carbon::parse($date)->month)
            ->whereDay('joining_date', Carbon::parse($date)->day)
            ->get();

        foreach ($anniversaries as $detail) {
            if ($detail->user) {
                $events[] = [
                    'type' => 'anniversary',
                    'title' => "Work Anniversary: {$detail->user->name} ({$detail->emp_id})"
                ];
            }
        }

        // 📢 Announcements
        $announcements = Announcement::where('company_id', $companyId)
            ->where('status', 1)
            ->whereDate('start_date_time', '<=', $date)
            ->whereDate('expires_at_time', '>=', $date)
            ->get();

        foreach ($announcements as $a) {
            $events[] = [
                'type' => 'announcement',
                'title' => "Announcement: {$a->title}"
            ];
        }

        // 📰 News
        $newsList = News::where('company_id', $companyId)
            ->where('status', 1)
            ->whereDate('start_date', '<=', $date)
            ->whereDate('end_date', '>=', $date)
            ->get();

        foreach ($newsList as $news) {
            $events[] = [
                'type' => 'news',
                'title' => "News: {$news->title}"
            ];
        }

        // 📋 Policies
        $policies = Policy::where('company_id', $companyId)
            ->where('status', 1)
            ->whereDate('start_date', '<=', $date)
            ->whereDate('end_date', '>=', $date)
            ->get();

        foreach ($policies as $policy) {
            $events[] = [
                'type' => 'policy',
                'title' => "Policy: {$policy->title}"
            ];
        }

        return response()->json([
            'events' => $events,
            'birthday_count' => count($birthdays),
            'anniversary_count' => count($anniversaries),
        ]);
    }

    public function allNotification()
    {
        return view('company.notification.index');
    }

}
