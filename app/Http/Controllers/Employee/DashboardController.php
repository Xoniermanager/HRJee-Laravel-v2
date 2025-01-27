<?php

namespace App\Http\Controllers\Employee;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Services\BreakTypeService;
use App\Http\Services\EmployeeAttendanceService;
use App\Http\Services\EmployeeBreakHistoryService;

class DashboardController extends Controller
{
    private $employeeAttendanceService;
    private $breakTypeService;

    private $employeeBreakHistoryService;

    public function __construct(EmployeeAttendanceService $employeeAttendanceService, BreakTypeService $breakTypeService, EmployeeBreakHistoryService $employeeBreakHistoryService)
    {
        $this->employeeAttendanceService = $employeeAttendanceService;
        $this->breakTypeService = $breakTypeService;
        $this->employeeBreakHistoryService = $employeeBreakHistoryService;
    }
    public function index()
    {
        $existingAttendanceDetail = $this->employeeAttendanceService->getExtistingDetailsByUserId(Auth()->guard('employee')->user()->id);
        
        $allBreakTypeDetails =  $this->breakTypeService->getAllBreakTypeByCompanyId(Auth()->guard('employee')->user()->company_id);
        $takenBreakDetails = '';
        if (isset($existingAttendanceDetail) && !empty($existingAttendanceDetail)) {
            $takenBreakDetails = $this->employeeBreakHistoryService->getBreakHistoryByAttendanceId($existingAttendanceDetail->id);
            $existingAttendanceDetail['totalBreakHour'] = $this->employeeBreakHistoryService->getTotalBreakHour($existingAttendanceDetail->id);
        }
       //dd($existingAttendanceDetail);
        return view('employee.dashboard.dashboard', compact('existingAttendanceDetail', 'allBreakTypeDetails', 'takenBreakDetails'));
    }
}
