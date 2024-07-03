<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\EmployeeLeaveAvailableService;

class LeaveAvailableController extends Controller
{
    public $employeeAvailableLeaveService;
    public function __construct(EmployeeLeaveAvailableService $employeeAvailableLeaveService)
    {
        $this->employeeAvailableLeaveService = $employeeAvailableLeaveService;
    }
    public function getAllLeaveAvailableByUserId()
    {
        $getEmployeeLeaveAvailableDetails = $this->employeeAvailableLeaveService->getAllLeaveAvailableByUserId(Auth()->guard('employee')->user()->id);
        return view('employee.leave_available.index',compact('getEmployeeLeaveAvailableDetails'));
    }
}
