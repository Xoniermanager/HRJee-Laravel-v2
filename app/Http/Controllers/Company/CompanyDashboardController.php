<?php

namespace App\Http\Controllers\Company;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Leave;
use Illuminate\Http\Request;
use App\Models\CompanyBranch;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Controller;
use App\Http\Services\BranchServices;
use App\Http\Services\DepartmentServices;
use App\Http\Services\DesignationServices;
use App\Http\Services\EmployeeServices;

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
        $companyId = Auth()->guard('company')->user()->company_id;
        $today = today();
        $dashboardData = [
            // Total office branches
            'allCompanyBranch' => $this->companyBranchService->getAllCompanyBranchByCompanyId($companyId),

            'allDepartment' => $this->departmentService->getAllDepartmentsByCompanyId(),
            // Total attendance for today (optimizing query)
            'total_present' => EmployeeAttendance::whereDate('punch_in', $today)
                ->whereHas('user', fn($query) => $query->where('company_id', $companyId))
                ->count(),

            // Total active employees
            'total_active_employee' => User::where('company_id', $companyId)
                ->where('status', '1') // Assuming STATUS_ACTIVE is defined in the User model
                ->count(),

            // Total inactive employees
            'total_inactive_employee' => User::where('company_id', $companyId)
                ->where('status', '0') // Assuming STATUS_INACTIVE is defined in the User model
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

            'all_users_details' => $this->employeeService->getAllEmployeeByCompanyId($companyId)->with(['designation'])->paginate(10)
            
        ];
        
        return view('company.dashboard.dashboard', compact('dashboardData'));
    }

    public function searchFilterEmployee(Request $request)
    {
        dd($request->all());
    }
}
