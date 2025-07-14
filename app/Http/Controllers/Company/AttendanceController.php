<?php

namespace App\Http\Controllers\Company;

use Exception;
use Carbon\Carbon;
use App\Models\Leave;
use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Models\EmployeeAttendance;
use Illuminate\Support\Facades\DB;
use App\Http\Services\LeaveService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\BranchServices;
use App\Http\Services\WeekendService;
use App\Jobs\SendAttendanceReportJob;
use App\Http\Services\HolidayServices;
use App\Http\Services\EmployeeServices;
use App\Http\Services\DepartmentServices;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\EmployeeAttendanceService;

class AttendanceController extends Controller
{
    private $branch_services;
    public $employeeService;
    public $employeeAttendanceService;
    public $holidayService;
    public $leaveService;
    public $weekendService;
    public $userService;
    private $departmentService;

    public function __construct(DepartmentServices $departmentService, BranchServices $branch_services, EmployeeServices $employeeService, UserService $userService, EmployeeAttendanceService $employeeAttendanceService, HolidayServices $holidayService, LeaveService $leaveService, WeekendService $weekendService)
    {
        $this->employeeService = $employeeService;
        $this->userService = $userService;
        $this->employeeAttendanceService = $employeeAttendanceService;
        $this->holidayService = $holidayService;
        $this->leaveService = $leaveService;
        $this->weekendService = $weekendService;
        $this->branch_services = $branch_services;
        $this->departmentService = $departmentService;
    }

    public function index()
    {
        $allEmployeeDetails = $this->searchFilterDetails(Carbon::now()->month, Carbon::now()->year);

        $companyIDs = getCompanyIDs();
        $branches = $this->branch_services->all($companyIDs);
        $departments = $this->departmentService->getByCompanyId($companyIDs)->get();
        $managers = $this->userService->getAllManagerByCompanyId($companyIDs)->get();

        return view('company.attendance.index', compact('allEmployeeDetails', 'branches', 'departments', 'managers'));
    }

    public function searchFilter(Request $request)
    {
        $allEmployeeDetails = $this->searchFilterDetails($request->month, $request->year, $request->search, $request->department, $request->manager, $request->branch);
        if ($allEmployeeDetails) {
            if ($request->has('export')) {
                $allEmployeeDetails = $this->searchFilterDetails($request->month, $request->year, $request->search, $request->department, $request->manager, $request->branch, true);
                dispatch(new SendAttendanceReportJob(
                    user: auth()->user(),
                    range: "",
                    allEmployeeDetails: $allEmployeeDetails,
                    month: $request->month,
                    year: $request->year,
                ));
            } else {
                return response()->json([
                    'data' => view('company.attendance.list', compact('allEmployeeDetails'))->render()
                ]);
            }
        }
    }

    public function searchFilterDetails($month, $year, $searchKey = null, $deptId = null, $managerId = null, $branchID = null, $excel = false)
    {
        $query = $this->employeeService->getEmployeeQueryByCompanyId(Auth()->user()->company_id, $month, $year); // assume this returns a builder

        if (!empty($searchKey)) {
            $query->where(function ($q) use ($searchKey) {
                // Search in attendance table
                $q->where('name', 'like', "%$searchKey%")

                    // Or search in the related `details` table using emp_id
                    ->orWhereHas('details', function ($subQuery) use ($searchKey) {
                        $subQuery->where('emp_id', 'like', "%$searchKey%");
                    });
            });
        }

        if (!empty($deptId) || !empty($branchID)) {
            $query->whereHas('details', function ($q) use ($deptId, $branchID) {
                if (!empty($deptId)) {
                    $q->where('department_id', $deptId);
                }
                if (!empty($branchID)) {
                    $q->where('company_branch_id', $branchID);
                }
            });
        }

        if (!empty($managerId)) {
            $query->whereHas('managers', function ($q) use ($managerId) {
                $q->where('manager_id', $managerId);
            });
        }

        if ($excel) {
            $allEmployeeDetails = $query->get();
        } else {
            $allEmployeeDetails = $query->paginate(10);
        }

        foreach ($allEmployeeDetails as $employee) {
            $employee['totalPresent'] = $this->employeeAttendanceService->getAllAttendanceByMonthByUserId($month, $employee->id, $year)->count();
            $employee['totalLeave'] = $this->leaveService->getTotalLeaveByUserIdByMonth($employee->id, $month, $year);
            $employee['totalHoliday'] = $this->holidayService->getHolidayByMonthByCompanyBranchId(Auth()->user()->company_id, $month, $year, $employee->company_branch_id)->count();
        }
        return $allEmployeeDetails;
    }

