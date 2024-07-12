<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Services\BreakTypeService;
use App\Http\Services\EmployeeAttendanceService;

class DashboardController extends Controller
{
    private $employeeAttendanceService;
    private $breakTypeService;

    public function __construct(EmployeeAttendanceService $employeeAttendanceService, BreakTypeService $breakTypeService)
    {
        $this->employeeAttendanceService = $employeeAttendanceService;
        $this->breakTypeService = $breakTypeService;
    }
    public function index()
    {
        $existingDetails = $this->employeeAttendanceService->getExtistingDetailsByUserId(Auth()->guard('employee')->user()->id);
        $allBreakTypeDetails =  $this->breakTypeService->getAllBreakTypeByCompanyId(Auth()->guard('employee')->user()->company_id);
        return view('employee.dashboard.dashboard', compact('existingDetails','allBreakTypeDetails'));
    }
}
