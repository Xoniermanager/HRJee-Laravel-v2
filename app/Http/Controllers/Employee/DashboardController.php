<?php

namespace App\Http\Controllers\Employee;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\EmployeeAttendanceService;

class DashboardController extends Controller
{
    private $employeeAttendanceService;

    public function __construct(EmployeeAttendanceService $employeeAttendanceService)
    {
        $this->employeeAttendanceService = $employeeAttendanceService;
    }
    public function index()
    {
        $existingDetails = $this->employeeAttendanceService->getExtistingDetailsByUserId(Auth()->user()->id);
        return view('employee.dashboard.dashboard', compact('existingDetails'));
    }
}
