<?php

namespace App\Http\Controllers\Company;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use Illuminate\Support\Facades\DB;
use App\Http\Services\LeaveService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\HolidayServices;
use App\Http\Services\EmployeeServices;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\EmployeeAttendanceService;
use App\Http\Services\WeekendService;

class AttendanceController extends Controller
{
    public $employeeService;
    public $employeeAttendanceService;
    public $holidayService;
    public $leaveService;
    public $weekendService;

    public function __construct(EmployeeServices $employeeService, EmployeeAttendanceService $employeeAttendanceService, HolidayServices $holidayService, LeaveService $leaveService, WeekendService $weekendService)
    {
        $this->employeeService = $employeeService;
        $this->employeeAttendanceService = $employeeAttendanceService;
        $this->holidayService = $holidayService;
        $this->leaveService = $leaveService;
        $this->weekendService = $weekendService;
    }
    public function index()
    {
        $allEmployeeDetails = $this->searchFilterDetails(Carbon::now()->month, Carbon::now()->year);
        return view('company.attendance.index', compact('allEmployeeDetails'));
    }

    public function searchFilter(Request $request)
    {
        $allEmployeeDetails = $this->searchFilterDetails($request->month, $request->year, $request->search);
        if ($allEmployeeDetails) {
            return response()->json([
                'data' => view('company.attendance.list', compact('allEmployeeDetails'))->render()
            ]);
        }
    }

    public function searchFilterDetails($month, $year, $searchKey = null)
    {
        if (isset($searchKey) && !empty($searchKey)) {
            $allEmployeeDetails = $this->employeeService->getEmployeeByNameByEmpIdFilter(Auth::guard('company')->user()->id, $searchKey)->paginate(10);
        } else {
            $allEmployeeDetails = $this->employeeService->getAllEmployeeByCompanyId(Auth::guard('company')->user()->id)->paginate(10);
        }
        foreach ($allEmployeeDetails as $employee) {
            $employee['totalPresent'] = $this->employeeAttendanceService->getAllAttendanceByMonthByUserId($month, $employee->id, $year)->count();
            $employee['totalLeave'] = $this->leaveService->getTotalLeaveByUserIdByMonth($employee->id, $month, $year);
            $employee['totalHoliday'] = $this->holidayService->getHolidayByMonthByCompanyBranchId(Auth::guard('company')->user()->id, $month, $year, $employee->company_branch_id)->count();
        }
        return $allEmployeeDetails;
    }

    public function viewAttendanceDetails($userId)
    {
        $encryptId = getDecryptId($userId);
        $userDetail = $this->employeeService->getUserDetailById($encryptId);
        $employeeDetail = $this->viewsearchFilterDetails(Carbon::now()->month, date('Y'), $userDetail);
        return view('company.attendance.view', compact('employeeDetail'));
    }

    public function viewsearchFilterDetails($month, $year, $employeeDetails)
    {
        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();
        if ($endDate->format('Y-m') == date('Y-m'))
            $endDate = date('Y-m-d');
        $allAttendanceDetails = [];
        while (strtotime($startDate) <= strtotime($endDate)) {
            $weekendStatus = false;
            $weekDayNumber = date('N', strtotime($startDate));
            $checkWeekend = $this->weekendService->getWeekendDetailByWeekdayId($employeeDetails->company_id, $employeeDetails->company_branch_id, $employeeDetails->department_id, $weekDayNumber);
            if (isset($checkWeekend) && !empty($checkWeekend)) {
                $weekendStatus = true;
            }
            $allAttendanceDetails[date('d F Y', strtotime($startDate))] = $this->employeeAttendanceService->getAttendanceByDateByUserId($employeeDetails->id, $startDate)->first();
            $allAttendanceDetails[date('d F Y', strtotime($startDate))]['weekend'] = $weekendStatus;
            $startDate = date('Y-m-d', strtotime($startDate . ' +1 day'));
        }
        return
            [
                'totalPresent' => $this->employeeAttendanceService->getAllAttendanceByMonthByUserId($month, $employeeDetails->id, $year)->count(),
                'totalLeave'   => $this->leaveService->getTotalLeaveByUserIdByMonth($employeeDetails->id, $month, $year),
                'totalHoliday' => $this->holidayService->getHolidayByMonthByCompanyBranchId(Auth::guard('company')->user()->id, $month, $year, $employeeDetails->company_branch_id)->count(),
                'shortAttendance' => '0',
                'totalAbsent' => '0',
                'emp_id'    => $employeeDetails->id,
                'allAttendanceDetails' => $allAttendanceDetails
            ];
    }
    public function searchFilterByEmployeeId(Request $request, $empId)
    {
        $userDetail = $this->employeeService->getUserDetailById($empId);
        $employeeDetail = $this->viewsearchFilterDetails($request->month, $request->year, $userDetail);
        if ($employeeDetail) {
            return response()->json([
                'data' => view('company.attendance.view_list', compact('employeeDetail'))->render()
            ]);
        }
    }

    public function editAttendanceByEmployeeId(Request $request)
    {
        $request['punch_in_using'] = 'Web';
        $request['punch_in_by'] = 'Company';
        $attendance = $this->employeeAttendanceService->editAttendanceByUserId($request->all());
        if ($attendance) {
            return response()->json(['status' => true, 'message' => 'Attendance Updated']);
        } else {
            return response()->json(['status' => false, 'message' => 'Please Try Again']);
        }
    }

    public function addBulkAttendance()
    {
        $allEmployeeDetails = $this->employeeService->getAllEmployeeByCompanyId(Auth::guard('company')->user()->id)->paginate(10);
        return view('company.attendance.add_bulk', compact('allEmployeeDetails'));
    }

    public function storeBulkAttendance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|array|min:1',
            'employee_id.*' => 'exists:users,id',
            'from_date' => 'required|date|before_or_equal:to_date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'punch_in' => 'required|date_format:H:i|before:punch_out',
            'punch_out' => 'required|date_format:H:i|after:punch_in',
            'remark' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction(); // Start the transaction
        try {
            $request['punch_in_using'] = 'Web';
            $request['punch_in_by'] = 'Company';
            $response = $this->employeeAttendanceService->addBulkAttendance($request->all());
            DB::commit();
            if ($response == true)
                return redirect()->route('attendance.index')->with('success', 'Attendance created successfully!');
            else
                return back()->with(['error' => 'Attendance already exists for the respective dates or might be a company holiday.']);
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with(['error' => 'An unexpected error occurred. Please try again.']);
        }
    }
}
