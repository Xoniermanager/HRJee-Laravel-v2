<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\EmployeeAttendanceService;

class AttendanceController extends Controller
{
    public $employeeAttendanceService;

    public function __construct(EmployeeAttendanceService $employeeAttendanceService)
    {
        $this->employeeAttendanceService = $employeeAttendanceService;
    }
    public function makeAttendance(Request $request)
    {
        try {
            $data['punch_in_using'] = 'Mobile';
            $attendanceDetails = $this->employeeAttendanceService->create($data);
            if ($attendanceDetails['status'] == true && $attendanceDetails['data'] == 'Puch Out') {
                $message = "You Puch Out Successfully";
            }
            if ($attendanceDetails['status'] == true && $attendanceDetails['data'] == 'Puch In') {
                $message = "You Puch In Successfully";
            }
            if ($attendanceDetails['status'] == false) {
                $message = "Don't Access you to Puch In Current Time";
            }
            return response()->json([
                'status' => true,
                'message' => $message,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function getAttendanceByFromAndToDate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'from_date'               => ['required', 'date'],
                'to_date'                 => ['required', 'date'],
            ]);
            if ($validator->fails()) {
                return response()->json([
                    "error" => 'validation_error',
                    "message" => $validator->errors(),
                ], 422);
            }
            $finalData = [];
            $allAttendanceDetails = $this->employeeAttendanceService->getAttendanceByFromAndToDate($request->from_date, $request->to_date);
            if (isset($allAttendanceDetails) && count($allAttendanceDetails) > 0) {
                foreach ($allAttendanceDetails as $attendanceDetails) {
                    if (isset($attendanceDetails->punch_in) && isset($attendanceDetails->punch_out)) {
                        $totalHours = getTotalHour($attendanceDetails->punch_in, $attendanceDetails->punch_out);
                    } else {
                        $totalHours = 'N A';
                    }
                    if (isset($attendanceDetails->punch_out))
                        $punchOut = date('h:i A', strtotime($attendanceDetails->punch_out));
                    else
                        $punchOut = "N A";
                    $finalData[] =
                        [
                            'date'     => date('j F,Y', strtotime($attendanceDetails->punch_in)),
                            'punch_in' => date('h:i A', strtotime($attendanceDetails->punch_in)),
                            'punch_out' => $punchOut,
                            'total_hours' => $totalHours
                        ];
                }
            } else {
                $finalData = "No Attendance Found Of Respective Dates";
            }
            $paginationDetails = [
                'total'     =>  $allAttendanceDetails->count(),
                'current'   =>  $allAttendanceDetails->currentPage(),
                'next'      =>  $allAttendanceDetails->nextPageUrl(),
                'previous'  =>  $allAttendanceDetails->previousPageUrl(),
            ];
            return response()->json([
                'status' => true,
                'data' => $finalData,
                'paginationDetails' => $paginationDetails,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
