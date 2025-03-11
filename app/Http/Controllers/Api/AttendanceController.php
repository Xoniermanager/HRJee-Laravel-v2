<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\UserMonthlySalary;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Services\EmployeeServices;
use Illuminate\Support\Facades\Storage;
use App\Exports\EmployeeAttendanceExport;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\EmployeeAttendanceService;

class AttendanceController extends Controller
{
    public $employeeAttendanceService;
    public $employeeService;

    public function __construct(EmployeeAttendanceService $employeeAttendanceService, EmployeeServices $employeeService)
    {
        $this->employeeAttendanceService = $employeeAttendanceService;
        $this->employeeService = $employeeService;
    }
    public function makeAttendance(Request $request)
    {
        try {
            $data['punch_in_using'] = 'Mobile';
            $attendanceDetails = $this->employeeAttendanceService->create($data);
            if ($attendanceDetails['status'] == true && $attendanceDetails['data'] == 'Puch Out') {
                return response()->json([
                    'status' => true,
                    'puch_out' => true,
                    'message' => "You Puch Out Successfully"
                ], 200);
            }
            if ($attendanceDetails['status'] == true && $attendanceDetails['data'] == 'Puch In') {
                return response()->json([
                    'status' => true,
                    'puch_in' => true,
                    'message' => "You Puch In Successfully"
                ], 200);
            }
            if ($attendanceDetails['status'] == false) {
                return response()->json([
                    'status' => true,
                    'atttendance_Status' => true,
                    'message' => "Don't Access you to Puch In Current Time",
                ], 200);
            }
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
                'from_date' => ['required', 'date'],
                'to_date' => ['required', 'date'],
            ]);
            if ($validator->fails()) {
                return response()->json([
                    "error" => 'validation_error',
                    "message" => $validator->errors(),
                ], 422);
            }
            $finalData = [];
            $allAttendanceDetails = $this->employeeAttendanceService->getAttendanceByFromAndToDate($request->from_date, $request->to_date, Auth()->guard('employee_api')->user()->id)->orderBy('punch_in', 'DESC')->paginate(20);
            if (isset($allAttendanceDetails) && count($allAttendanceDetails) > 0) {
                foreach ($allAttendanceDetails as $attendanceDetails) {
                    if (isset($attendanceDetails->punch_in) && isset($attendanceDetails->punch_out)) {
                        $totalHours = getTotalWorkingHour($attendanceDetails->punch_in, $attendanceDetails->punch_out);
                    } else {
                        $totalHours = 'N A';
                    }
                    if (isset($attendanceDetails->punch_out))
                        $punchOut = date('h:i A', strtotime($attendanceDetails->punch_out));
                    else
                        $punchOut = "N A";
                    $finalData[] =
                        [
                            'date' => date('j F,Y', strtotime($attendanceDetails->punch_in)),
                            'punch_in' => date('h:i A', strtotime($attendanceDetails->punch_in)),
                            'punch_out' => $punchOut,
                            'total_hours' => $totalHours
                        ];
                }
            } else {
                $finalData = "No Attendance Found Of Respective Dates";
            }
            $paginationDetails = [
                'total' => $allAttendanceDetails->count(),
                'current' => $allAttendanceDetails->currentPage(),
                'next' => $allAttendanceDetails->nextPageUrl(),
                'previous' => $allAttendanceDetails->previousPageUrl(),
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
    public function getTodayAttendance()
    {
        try {
            $todayAttendanceDetails = $this->employeeAttendanceService->getExtistingDetailsByUserId(auth()->guard('employee_api')->user()->id);
            return response()->json([
                'status' => true,
                'todayAttendanceDetails' => $todayAttendanceDetails,
                'message' => "Retrieved Attendance Today"
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getLastTenDaysAttendance()
    {
        try {
            $lastAttendanceDetails = $this->employeeAttendanceService->getLastTenDaysAttendance();
            if (isset($lastAttendanceDetails) && count($lastAttendanceDetails) > 0) {
                foreach ($lastAttendanceDetails as $attendanceDetails) {
                    $finalData[] =
                        [
                            'date' => date('j F,Y', strtotime($attendanceDetails->punch_in)),
                            'day' => date('l', strtotime($attendanceDetails->punch_in)),
                            'total_hours' => getTotalWorkingHour($attendanceDetails->punch_in, $attendanceDetails->punch_out)
                        ];
                }
            } else {
                $finalData = "No Last Attendance Available";
            }
            return response()->json([
                'status' => true,
                'data' => $finalData,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function getParticularDateAttendance(Request $request)
    {
        try {
            $date = $request->has('date') ? $request->get('date') : date('Y-m-d');
            $response = $this->employeeAttendanceService->getAttendanceByByDate($date, auth()->user()->id);

            return response()->json([
                'status' => true,
                'data' => $response,
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function generateAttendanceExport(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date',
        ]);
        $employeeDetail = $this->employeeService->getUserDetailById(Auth()->guard('employee_api')->user()->id);
        if (!$employeeDetail) {
            return response()->json(['error' => 'Employee not found'], 404);
        }
        $filename = str_replace(' ', '', $employeeDetail->name) . '-Attendance-' . $request->from_date . '-' . $request->to_date . '.xlsx';
        $attendanceDetails = $this->employeeAttendanceService->getAttendanceByFromAndToDate($request->from_date, $request->to_date, $employeeDetail->id)->get();
        if (count($attendanceDetails) > 0) {
            $filePath = "/attendance/{$filename}";
            Excel::store(new EmployeeAttendanceExport($attendanceDetails), $filePath, 'public');
            $fileUrl = url("storage" . $filePath);
            return response()->json([
                'status' => true,
                'message' => 'Excel file generated successfully',
                'data' => [
                    'download_url' => $fileUrl
                ]
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No Attendance found for this two respective dates',
            ]);
        }
    }

    public function generatePaySlip()
    {
        $employeeDetails = User::find(Auth()->guard('employee_api')->user()->id);
        $checkExistingMonthDetails = UserMonthlySalary::where('user_id', Auth()->guard('employee_api')->user()->id)->where('year', Carbon::now()->subMonth()->format('Y'))->where('month', Carbon::now()->subMonth()->format('n'))->first();
        $data = [];
        if (isset($checkExistingMonthDetails) && !empty($checkExistingMonthDetails)) {
            $data['getEmployeeMonthlySalary']['others'] = $checkExistingMonthDetails->toArray();
            $data['getEmployeeMonthlySalary']['monthlyCtc'] = $checkExistingMonthDetails->monthly_ctc;
            $data['getEmployeeMonthlySalary']['components'] = $checkExistingMonthDetails->userMonthlySalaryComponentLog->toArray();
            $data['employeeSalary'] = $employeeDetails;
            $data['status'] = true;
            $data['mail'] = $checkExistingMonthDetails->mail_send;
            $pdf = PDF::loadView('salary_temp', ['data' => $data]);
            $fileName = removingSpaceMakingName($employeeDetails->name) . '-' . Carbon::now()->subMonth()->format('n') . '_salary.pdf';
            $filePath = '/salaries/' . $fileName;
            Storage::disk('public')->put($filePath, $pdf->output());
            return response()->json(['status' => true, 'file_url' => url("storage" . $filePath)]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Sorry, no payslip generated for your previous month.',
            ]);
        }
    }
}
