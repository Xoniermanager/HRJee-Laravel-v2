<?php

namespace App\Http\Controllers\Employee;

use Exception;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Models\Holiday;
use App\Models\Weekend;
use App\Models\PerformanceManagement;
use App\Models\CategoryPerformanceRecord;
use App\Models\PerformanceReview;
use App\Models\Leave;
use App\Http\Services\LeaveService;
use App\Http\Controllers\Controller;
use App\Http\Services\HolidayServices;
use App\Http\Services\EmployeeServices;
use App\Http\Services\EmployeeAttendanceService;
use App\Http\Services\WeekendService;
use App\Http\Services\UserService;
use App\Http\Services\PerformanceManagementService;
use App\Http\Services\PerformanceCategoryService;
use Carbon\Carbon;
use App\Http\Services\PerformanceCycleService;


class PerformanceManagementController extends Controller
{
    public $employeeService;
    public $employeeAttendanceService;
    public $holidayService;
    public $leaveService;
    public $weekendService;
    public $userService;
    public $performanceManagementService;
    public $performanceCategoryService;
    private $performanceCycleService;

    public function __construct(PerformanceCategoryService $performanceCategoryService, PerformanceManagementService $performanceManagementService, UserService $userService, EmployeeServices $employeeService, EmployeeAttendanceService $employeeAttendanceService, HolidayServices $holidayService, LeaveService $leaveService, WeekendService $weekendService, PerformanceCycleService $performanceCycleService)
    {
        $this->employeeService = $employeeService;
        $this->employeeAttendanceService = $employeeAttendanceService;
        $this->holidayService = $holidayService;
        $this->leaveService = $leaveService;
        $this->weekendService = $weekendService;
        $this->userService = $userService;
        $this->performanceManagementService = $performanceManagementService;
        $this->performanceCategoryService = $performanceCategoryService;
        $this->performanceCycleService = $performanceCycleService;
    }

    public function index()
    {
        $allPerformances = $this->performanceManagementService->getPerformancesByUserId(auth()->user()->id)->get();
        
        return view('employee.performance_management.index', compact('allPerformances'));
    }

    public function filterPerformance(Request $request)
    {
        // Get start and end date from request
        $dates = explode(' - ', $request->dateRange);
        $startDate = $dates[0];
        $endDate = $dates[1];
        $userID = $request->userID;

        if($userID == "" || $dates == "") {

            return response()->json(['success' => false, "message" => "Please select user and date range"]);
        }

        $startDate = Carbon::parse($startDate)->startOfDay(); // Ensure start of the day
        $endDate = Carbon::parse($endDate)->endOfDay(); // Ensure end of the day

        //Total Working Days (Excluding Holidays & Weekends)
        $allDates = collect(Carbon::parse($startDate)->toPeriod($endDate));
        
        $holidays = Holiday::whereBetween('date', [$startDate, $endDate])->pluck('date')->toArray();
        $weekends = Weekend::whereJsonContains('weekend_dates', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('weekend_dates', [$startDate, $endDate]);
        })->pluck('weekend_dates')->flatten()->toArray();
        
        $nonWorkingDays = array_merge($holidays, $weekends);
        $workingDays = $allDates->reject(fn($date) => in_array($date->toDateString(), $nonWorkingDays))->count();

        //Attendance Stats
        $attendances = EmployeeAttendance::where('user_id', $userID)
            ->whereBetween('punch_in', [$startDate, $endDate])
            ->get();

        $presentDays = $attendances->count();
        $unapprovedLeaves = Leave::where('user_id', $userID)
            ->where('leave_status_id', '!=', 1) // Not Approved
            ->whereBetween('from', [$startDate, $endDate])
            ->count();

        //Performance Score Calculation
        $attendancePercentage = ($presentDays / $workingDays) * 100;
        $attendanceRank = ($attendancePercentage >= 90 ? "EXCELLENT" : ($attendancePercentage < 90 && $attendancePercentage > 80 ? "GOOD" : (($attendancePercentage < 80 && $attendancePercentage < 70) ? "SATISFACTORY" : "UNSATISFACTORY")));

        $leaveRank = ($unapprovedLeaves < 1 ? "EXCELLENT" : ($unapprovedLeaves <= 2 ? "GOOD" :  (($unapprovedLeaves <= 3) ? "SATISFACTORY" : "UNSATISFACTORY")));
        
        return response()->json(['success' => true, 'attendanceRank' => $attendanceRank, "leaveRank" => $leaveRank]);
    }

    public function view(Request $request, $id) {
        
        $companyIDs = getCompanyIDs();
        $allEmployeeDetails = $this->userService->getActiveEmployees($companyIDs)->get();
        $allCategories = $this->performanceCategoryService->all($companyIDs);
        $performance = $this->performanceManagementService->getDetailsById($id);
        $performanceCycles = $this->performanceCycleService->all($companyIDs);

        $categories = [];
        foreach($performance->categoryRecords as $categoryRecord) {
            $categories[$categoryRecord->performance_category_id] = $categoryRecord->performance;
        }

        return view('employee.performance_management.view', compact('allEmployeeDetails', 'allCategories', 'performance', 'categories', 'performanceCycles'));
    }
}
