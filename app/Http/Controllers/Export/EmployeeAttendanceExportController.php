<?php

namespace App\Http\Controllers\Export;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeeAttendanceExport;

class EmployeeAttendanceExportController extends Controller
{
    public function employeeAttendanceExport(Request $request)
    {
        $employeeDetail = User::find($request->empId);
        $filename = str_replace(' ', '', $employeeDetail->name). $employeeDetail->emp_id .'-Attendance-' . $request->month . $request->year . '.xlsx';
        return Excel::download(new EmployeeAttendanceExport($request->year, $request->month, $request->empId),$filename);
    }
}
