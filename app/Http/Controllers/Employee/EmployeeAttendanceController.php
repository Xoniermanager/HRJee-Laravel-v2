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
        $data['punch_in_using'] = 'Web';
        //$response = $this->employeeAttendanceService->create($data);
        $response = $this->employeeAttendanceService->create2($data);

        if ($response['status'] == true && $response['data'] == 'Punch Out') {

            return response()->json([
                'success' => true,
                'message'   =>'You have successfully punched out.'
            ]);

        }
        if ($response['status'] == true && $response['data'] == 'Punch In') {
            return response()->json([
                'success' => true,
                'message'   =>'You have successfully punched in.'
            ]);
        }
        if ($response['status'] == false) {
            return response()->json([
                'success' => false,
                'message'   =>$response['message']
            ]);
        }
    }
}
