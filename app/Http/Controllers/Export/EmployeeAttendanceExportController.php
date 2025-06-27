<?php

namespace App\Http\Controllers\Export;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeeAttendanceExport;
use App\Http\Services\EmployeeAttendanceService;
use App\Http\Services\EmployeeServices;

class EmployeeAttendanceExportController extends Controller
{

    public $employeeAttendanceService;
    public $employeeService;

    public function __construct(EmployeeAttendanceService $employeeAttendanceService, EmployeeServices $employeeService)
    {
        $this->employeeAttendanceService = $employeeAttendanceService;
        $this->employeeService = $employeeService;
    }
    public function employeeAttendanceExport(Request $request)
    {
        $employeeDetail = $this->employeeService->getUserDetailById($request->empId);
        if ($request->type == 'ByTwoDates') {
            $filename = str_replace(' ', '', $employeeDetail->name) . '-Attendance-' . $request->to . '-' . $request->from . '.xlsx';
            $attendanceDetails = $this->employeeAttendanceService->getAttendanceByFromAndToDate($request->from_date, $request->to_date, $employeeDetail->id)->get();
        } else {
            if($request->startDate != "") {
                $filename = str_replace(' ', '', $employeeDetail->name) . $employeeDetail->details->emp_id . '-Attendance-' . $request->startDate . $request->endDate . '.xlsx';
                $attendanceDetails = $this->employeeAttendanceService->getAllAttendanceByDateByUserId($request->startDate, $employeeDetail->id, $request->endDate)->get();
            } else {
                $filename = str_replace(' ', '', $employeeDetail->name) . $employeeDetail->details->emp_id . '-Attendance-' . $request->month . $request->year . '.xlsx';
                $attendanceDetails = $this->employeeAttendanceService->getAllAttendanceByMonthByUserId($request->month, $employeeDetail->id, $request->year)->get();
            }
        }
        return Excel::download(new EmployeeAttendanceExport($attendanceDetails), $filename);
    }
}
