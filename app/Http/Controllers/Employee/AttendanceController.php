<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\EmployeeAttendanceService;

class AttendanceController extends Controller
{
    public $employeeAttendanceService;

    public function __construct(EmployeeAttendanceService $employeeAttendanceService)
    {
        $this->employeeAttendanceService = $employeeAttendanceService;
    }
    public function index()
    {
        $allAttendanceDetails = $this->employeeAttendanceService->getAllAttendanceDetails(Auth::guard('employee')->user()->id);
        return view('employee.hrService.attendance_service', compact('allAttendanceDetails'));
    }

    public function getAttendanceByFromAndToDate(Request $request)
    {
        $allAttendanceDetails = $this->employeeAttendanceService->getAttendanceByFromAndToDate($request->from_date, $request->to_date);
        if ($allAttendanceDetails) {
            return response()->json([
                'success' => 'Searching',
                'data'    =>  view('employee.hrService.attendance_list', compact('allAttendanceDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}