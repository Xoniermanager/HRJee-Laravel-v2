<?php

namespace App\Http\Controllers\Company;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Leave;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Controller;
use App\Http\Services\BranchServices;
use App\Http\Services\DepartmentServices;
use App\Http\Services\DesignationServices;
use App\Http\Services\EmployeeServices;
use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class CompanyDashboardController extends Controller
{
    public $departmentService;
    public $designationService;
    public $companyBranchService;
    public $employeeService;

    public function __construct(DepartmentServices $departmentService, DesignationServices $designationService, BranchServices $companyBranchService, EmployeeServices $employeeService)
    {
        $this->departmentService = $departmentService;
        $this->designationService = $designationService;
        $this->companyBranchService = $companyBranchService;
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $companyId = Auth()->user()->id;
        $companyIDs = getCompanyIDs();
        $daysLeft = 10;

        if(Auth()->user()->type == "company" && Auth()->user()->companyDetails->subscription_expiry_date) {
            $subscriptionExpiry = date('Y-m-d', strtotime(Auth()->user()->companyDetails->subscription_expiry_date));

            // Check if expiry date is within 7 days
            $daysLeft = $subscriptionExpiry ? Carbon::now()->diffInDays(Carbon::parse($subscriptionExpiry), false) : null;

        }

        $today = today();
        $dashboardData = [
            // Total office branches
            'allCompanyBranch' => $this->companyBranchService->getAllCompanyBranchByCompanyId($companyIDs),

            'allDepartment' => $this->departmentService->getAllDepartmentsByCompanyId($companyIDs),
            // Total attendance for today (optimizing query)
            'total_present' => EmployeeAttendance::whereDate('punch_in', $today)
                ->whereHas('user', fn($query) => $query->where('company_id', $companyId))
                ->count(),

            // Total active employees
            'total_active_employee' => User::where('company_id', $companyId)
                ->where('status', 1) // Assuming STATUS_ACTIVE is defined in the User model
                ->where('type', 'user')
                ->count(),

            // Total inactive employees
            'total_inactive_employee' => User::where('company_id', $companyId)
                ->where('status', 0) // Assuming STATUS_INACTIVE is defined in the User model
                ->where('type', 'user')
                ->count(),

            // Total leave taken today (approved)
            'total_leave' => Leave::whereDate('from', '<=', $today)
                ->whereDate('to', '>=', $today)
                ->where('leave_status_id', '2') // Assuming STATUS_APPROVED is defined in Leave model
                ->whereHas('user', fn($query) => $query->where('company_id', $companyId))
                ->count(),

            // Total leave requests for today (pending)
            'total_request_leave' => Leave::whereDate('from', '<=', $today)
                ->whereDate('to', '>=', $today)
                ->where('leave_status_id', '1') // Assuming STATUS_PENDING is defined in Leave model
                ->whereHas('user', fn($query) => $query->where('company_id', $companyId))
                ->count(),

            'all_users_details' => User::where(['company_id' => $companyId, 'status' => 1, 'type' => 'user'])->with(['details','details.designation'])->paginate(10),
        ];
        return view('company.dashboard.dashboard', compact('dashboardData', 'daysLeft'));
    }

    public function filterEmployees(Request $request)
    {
        $companyId = auth()->user()->id;

        $query = User::with(['details', 'details.designation'])
            ->where('company_id', $companyId)
            ->where('type', 'user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('branch')) {
            $query->whereHas('details', function ($q) use ($request) {
                $q->where('company_branch_id', $request->branch);
            });
        }

        if ($request->filled('department')) {
            $query->whereHas('details', function ($q) use ($request) {
                $q->where('department_id', $request->department);
            });
        }

        if ($request->filled('designation')) {
            $query->whereHas('details', function ($q) use ($request) {
                $q->where('designation_id', $request->designation);
            });
        }

        // Fetch initial paginated results first
        $employees = $query->paginate(10);

        // If attendance_check filter exists, filter the collection after fetching
        if ($request->filled('attendance_check')) {
            $status = $request->attendance_check;

            // Laravel pagination returns LengthAwarePaginator,
            // get the collection items to filter
            $filtered = $employees->getCollection()->filter(function ($user) use ($status) {
                $isPresent = $user->todaysAttendance() !== null;
                $isOnLeave = $user->todaysLeave() !== null;

                if ($status === 'present') {
                    return $isPresent && !$isOnLeave;
                } elseif ($status === 'leave') {
                    return !$isPresent && $isOnLeave;
                } elseif ($status === 'absent') {
                    return !$isPresent && !$isOnLeave;
                }
                return true;
            });

            // Replace the paginator's collection with filtered results
            $employees->setCollection($filtered->values());
        }

        return view('company.dashboard.list', compact('employees'))->render();

    }

    public function sendMailForSubscription(Request $request) {

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
