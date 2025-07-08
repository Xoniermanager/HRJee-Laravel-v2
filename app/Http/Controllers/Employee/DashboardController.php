<?php

namespace App\Http\Controllers\Employee;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Services\BreakTypeService;
use App\Http\Services\UserShiftService;
use App\Http\Services\EmployeeAttendanceService;
use App\Http\Services\EmployeeBreakHistoryService;

class DashboardController extends Controller
{
    private $employeeAttendanceService;
    private $breakTypeService;
    private $userShiftService;

    private $employeeBreakHistoryService;

    public function __construct(UserShiftService $userShiftService, EmployeeAttendanceService $employeeAttendanceService, BreakTypeService $breakTypeService, EmployeeBreakHistoryService $employeeBreakHistoryService)
    {
        $this->employeeAttendanceService = $employeeAttendanceService;
        $this->breakTypeService = $breakTypeService;
        $this->userShiftService = $userShiftService;
        $this->employeeBreakHistoryService = $employeeBreakHistoryService;
    }

    public function index()
    {
        // dd(Auth()->user()->allManagerUsers()->unique());
        // dd(Auth()->user()->allManagersWithLevel());
        // dd(Auth()->user()->topLevelNumber());
        // dd(Auth()->user()->isTopLevelManager(auth()->id()));

        $shiftIDs = $this->userShiftService->getTodaysShifts(Auth()->user()->id, Auth()->user()->details->shift_type)->pluck('shift_id')->toArray();

        $existingAttendanceDetail = $this->employeeAttendanceService->getExtistingDetailsByUserId(Auth()->user()->id, Auth()->user()->details->shift_type);

        $currentAttendanceDetail = $this->employeeAttendanceService->getCurrentAttendanceByUserId(Auth()->user()->id);

        $todaysShifts = $this->userShiftService->getTodaysShifts(Auth()->user()->id, Auth()->user()->details->shift_type)->with('shift')->get();

        $now = now();
        $nextUpcomingShift = $todaysShifts->filter(function ($shift) use ($now) {
            return $now->lt(Carbon::parse($shift->shift->start_time));
        })->sortBy(function ($shift) {
            return Carbon::parse($shift->shift->start_time);
        })->first();

        if ($nextUpcomingShift && $currentAttendanceDetail) {
            $attendanceDate = date("Y-m-d", strtotime($currentAttendanceDetail->punch_in));
            $startTime = Carbon::parse($nextUpcomingShift->shift->start_time);
            $currentShiftStartTime = Carbon::parse($currentAttendanceDetail->shift_start_time);
            $currentShiftEndTime = Carbon::parse($attendanceDate . ' ' . $currentAttendanceDetail->shift_end_time);

            // Check if current time is within check_out_buffer minutes before the shift starts and also the current shift time is over
            $timeGap = $now->between($startTime->copy()->subMinutes($nextUpcomingShift->shift->check_in_buffer), $startTime);
            $timeOver = $currentShiftEndTime->lessThanOrEqualTo($now);

            if ($timeGap && $timeOver) {
                $currentAttendanceDetail->update([
                    'punch_out' => date('Y-m-d H:i:s'),
                    'is_auto_punch_out' => 1
                ]);
                $currentAttendanceDetail = null;
            }
        }

        $allBreakTypeDetails = $this->breakTypeService->getAllBreakTypeByCompanyId(Auth()->user()->company_id);
        $takenBreakDetails = "";

        if (count($existingAttendanceDetail)) {
            foreach($existingAttendanceDetail as $key => $attendanceDetails) {
                $existingAttendanceDetail[$key]['takenBreakDetails'] = $this->employeeBreakHistoryService->getBreakHistoryByAttendanceId($attendanceDetails['id']);

                $existingAttendanceDetail[$key]['totalBreakHour'] = $this->employeeBreakHistoryService->getTotalBreakHour($attendanceDetails['id']);
            }
        }

        if ($currentAttendanceDetail) {
            $takenBreakDetails = $this->employeeBreakHistoryService->getBreakHistoryByAttendanceId($currentAttendanceDetail->id);

            $currentAttendanceDetail['totalBreakHour'] = $this->employeeBreakHistoryService->getTotalBreakHour($currentAttendanceDetail->id);
        }

        return view('employee.dashboard.dashboard', compact('existingAttendanceDetail', 'allBreakTypeDetails', 'takenBreakDetails', 'currentAttendanceDetail', 'shiftIDs'));
    }

    public function startImpersonate()
    {
        $employee = Auth()->user();
        // Save original guard and user info in session
        session()->put('impersonation', [
            'original_guard' => 'employee',
            'original_user_id' => $employee->id,
            'original_user_role' => $employee->role_id
        ]);

        // $data = [
        //     'company_id' => $employee->id,
        //     'name' => $employee->name,
        //     'password' => Hash::make($employee->password),
        //     'email' => $employee->email,
        //     'status' => 1
        // ];

        // $companyUser = $this->companyUserService->updateOrCreate(['email' => $employee->email], $data);

        // // Log in the company under the company guard
        // auth()->guard('company')->login($companyUser);

        return redirect()->route('company.dashboard')->with('success', 'Now impersonating company!');
    }

    public function endImpersonate()
    {
        if (!session()->has('impersonation')) {
            return redirect()->back()->with('error', 'No impersonation in progress.');
        }

        // Retrieve original guard and user info
        $impersonation = session()->get('impersonation');
        auth()->loginUsingId($impersonation['original_user_id']);

        // Clear impersonation session data
        session()->forget('impersonation');

        return redirect()->route('employee.dashboard');
    }
}
