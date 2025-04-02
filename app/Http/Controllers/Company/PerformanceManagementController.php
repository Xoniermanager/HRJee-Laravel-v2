<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Models\EmployeeAttendance;
use App\Models\Holiday;
use App\Models\Weekend;
use App\Models\PerformanceManagement;
use App\Models\Leave;
use App\Http\Services\LeaveService;
use App\Http\Controllers\Controller;
use App\Http\Services\HolidayServices;
use App\Http\Services\EmployeeServices;
use App\Http\Services\EmployeeAttendanceService;
use App\Http\Services\WeekendService;
use App\Http\Services\UserService;
use Carbon\Carbon;


class PerformanceManagementController extends Controller
{
    public $employeeService;
    public $employeeAttendanceService;
    public $holidayService;
    public $leaveService;
    public $weekendService;
    public $userService;

    public function __construct(UserService $userService, EmployeeServices $employeeService, EmployeeAttendanceService $employeeAttendanceService, HolidayServices $holidayService, LeaveService $leaveService, WeekendService $weekendService)
    {
        $this->employeeService = $employeeService;
        $this->employeeAttendanceService = $employeeAttendanceService;
        $this->holidayService = $holidayService;
        $this->leaveService = $leaveService;
        $this->weekendService = $weekendService;
        $this->userService = $userService;
    }

    public function index()
    {
        $allEmployeeDetails = $this->userService->getActiveEmployees(auth()->user()->id)->get();

        return view('company.performance_management.add', compact('allEmployeeDetails'));
    }

    public function getSkills($userID)
    {
        $user = $this->userService->getUserSkillsByUserId($userID)->with('skill')->first();
        
        return response()->json([
            'data' => $user->skill,
            'status' => true
        ]);
        
    }

    public function filterPerformance(Request $request)
    {
        // Get start and end date from request
        $dates = explode(' - ', $request->dateRange);
        $startDate = $dates[0];
        $endDate = $dates[1];
        $userID = $request->userID;

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
        $attendanceRank = ($attendancePercentage >= 100 ? "Good" : ($attendancePercentage < 90 && $attendancePercentage < 80 ? "Moderate" : "Low"));
        $leaveRank = ($unapprovedLeaves < 1 ? "Good" : ($unapprovedLeaves <= 3 ? "Moderate" : "Low"));
        
        return response()->json(['attendanceRank' => $attendanceRank, "leaveRank" => $leaveRank]);
    }

    public function addPerformance(Request $request) {
        $data = $request->all();
        $dates = explode(' - ', $request->daterange);
        $startDate = $dates[0];
        $endDate = $dates[1];

        $data['company_id'] = auth()->user()->id;
        $data['start_date'] = $startDate;
        $data['end_date'] = $endDate;
        PerformanceManagement::create($data);

        return redirect(route('performance-management.index'))->with('success', 'Review Submitted Succesfully');

    }
    
}
