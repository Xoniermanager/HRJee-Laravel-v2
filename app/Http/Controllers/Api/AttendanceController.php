<?php

namespace App\Http\Controllers\Api;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\UserMonthlySalary;
use App\Http\Services\LeaveService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Services\WeekendService;
use App\Http\Services\HolidayServices;
use App\Http\Services\EmployeeServices;
use Illuminate\Support\Facades\Storage;
use App\Exports\EmployeeAttendanceExport;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\AttendanceRequestService;
use App\Http\Services\EmployeeAttendanceService;
use App\Http\Services\GenerateSalaryService;
use App\Http\Services\TaxSlabRuleService;
use App\Models\UserCtcHistory;

class AttendanceController extends Controller
{
    public $employeeAttendanceService;
    public $employeeService;
    public $attendanceRequestService;
    public $leaveService;
    public $holidayService;
    public $weekendService;
    public $taxSlabRateService;
    public $generateSalaryService;

    public function __construct(EmployeeAttendanceService $employeeAttendanceService, EmployeeServices $employeeService, AttendanceRequestService $attendanceRequestService, LeaveService $leaveService, HolidayServices $holidayService, WeekendService $weekendService, TaxSlabRuleService $taxSlabRateService, GenerateSalaryService $generateSalaryService)
    {
        $this->employeeAttendanceService = $employeeAttendanceService;
        $this->employeeService = $employeeService;
        $this->attendanceRequestService = $attendanceRequestService;
        $this->leaveService = $leaveService;
        $this->holidayService = $holidayService;
        $this->weekendService = $weekendService;
        $this->taxSlabRateService = $taxSlabRateService;
        $this->generateSalaryService = $generateSalaryService;
    }
    public function makeAttendance(Request $request)
    {
        try {
            $data = $request->all();
            $data['punch_in_using'] = 'Mobile';
            $data['force'] = $request->force;
            $attendanceDetails = $this->employeeAttendanceService->create($data);
            if ($attendanceDetails['status'] === true && $attendanceDetails['data'] === 'Punch Out') {
                return response()->json([
                    'status' => true,
                    'punch_out' => true,
                    'message' => "You Punched Out Successfully"
                ], 200);
            }
            if ($attendanceDetails['status'] === true && $attendanceDetails['data'] === 'Punch In') {
                return response()->json([
                    'status' => true,
                    'punch_in' => true,
                    'message' => "You Punched In Successfully"
                ], 200);
            }
            if ($attendanceDetails['status'] == false && isset($attendanceDetails['before_punchout_confirm_required'])) {
                return response()->json([
                    'status' => false,
                    'before_punchout_confirm_required' => $attendanceDetails['before_punchout_confirm_required'],
                    'message' => $attendanceDetails['message']
                ], 200);
            }
            if ($attendanceDetails['status'] === false) {
                return response()->json([
                    'status' => false,
                    'attendance_status' => false,
                    'message' => $attendanceDetails['message'] ?? "You are not allowed to Punch In at this time.",
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function makeAttendanceUsingFace(Request $request)
    {
        try {
            $data = $request->all();
            $data['punch_in_using'] = 'Face';

            $attendanceDetails = $this->employeeAttendanceService->createUsingFace($data);

            if ($attendanceDetails['status'] === true && $attendanceDetails['message'] === 'Punch Out') {
                return response()->json([
                    'status' => true,
                    'punch_out' => true,
                    'message' => "You Punched Out Successfully",
                    'data' => $attendanceDetails['data']
                ], 200);
            }
            if ($attendanceDetails['status'] === true && $attendanceDetails['message'] === 'Punch In') {
                return response()->json([
                    'status' => true,
                    'punch_in' => true,
                    'message' => "You Punched In Successfully",
                    'data' => $attendanceDetails['data']
                ], 200);
            }
            if ($attendanceDetails['status'] == false && isset($attendanceDetails['before_punchout_confirm_required'])) {
                return response()->json([
                    'status' => false,
                    'before_punchout_confirm_required' => $attendanceDetails['before_punchout_confirm_required'],
                    'message' => $attendanceDetails['message']
                ], 200);
            }
            if ($attendanceDetails['status'] === false) {
                return response()->json([
                    'status' => false,
                    'attendance_status' => false,
                    'message' => $attendanceDetails['message'] ?? "You are not allowed to Punch In at this time.",
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }


    public function getTodaysShifts(Request $request)
    {
        try {
            $shifts = $this->employeeAttendanceService->getTodaysShifts();

            return response()->json([
                'status' => true,
                'data' => $shifts,
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
                            'total_hours' => getTotalWorkingHour($attendanceDetails->punch_in, $attendanceDetails->punch_out),
                            'punch_in' => $attendanceDetails->punch_in,
                            'punch_out' => $attendanceDetails->punch_out
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

    public function generatePaySlip(Request $request)
    {
        $employeeId = Auth()->guard('employee_api')->user()->id;
        $employeeDetails = User::find($employeeId);
        $year = $request->get('year');
        $month = $request->get('month');
        $date = Carbon::create($year, $month, 1);

        // Check for existing monthly salary details
        $monthlySalaryDetails = UserMonthlySalary::where('user_id', $employeeId)
            ->where('year', $year)
            ->where('month', $month)
            ->first();

        // Prepare the response data
        $data = [
            'employeeSalary' => $employeeDetails,
            'status' => true,
        ];

        if ($monthlySalaryDetails) {
            // Existing payslip found
            $data['getEmployeeMonthlySalary'] = [
                'others' => $monthlySalaryDetails->toArray(),
                'monthlyCtc' => $monthlySalaryDetails->monthly_ctc,
                'components' => $monthlySalaryDetails->userMonthlySalaryComponentLog->toArray(),
            ];
            $data['mail'] = $monthlySalaryDetails->mail_send;
        } else {
            // No existing payslip, calculate new salary
            $userCTCDetails = UserCtcHistory::where('user_id', $employeeId)
                ->whereDate('effective_date', '<=', $date->startOfMonth())
                ->orderBy('id', 'DESC')
                ->first();  

            if (!$userCTCDetails) {
                return response()->json(['status' => false, 'message' => 'No payslip found for this employee for the respective month and year']);
            }

            $ctcValue = $userCTCDetails->ctc_value;
            $salaryComponents = $userCTCDetails->userCtcComponentHistory;
            $applicableTaxRates = $this->taxSlabRateService->getActiveTaxSlab($employeeDetails->company_id);
            $totalDayPresent = $this->employeeAttendanceService->getTotalWorkingDaysByUserId($year, $month, $employeeId)->first();

            if (!$totalDayPresent || $totalDayPresent->total_present <= 0) {
                return response()->json(['status' => false, 'message' => "No attendance found for the previous month"]);
            }

            $totalWorking = $date->daysInMonth;
            $workingDays = round($totalWorking - $totalDayPresent->total_present, 2);
            $lossOfPay = 0;

            $getEmployeeMonthlySalary = $this->generateSalaryService->getEmployeeMonthlySalary($ctcValue, $salaryComponents, $applicableTaxRates, $totalWorking, $lossOfPay);
            $getEmployeeCtcComponents = $this->generateSalaryService->getEmployeeCtcComponents($ctcValue, $salaryComponents, $applicableTaxRates);
            $userMonthlySalary = $this->generateSalaryService->createUserMonthlySalary($getEmployeeMonthlySalary, [
                'user_id' => $employeeId,
                'year' => $year,
                'month' => $month,
            ]);

            $data['getEmployeeMonthlySalary'] = [
                'monthlyCtc' => $getEmployeeMonthlySalary,
                'components' => $getEmployeeCtcComponents,
            ];
            $data['mail'] = $userMonthlySalary->mail_send;
        }

        $pdf = PDF::loadView('salary_temp', ['data' => $data]);
        $fileName = removingSpaceMakingName($employeeDetails->name) . '-' . Carbon::now()->subMonth()->format('n') . '_salary.pdf';
        $filePath = '/salaries/' . $fileName;
        Storage::disk('public')->put($filePath, $pdf->output());

        return response()->json(['status' => true, 'file_url' => url("storage" . $filePath)]);
    }
    // public function generatePaySlip(Request $request)
    // {
    //     $employeeDetails = User::find(Auth()->guard('employee_api')->user()->id);
    //     $checkExistingMonthDetails = UserMonthlySalary::where('user_id', Auth()->guard('employee_api')->user()->id)->where('year', $request->get('year'))->where('month', $request->get('month'))->first();
    //     $data = [];
    //     if (isset($checkExistingMonthDetails) && !empty($checkExistingMonthDetails)) {
    //         $data['getEmployeeMonthlySalary']['others'] = $checkExistingMonthDetails->toArray();
    //         $data['getEmployeeMonthlySalary']['monthlyCtc'] = $checkExistingMonthDetails->monthly_ctc;
    //         $data['getEmployeeMonthlySalary']['components'] = $checkExistingMonthDetails->userMonthlySalaryComponentLog->toArray();
    //         $data['employeeSalary'] = $employeeDetails;
    //         $data['status'] = true;
    //         $data['mail'] = $checkExistingMonthDetails->mail_send;
    //         $pdf = PDF::loadView('salary_temp', ['data' => $data]);
    //         $fileName = removingSpaceMakingName($employeeDetails->name) . '-' . Carbon::now()->subMonth()->format('n') . '_salary.pdf';
    //         $filePath = '/salaries/' . $fileName;
    //         Storage::disk('public')->put($filePath, $pdf->output());
    //         return response()->json(['status' => true, 'file_url' => url("storage" . $filePath)]);
    //     } else {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Sorry, no payslip generated for your previous month.',
    //         ]);
    //     }
    // }

    public function storeAttendanceRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date|before_or_equal:today',
            'punch_in' => 'required|date_format:H:i',
            'punch_out' => 'required|date_format:H:i|after:punch_in',
            'reason' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 400);
        }
        try {
            $data = $request->all();
            $data['user_id'] = Auth()->user()->id;
            $data['company_id'] = Auth()->user()->company_id;
            $data['created_by'] = Auth()->user()->id;
            if ($this->attendanceRequestService->storeAttendanceRequest($data)) {
                return response()->json([
                    'status' => true,
                    'message' => "Attendance Request Added Successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Unable to Add Attendance Request Please try Again"
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "error" => $e->getMessage(),
                "message" => "Unable to Add the Attendance Request"
            ], 500);
        }
    }
    public function detailsAttendanceRequest($requestId)
    {
        try {
            $attendanceRequestDetails = $this->attendanceRequestService->getRequestDetailsByRequestId($requestId);
            return response()->json([
                'status' => true,
                'message' => "Attendance Request Details",
                'data' => $attendanceRequestDetails
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "error" => $e->getMessage(),
                "message" => "Unable to Fetch Attendance Request"
            ], 500);
        }
    }

    public function updateAttendanceRequest(Request $request, $requestId)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date|before_or_equal:today',
            'punch_in' => 'required|date_format:H:i',
            'punch_out' => 'required|date_format:H:i|after:punch_in',
            'reason' => 'required|string|max:255',
        ],);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 400);
        }
        try {
            $data = $request->all();
            if ($this->attendanceRequestService->updateAttendanceRequest($data, $requestId)) {
                return response()->json([
                    'status' => true,
                    'message' => "Attendance Request Update Successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Unable to Update Attendance Request Please try Again"
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "error" => $e->getMessage(),
                "message" => "Unable to Update the Attendance Request"
            ], 500);
        }
    }

    public function deleteAttendanceRequest($requestId)
    {
        try {
            if ($this->attendanceRequestService->deleteAttendanceRequest($requestId)) {
                return response()->json([
                    'status' => true,
                    'message' => "Attendance Request Deleted Successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Unable to Deleted Attendance Request Please try Again"
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "error" => $e->getMessage(),
                "message" => "Unable to Deleted the Attendance Request"
            ], 500);
        }
    }

    public function getAllAttendanceRequestList()
    {
        try {
            $attendanceRequestDetails = $this->attendanceRequestService->getAttendanceRequestByUserId(Auth()->guard('employee_api')->user()->id)->paginate(10);
            return response()->json([
                'status' => true,
                'message' => "All Attendance Request List",
                'data' => $attendanceRequestDetails
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "error" => $e->getMessage(),
                "message" => "Unable to Fetch Attendance Request"
            ], 500);
        }
    }

    public function attendanceDetailsbyMonth($month)
    {
        try {
            $year = date('Y');
            $month = $month ?? date('m');
            $employeeDetails = Auth()->user();

            $selectedDate = Carbon::createFromDate($year, $month, 1);
            $startDate = $selectedDate->startOfMonth()->toDateString();

            if ($selectedDate->isFuture()) {
                // Don't show any future attendance
                $endDate = now()->toDateString(); // Or skip processing by returning empty dataset
            } elseif ($selectedDate->isSameMonth(now())) {
                $endDate = now()->toDateString(); // Up to today for current month
            } else {
                $endDate = $selectedDate->endOfMonth()->toDateString(); // Full month for past months
            }

            $leaveDetail = $this->leaveService->getTotalLeaveByUserIdByMonth($employeeDetails->id, $month, $year, 1);
            $attendanceDetails = $this->employeeAttendanceService->getEmployeeAttendanceBetweenTwoDates(
                $employeeDetails->id,
                $employeeDetails->company_id,
                $employeeDetails->details->company_branch_id,
                $employeeDetails->details->department_id,
                $startDate,
                $endDate
            );

            $attendanceByMonth = $this->employeeAttendanceService->getAllAttendanceByMonthByUserId($month, $employeeDetails->id, $year);
            $shortAttendance = $this->employeeAttendanceService->getShortAttendanceByMonthByUserId($month, $employeeDetails->id, $year);
            $holidayDetails = $this->holidayService->getHolidayByMonthByCompanyBranchId(
                $employeeDetails->company_id,
                $month,
                $year,
                $employeeDetails->details->company_branch_id
            )->select('date', 'name as title')->get();

            $data = [
                'attendanceDetails' => $attendanceByMonth->get('punch_in'),
                'totalPresent' => $attendanceByMonth->count(),
                'totalLeave' => $this->leaveService->getTotalLeaveByUserIdByMonth($employeeDetails->id, $month, $year),
                'leaveDetails' => $leaveDetail,
                'totalHalfDayLeave' => $leaveDetail->where('is_half_day', 1)->count(),
                'totalHoliday' => $holidayDetails->count(),
                'holidayDetails' => $holidayDetails ?? [],
                'shortAttendance' => $shortAttendance->count(),
                'shortAttendanceDetails' => $shortAttendance->get('punch_in'),
                'totalAbsent' => count($attendanceDetails['absences'] ?? []),
                'absentDetails' => $attendanceDetails['absences'] ?? [],
            ];

            return response()->json([
                'status' => true,
                'message' => "All Attendance Details",
                'data' => $data
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "error" => $e->getMessage(),
                "message" => "Unable to Fetch Attendance Details"
            ], 500);
        }
    }
}
