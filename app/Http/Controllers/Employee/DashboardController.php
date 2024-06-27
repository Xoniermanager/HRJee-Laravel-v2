<?php

namespace App\Http\Controllers\Employee;
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
        return view('employee.dashboard.dashboard');
    }
}