    public function viewAttendanceDetails($userId)
    {
        $encryptId = getDecryptId($userId);
        $userDetail = $this->employeeService->getUserDetailById($encryptId);
        $employeeDetail = $this->viewsearchFilterDetails(Carbon::now()->month, date('Y'), $userDetail);
        // dd( $employeeDetail);
        return view('company.attendance.view', compact('employeeDetail'));
    }

    public function viewsearchFilterDetails($month, $year, $employeeDetails, $start_date = null, $end_date = null)
    {
        // Step 1: Set Start and End Date
        if ($start_date != "") {
            $startDate = $start_date;

            if ($end_date == "") {
                $endDate = Carbon::createFromDate(date("Y"), date("m"), 1)->endOfMonth();
            } else {
                $endDate = Carbon::createFromFormat('Y-m-d', $end_date);
            }
        } else {
            $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
            $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();
        }

        if ($endDate->format('Y-m') == date('Y-m')) {
            $endDate = date('Y-m-d');
        }

        $allAttendanceDetails = [];

        // Step 2: Loop through each day and build the attendance array
        while (strtotime($startDate) <= strtotime($endDate)) {
            $weekendStatus = false;
            $holidayStatus = false;
            $formattedDate = date('Y-m-d', strtotime($startDate));
            $displayDate = date('d F Y', strtotime($startDate));
            $weekDayNumber = date('m/d/Y', strtotime($startDate)); // Custom weekend format

            // Weekend Check
            $checkWeekend = $this->weekendService->getWeekendDetailByWeekdayId(
                $employeeDetails->company_id,
                $employeeDetails->details->company_branch_id,
                $employeeDetails->details->department_id,
                $weekDayNumber
            );
            if (!empty($checkWeekend)) {
                $weekendStatus = true;
            }

            // Holiday Check
            $checkHoliday = $this->holidayService->getHolidayByDate($employeeDetails->company_id, $startDate, $employeeDetails->details->company_branch_id)->exists();
            if ($checkHoliday) {
                $holidayStatus = true;
            }

            // Leave Check
            $checkLeave = $this->leaveService->getUserConfirmLeaveByDate($employeeDetails->id, $formattedDate, $formattedDate);

            $hasLeave = !empty($checkLeave) ? true : false;            // Attendance Fetch
            // dd($formattedDate, $endDate);
            $attendance = $this->employeeAttendanceService->getAttendanceByuserId($employeeDetails->id, $startDate)->first();
            $allAttendanceDetails[$displayDate] = $attendance;
            $allAttendanceDetails[$displayDate]['weekend'] = $weekendStatus;
            $allAttendanceDetails[$displayDate]['leave'] = $hasLeave;
            $allAttendanceDetails[$displayDate]['holiday'] = $holidayStatus;

            $startDate = date('Y-m-d', strtotime($startDate . ' +1 day'));
        }
        // Step 3: Calculate Total Absent
        $totalAbsent = 0;
        foreach ($allAttendanceDetails as $day => $attendance) {
            $isWeekend = $attendance['weekend'] ?? false;
            $isHoliday = $attendance['holiday'] ?? false;
            $isLeave = $attendance['leave'] ?? false;
            $hasAttendance = !empty($attendance['id'] ?? null);

            if (!$isWeekend && !$isHoliday && !$isLeave && !$hasAttendance) {
                $totalAbsent++;
            }
        }
        // Step 4: Return Final Summary
        return [
            'totalPresent' => $this->employeeAttendanceService->getAllAttendanceByMonthByUserId($month, $employeeDetails->id, $year)->count(),
            'totalLeave' => $this->leaveService->getTotalLeaveByUserIdByMonth($employeeDetails->id, $month, $year),
            'totalHoliday' => $this->holidayService->getHolidayByMonthByCompanyBranchId(Auth::user()->company_id,$month,$year,$employeeDetails->details->company_branch_id)->count(),
            'shortAttendance' => $this->employeeAttendanceService->getShortAttendanceByMonthByUserId($month, $employeeDetails->id, $year)->count(),
            'totalHalfDay' => $this->employeeAttendanceService->getTotalHalfDayByMonthByUserId($month, $employeeDetails->id, $year)->count(),
            'getTotalHalfDayByMonthByUserId' => $this->employeeAttendanceService->getTotalHalfDayByMonthByUserId($month, $employeeDetails->id, $year)->count(),
            'totalAbsent' => $totalAbsent,
            'totalLate' => $this->employeeAttendanceService->getLateAttendanceByMonthByUserId($month, $employeeDetails->id, $year)->count(),
            'emp_id' => $employeeDetails->id,
            'allAttendanceDetails' => $allAttendanceDetails
        ];
    }

