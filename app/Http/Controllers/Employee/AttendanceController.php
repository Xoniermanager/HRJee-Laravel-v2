<?php

namespace App\Http\Controllers\Employee;

use Carbon\Carbon;
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
        $allAttendanceDetails = $this->employeeAttendanceService->getAttendanceByFromAndToDate(Carbon::now()->startOfMonth(), Carbon::now(), Auth::user()->id)->with('shift')->orderBy('punch_in', 'DESC')->paginate(20);

        
        return view('employee.hrService.attendance_service', compact('allAttendanceDetails'));
    }

    public function getAttendanceByFromAndToDate(Request $request)
    {
        $allAttendanceDetails = $this->employeeAttendanceService->getAttendanceByFromAndToDate($request->from_date, $request->to_date, Auth()->user()->id)->orderBy('punch_in', 'DESC')->paginate(20);
        if ($allAttendanceDetails) {
            return response()->json([
                'data' => view('employee.hrService.attendance_list', compact('allAttendanceDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
