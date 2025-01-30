<?php

namespace App\Http\Controllers\Employee;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Services\BreakTypeService;
use App\Http\Services\CompanyUserService;
use App\Http\Services\EmployeeAttendanceService;
use App\Http\Services\EmployeeBreakHistoryService;

class DashboardController extends Controller
{
    private $companyUserService;
    private $employeeAttendanceService;
    private $breakTypeService;

    private $employeeBreakHistoryService;

    public function __construct(CompanyUserService $companyUserService, EmployeeAttendanceService $employeeAttendanceService, BreakTypeService $breakTypeService, EmployeeBreakHistoryService $employeeBreakHistoryService)
    {
        $this->companyUserService = $companyUserService;
        $this->employeeAttendanceService = $employeeAttendanceService;
        $this->breakTypeService = $breakTypeService;
        $this->employeeBreakHistoryService = $employeeBreakHistoryService;
    }
    
    public function index()
    {
        $existingAttendanceDetail = $this->employeeAttendanceService->getExtistingDetailsByUserId(Auth()->user()->id);

        $allBreakTypeDetails = $this->breakTypeService->getAllBreakTypeByCompanyId(Auth()->user()->company_id);
        $takenBreakDetails = '';
        if (isset($existingAttendanceDetail) && !empty($existingAttendanceDetail)) {
            $takenBreakDetails = $this->employeeBreakHistoryService->getBreakHistoryByAttendanceId($existingAttendanceDetail->id);
            $existingAttendanceDetail['totalBreakHour'] = $this->employeeBreakHistoryService->getTotalBreakHour($existingAttendanceDetail->id);
        }
        //dd($existingAttendanceDetail);
        return view('employee.dashboard.dashboard', compact('existingAttendanceDetail', 'allBreakTypeDetails', 'takenBreakDetails'));
    }

    public function startImpersonate()
    {
        $employee = Auth()->user();

        // Save original guard and user info in session
        session()->put('impersonation', [
            'original_guard' => 'employee',
            'original_user_id' => $employee->id,
            'original_user_role' => $employee->role_id
        ]);

        // $data = [
        //     'company_id' => $employee->id,
        //     'name' => $employee->name,
        //     'password' => Hash::make($employee->password),
        //     'email' => $employee->email,
        //     'status' => 1
        // ];

        // $companyUser = $this->companyUserService->updateOrCreate(['email' => $employee->email], $data);

        // // Log in the company under the company guard
        // auth()->guard('company')->login($companyUser);

        return redirect()->route('company.dashboard')->with('success', 'Now impersonating company!');
    }

    public function endImpersonate()
    {
        if (!session()->has('impersonation')) {
            return redirect()->back()->with('error', 'No impersonation in progress.');
        }

        // Retrieve original guard and user info
        $impersonation = session()->get('impersonation');
        auth()->loginUsingId($impersonation['original_user_id']);

        // Clear impersonation session data
        session()->forget('impersonation');

        return redirect()->route('employee.dashboard');
    }
}
