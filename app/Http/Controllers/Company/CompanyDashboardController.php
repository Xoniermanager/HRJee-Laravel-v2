<?php

namespace App\Http\Controllers\Company;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Leave;
use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Controller;
use App\Http\Services\AttendanceRequestService;
use Illuminate\Support\Facades\Mail;
use App\Http\Services\BranchServices;
use App\Http\Services\EmployeeServices;
use App\Http\Services\DepartmentServices;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\DesignationServices;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;


class CompanyDashboardController extends Controller
{
    public $departmentService;
    public $designationService;
    public $companyBranchService;
    public $employeeService;
    public $attendanceRequestService;

    public function __construct(DepartmentServices $departmentService, DesignationServices $designationService, BranchServices $companyBranchService, EmployeeServices $employeeService,AttendanceRequestService $attendanceRequestService)
    {
        $this->departmentService = $departmentService;
        $this->designationService = $designationService;
        $this->companyBranchService = $companyBranchService;
        $this->employeeService = $employeeService;
        $this->attendanceRequestService = $attendanceRequestService;
    }

    public function index(Request $request)
    {
        $companyId = auth()->user()->id;
        $companyIDs = getCompanyIDs();
        $daysLeft = 10;

        if (auth()->user()->type === "company" && auth()->user()->companyDetails->subscription_expiry_date) {
            $subscriptionExpiry = auth()->user()->companyDetails->subscription_expiry_date;
            $daysLeft = Carbon::now()->diffInDays(Carbon::parse($subscriptionExpiry), false);
        }

        $today = today();

        // Shared query builder
        $query = User::with(['details', 'details.designation'])
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

        // Return partial table if AJAX
        if ($request->ajax()) {
            return view('company.dashboard.list', compact('employees'))->render();
        }

        // Full dashboard view
        $dashboardData = [
            'allCompanyBranch' => $this->companyBranchService->getAllCompanyBranchByCompanyId($companyIDs),
            'allDepartment' => $this->departmentService->getAllDepartmentsByCompanyId($companyIDs),
            'total_present' => EmployeeAttendance::whereDate('punch_in', $today)
                ->whereHas('user', fn($query) => $query->where('company_id', $companyId))
                ->count(),
            'total_active_employee' => User::with(['details', 'details.designation'])
            ->where('company_id', $companyId)
            ->where('type', 'user')
            ->where('status', 1)
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
        ];

        return view('company.dashboard.dashboard', compact('dashboardData', 'daysLeft'));
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
}
