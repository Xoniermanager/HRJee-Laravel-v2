<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Services\LeaveService;
use App\Http\Services\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\HolidayServices;
use App\Http\Services\EmployeeServices;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\EmployeeAttendanceService;
use App\Http\Services\WeekendService;
use App\Jobs\SendAttendanceReportJob;
use App\Http\Services\BranchServices;
use App\Http\Services\DepartmentServices;

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

    public function index($companyID)
    {
        $allEmployeeDetails = $this->searchFilterDetails(Carbon::now()->month, Carbon::now()->year);

        $companyIDs = [$companyID];
        $branches = $this->branch_services->all($companyIDs);
        $departments = $this->departmentService->getByCompanyId($companyIDs)->get();
        $managers = $this->userService->getAllManagerByCompanyId($companyIDs)->get();

        return view('admin.attendance.index', compact('allEmployeeDetails', 'branches', 'departments', 'managers'));
    }

    public function searchFilter(Request $request)
    {
        $allEmployeeDetails = $this->searchFilterDetails($request->month, $request->year, $request->search, $request->department, $request->manager, $request->branch);

        if ($allEmployeeDetails) {
            if($request->has('export')) {
                dispatch(new SendAttendanceReportJob(auth()->user(), $allEmployeeDetails, $request->month, $request->year));
            } else {
                return response()->json([
                    'data' => view('admin.attendance.list', compact('allEmployeeDetails'))->render()
                ]);
            }
        }
    }

    public function searchFilterDetails($month, $year, $searchKey = null, $deptId = null, $managerId = null, $branchID = null)
    {
        $query = $this->employeeService->getEmployeeQueryByCompanyId(Auth()->user()->company_id); // assume this returns a builder

        // Apply filters
        if (!empty($searchKey)) {
            $query->where(function ($q) use ($searchKey) {
                $q->where('name', 'like', "%$searchKey%")
                ->orWhere('emp_id', 'like', "%$searchKey%");
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

        $allEmployeeDetails = $query->paginate(10);

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

        return view('admin.attendance.view', compact('employeeDetail'));
    }

    public function viewsearchFilterDetails($month, $year, $employeeDetails, $start_date = null, $end_date = null)
    {

        if($start_date != "") {
            $startDate = $start_date;

            if($end_date == "") {
                $endDate = Carbon::createFromDate(date("Y"), date("m"), 1)->endOfMonth();
            } else {
                $endDate = Carbon::createFromFormat('Y-m-d', $end_date);
            }
        } else {
            $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
            $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();
        }

        if ($endDate->format('Y-m') == date('Y-m'))
            $endDate = date('Y-m-d');


        $allAttendanceDetails = [];
        while (strtotime($startDate) <= strtotime($endDate)) {
            $weekendStatus = false;
            $weekDayNumber = date('Y-m-d', strtotime($startDate));
            $checkWeekend = $this->weekendService->getWeekendDetailByWeekdayId($employeeDetails->company_id, $employeeDetails->details->company_branch_id, $employeeDetails->details->department_id, $weekDayNumber);

            if (isset($checkWeekend) && !empty($checkWeekend)) {
                $weekendStatus = true;
            }
            $checkLeave = $this->leaveService->getUserConfirmLeaveByDate($employeeDetails->id, date('Y-m-d', strtotime($startDate)), $endDate);

            $allAttendanceDetails[date('d F Y', strtotime($startDate))] = $this->employeeAttendanceService->getAttendanceByDateByUserId($employeeDetails->id, $startDate)->first();
            $allAttendanceDetails[date('d F Y', strtotime($startDate))]['weekend'] = $weekendStatus;
            $allAttendanceDetails[date('d F Y', strtotime($startDate))]['leave'] = $checkLeave;
            $startDate = date('Y-m-d', strtotime($startDate . ' +1 day'));
        }

        return
            [
                'totalPresent' => $this->employeeAttendanceService->getAllAttendanceByMonthByUserId($month, $employeeDetails->id, $year)->count(),
                'totalLeave'   => $this->leaveService->getTotalLeaveByUserIdByMonth($employeeDetails->id, $month, $year),
                'totalHoliday' => $this->holidayService->getHolidayByMonthByCompanyBranchId(Auth::user()->company_id, $month, $year, $employeeDetails->details->company_branch_id)->count(),
                'shortAttendance' => $this->employeeAttendanceService->getShortAttendanceByMonthByUserId($month,$employeeDetails->id,$year)->count(),
                'totalAbsent' => '0',
                'emp_id'    => $employeeDetails->id,
                'allAttendanceDetails' => $allAttendanceDetails
            ];
    }

    public function searchFilterByEmployeeId(Request $request, $empId)
    {
        $userDetail = $this->employeeService->getUserDetailById($empId);
        $employeeDetail = $this->viewsearchFilterDetails($request->month, $request->year, $userDetail, $request->start_date, $request->end_date);
        if ($employeeDetail) {
            return response()->json([
                'data' => view('admin.attendance.view_list', compact('employeeDetail'))->render()
            ]);
        }
    }
}