    public function searchFilterByEmployeeId(Request $request, $empId)
    {
        $userDetail = $this->employeeService->getUserDetailById($empId);
        $employeeDetail = $this->viewsearchFilterDetails($request->month, $request->year, $userDetail, $request->start_date, $request->end_date);
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
        $request['company_id'] = Auth()->user()->company_id;
        $request['created_by'] = Auth()->user()->id;
        $attendance = $this->employeeAttendanceService->editAttendanceByUserId($request->all());
        if ($attendance) {
            return response()->json(['status' => true, 'message' => 'Attendance Updated']);
        } else {
            return response()->json(['status' => false, 'message' => 'Please Try Again']);
        }
    }

    public function addBulkAttendance()
    {
        $allEmployeeDetails = $this->employeeService->getAllEmployeeByCompanyId(Auth()->user()->company_id)->get();
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
            'punch_out' => 'sometimes|nullable|date_format:H:i|after:punch_in',
            'remark' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            DB::beginTransaction();
            $request['punch_in_using'] = 'Web';
            $request['punch_in_by'] = 'Company';
            $request['company_id'] = Auth()->user()->company_id;
            $request['created_by'] = Auth()->user()->id;

            $response = $this->employeeAttendanceService->addBulkAttendance($request->all());

            if ($response == true) {
                DB::commit();
                return redirect()->route('attendance.index')->with('success', 'Attendance created successfully!');
            } else {
                return back()->with(['error' => 'Attendance already exists for the respective dates or might be a company holiday.']);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return back()->with(['error' => 'An unexpected error occurred. Please try again.']);
        }
    }

    public function downloadAttendance(Request $request)
    {
        $request->validate([
            'range' => 'required|in:previous_month,previous_year,previous_quarter,current_month,current_year,current_quarter,custom',
            'from' => 'required_if:range,custom',
            'to' => 'required_if:range,custom',
        ]);

        $user = auth()->user();

        // Dispatch background job
        dispatch(new SendAttendanceReportJob($user, $request->range, $request->from, $request->to));

        return response()->json(['status' => 'success', 'message' => 'Attendance report will be sent to your email shortly.']);
    }

    public function todayStats()
    {
        $today = Carbon::today()->toDateString();
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $totalEmployeeIds = $this->employeeService
            ->getEmployeeQueryByCompanyId(Auth::user()->company_id, $month, $year)
            ->pluck('id');

        $total = $totalEmployeeIds->count();

        $present = EmployeeAttendance::whereIn('user_id', $totalEmployeeIds)
            ->whereDate('punch_in', $today)
            ->count();

        $leave = Leave::whereIn('user_id', $totalEmployeeIds)
            ->whereDate('from', '<=', $today)
            ->whereDate('to', '>=', $today)
            ->where('leave_status_id', 2) // Approved leave
            ->count();

        $absent = $total - $present - $leave;

        return response()->json([
            'total' => $total,
            'present' => $present,
            'leave' => $leave,
            'absent' => max($absent, 0), // make sure it's not negative
        ]);
    }
}
