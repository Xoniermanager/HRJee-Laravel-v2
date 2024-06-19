<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Services\EmployeeAttendanceService;
use Illuminate\Http\Request;

class EmployeeAttendanceController extends Controller
{
    private $employeeAttendanceService;

    public function __construct(EmployeeAttendanceService $employeeAttendanceService)
    {
        $this->employeeAttendanceService = $employeeAttendanceService;
    }
    public function makeAttendance(Request $request)
    {
        $response = $this->employeeAttendanceService->create($request->all());
        if($response['status'] == true && $response['data'] == 'Puch Out')
        {
            return back()->with('success', "You Puch Out Successfully");
        }
        if($response['status'] == true && $response['data'] == 'Puch In')
        {
            return back()->with('success', "You Puch In Successfully");
        }
        if ($response['status'] == false)
        {
            return back()->with('error', "Don't Access you to Puch In Current Time");
        } 
    }
}
