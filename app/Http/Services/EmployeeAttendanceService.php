<?php

namespace App\Http\Services;

use App\Http\Services\EmployeeServices;
use App\Http\Services\HolidayServices;
use App\Http\Services\LeaveService;
use App\Http\Services\CompOffService;
use App\Http\Services\WeekendService;
use App\Http\Services\UserShiftService;
use App\Http\Services\ShiftServices;
use App\Http\Services\UserService;
use App\Models\UserShiftLog;
use App\Repositories\EmployeeAttendanceRepository;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Support\Arr;
use Symfony\Component\Console\Output\NullOutput;

use function PHPUnit\Framework\returnValue;

class EmployeeAttendanceService
{
    private $employeeAttendanceRepository;
    private $leaveService;
    private $holidayService;
    private $employeeService;
    private $weekendService;
    private $compOffService;
    private $userShiftService;
    private $shiftService;
    private $userService;


    public function __construct(UserService $userService, ShiftServices $shiftService, UserShiftService $userShiftService, CompOffService $compOffService, EmployeeAttendanceRepository $employeeAttendanceRepository, LeaveService $leaveService, HolidayServices $holidayService, EmployeeServices $employeeService, WeekendService $weekendService)
    {
        $this->employeeAttendanceRepository = $employeeAttendanceRepository;
        $this->leaveService = $leaveService;
        $this->holidayService = $holidayService;
        $this->employeeService = $employeeService;
        $this->weekendService = $weekendService;
        $this->compOffService = $compOffService;
        $this->userShiftService = $userShiftService;
        $this->shiftService = $shiftService;
        $this->userService = $userService;
    }

    public function create($data)
    {
        $userDetails = Auth()->user() ?? auth()->guard('employee_api')->user();
        $attendanceTime = Carbon::now()->format('Y/m/d H:i:s');

        $shiftType = $userDetails->details->shift_type;
        $shiftIDs = $this->userShiftService->getTodaysShifts($userDetails->id, $shiftType)->pluck('shift_id')->toArray();

        if (count($shiftIDs) < 1) {
            return ['status' => false, 'message' => 'No shift assigned to you. Please contact your admin.'];
        }

        $shifts = $this->shiftService->getByIdShifts($shiftIDs);

        // Check if user is within allowed punch-in time for any shift
        $shiftCheck = $this->userShiftService->isUserAllowedToPunchIn($shifts);
        if (!$shiftCheck['in_shift']) {
            return [
                'status' => false,
                'message' => $shiftCheck['message']
            ];
        }

        $officeShiftDetails = $shiftCheck['officeShift'];
        $officeStartTime = $shiftCheck['start'];
        $officeEndTime = $shiftCheck['end'];

        // Handle Punch Out
        if (isset($data['attendance_id']) && !empty($data['attendance_id'])) {
            $existingAttendance = $this->employeeAttendanceRepository->find($data['attendance_id']);
            if ($existingAttendance) {
                if (!$data['force']) {
                    if ($officeShiftDetails->check_out_buffer > 0) {
                        $bufferTime = $officeEndTime->copy()->subMinutes($officeShiftDetails->check_out_buffer);
                        if (Carbon::now()->lt($bufferTime)) {
                            return [
                                'status' => false,
                                'before_punchout_confirm_required' => true,
                                'message' => 'You are punching out before your shift end time. Do you still want to continue?'
                            ];
                        } elseif (Carbon::now()->between($bufferTime, $officeEndTime)) {
                            $data['is_short_attendance'] = 1;
                        }
                    } else {
                        if (Carbon::now()->lt($officeEndTime)) {
                            return [
                                'status' => false,
                                'before_punchout_confirm_required' => true,
                                'message' => 'You are punching out before your shift end time. Do you still want to continue?'
                            ];
                        }
                    }
                }

                $data['punch_out'] = $attendanceTime;
                $existingAttendance->update($data);
                return ['status' => true, 'data' => 'Punch Out'];
            }
        }

        // Handle Punch In
        $data['user_id'] = $userDetails->id;
        $data['punch_in'] = $attendanceTime;

        // Check if shift is over
        if (Carbon::now()->gt($officeEndTime)) {
            return ['status' => false, 'message' => 'Your office hours are over.'];
        }

        $alreadyPunchedIn = $this->employeeAttendanceRepository->query()
        ->where('user_id', $userDetails->id)
        ->whereDate('punch_in', Carbon::today())
        ->where('shift_id', $officeShiftDetails->id)
        ->exists();

        if ($alreadyPunchedIn) {
            return ['status' => false, 'message' => 'You have already punched in for today’s shift.'];
        }

        // Handle holidays
        $todayHoliday = $this->holidayService->getHolidayByCompanyBranchId($userDetails->company_id, Carbon::today()->toDateString(), $userDetails->details->company_branch_id);
        if ($todayHoliday) {
            $this->compOffService->store([
                'user_id' => $userDetails->id,
                'date' => Carbon::today()->toDateString(),
                'status' => 'pending',
            ]);
        }

        // Handle weekends
        $checkWeekend = $this->weekendService->getWeekendDetailByWeekdayId($userDetails->company_id, $userDetails->details->company_branch_id, $userDetails->department_id, Carbon::today()->toDateString());
        if ($checkWeekend) {
            $this->compOffService->store([
                'user_id' => $userDetails->id,
                'date' => Carbon::today()->toDateString(),
                'status' => 'pending',
            ]);
        }

        // Handle leaves
        $todayConfirmLeaveDetails = $this->leaveService->getUserConfirmLeaveByDate($userDetails->id, Carbon::today()->toDateString());
        $checkLeaveDetails = $this->leaveService->checkTodayLeaveData($todayConfirmLeaveDetails);
        if ($checkLeaveDetails['success']) {
            if ($checkLeaveDetails['status'] == 'Full') {
                return ['status' => false, 'message' => 'Today you are on leave'];
            } elseif ($checkLeaveDetails['status'] == '1 Half') {
                $halfDayLoginTime = Carbon::parse($officeShiftDetails->half_day_login);
                if (Carbon::now()->lt($halfDayLoginTime)) {
                    return ['status' => false, 'message' => 'Today you are on half day. Please punch in on second half.'];
                }
            } else {
                return ['status' => false, 'message' => 'Today you are on half day'];
            }
        }

        // Check if user is late
        if (Carbon::now()->gt($officeStartTime)) {
            $data['late'] = 1;
        }

        $data['shift_id'] = $officeShiftDetails->id;
        $data['shift_start_time'] = $officeStartTime;
        $data['shift_end_time'] = $officeEndTime;

        // Create attendance
        $this->employeeAttendanceRepository->create($data);
        return ['status' => true, 'data' => 'Punch In'];
    }

    public function createUsingFace($data)
    {
        $authDetails = Auth()->user() ?? auth()->guard('employee_api')->user();
        $userDetails = $this->userService->getUserById($data['user_id']);
        if($authDetails->id != $userDetails->company_id) {
            return ['status' => false, 'message' => 'Invalid User.'];
        }
        $attendanceTime = Carbon::now()->format('Y/m/d H:i:s');

        $shiftType = $userDetails->details->shift_type;
        $shiftIDs = $this->userShiftService->getTodaysShifts($userDetails->id, $shiftType)->pluck('shift_id')->toArray();

        if (count($shiftIDs) < 1) {
            return ['status' => false, 'message' => 'No shift assigned to you. Please contact your admin.'];
        }

        $shifts = $this->shiftService->getByIdShifts($shiftIDs);

        // Check if user is within allowed punch-in time for any shift
        $shiftCheck = $this->userShiftService->isUserAllowedToPunchIn($shifts);
        if (!$shiftCheck['in_shift']) {
            return [
                'status' => false,
                'message' => $shiftCheck['message']
            ];
        }

        $officeShiftDetails = $shiftCheck['officeShift'];
        $officeStartTime = $shiftCheck['start'];
        $officeEndTime = $shiftCheck['end'];

        // Handle Punch In
        $data['user_id'] = $userDetails->id;
        $data['punch_in'] = $attendanceTime;

        // Check if shift is over
        if (Carbon::now()->gt($officeEndTime)) {
            return ['status' => false, 'message' => 'Your office hours are over.'];
        }

        $alreadyPunchedIn = $this->employeeAttendanceRepository->query()
        ->where('user_id', $userDetails->id)
        ->whereDate('punch_in', Carbon::today())
        ->where('shift_id', $officeShiftDetails->id)
        ->exists();

        // Handle Punch Out
        if ($alreadyPunchedIn) {
            $existingAttendance = $this->employeeAttendanceRepository->query()
            ->where('user_id', $userDetails->id)
            ->whereDate('punch_in', Carbon::today())
            ->where('shift_id', $officeShiftDetails->id)
            ->first();
            if ($officeShiftDetails->check_out_buffer > 0) {
                $bufferTime = $officeEndTime->copy()->subMinutes($officeShiftDetails->check_out_buffer);
                if (Carbon::now()->lt($bufferTime)) {
                    return [
                        'status' => false,
                        'message' => 'You can not punch out before your shift end time.'
                    ];
                } elseif (Carbon::now()->between($bufferTime, $officeEndTime)) {
                    $data['is_short_attendance'] = 1;
                }
            } else {
                if (Carbon::now()->lt($officeEndTime)) {
                    return [
                        'status' => false,
                        'message' => 'You can not punch out before your shift end time.'
                    ];
                }
            }

            $data['punch_out'] = $attendanceTime;
            $existingAttendance->update($data);
            return ['status' => true, 'message' => 'Punch Out', 'data' => $userDetails];
        }

        // Handle holidays
        $todayHoliday = $this->holidayService->getHolidayByCompanyBranchId($userDetails->company_id, Carbon::today()->toDateString(), $userDetails->details->company_branch_id);
        if ($todayHoliday) {
            $this->compOffService->store([
                'user_id' => $userDetails->id,
                'date' => Carbon::today()->toDateString(),
                'status' => 'pending',
            ]);
        }

        // Handle weekends
        $checkWeekend = $this->weekendService->getWeekendDetailByWeekdayId($userDetails->company_id, $userDetails->details->company_branch_id, $userDetails->department_id, Carbon::today()->toDateString());
        if ($checkWeekend) {
            $this->compOffService->store([
                'user_id' => $userDetails->id,
                'date' => Carbon::today()->toDateString(),
                'status' => 'pending',
            ]);
        }

        // Handle leaves
        $todayConfirmLeaveDetails = $this->leaveService->getUserConfirmLeaveByDate($userDetails->id, Carbon::today()->toDateString());
        $checkLeaveDetails = $this->leaveService->checkTodayLeaveData($todayConfirmLeaveDetails);
        if ($checkLeaveDetails['success']) {
            if ($checkLeaveDetails['status'] == 'Full') {
                return ['status' => false, 'message' => 'Today you are on leave'];
            } elseif ($checkLeaveDetails['status'] == '1 Half') {
                $halfDayLoginTime = Carbon::parse($officeShiftDetails->half_day_login);
                if (Carbon::now()->lt($halfDayLoginTime)) {
                    return ['status' => false, 'message' => 'Today you are on half day. Please punch in on second half.'];
                }
            } else {
                return ['status' => false, 'message' => 'Today you are on half day'];
            }
        }

        // Check if user is late
        if (Carbon::now()->gt($officeStartTime)) {
            $data['late'] = 1;
        }

        $data['shift_id'] = $officeShiftDetails->id;
        $data['shift_start_time'] = $officeStartTime;
        $data['shift_end_time'] = $officeEndTime;

        // Create attendance
        $this->employeeAttendanceRepository->create($data);
        return ['status' => true, 'message' => 'Punch In', 'data' => $userDetails];
    }

    public function getTodaysShifts()
    {
        $userDetails = Auth()->user() ?? auth()->guard('employee_api')->user();

        $shiftType = $userDetails->details->shift_type;
        $shiftIDs = $this->userShiftService->getTodaysShifts($userDetails->id, $shiftType)->pluck('shift_id')->toArray();

        $shifts = $this->shiftService->getByIdShifts($shiftIDs);

        return $shifts;
    }


    public function getExtistingDetailsByUserId($userId, $shiftType = 'single')
    {   
        $shiftIDs = $this->userShiftService->getTodaysShifts($userId, $shiftType)->pluck('shift_id')->toArray();

        if (count($shiftIDs)) {
            
            return $this->employeeAttendanceRepository
                ->where('user_id', $userId)
                ->whereDate('punch_in', date('Y-m-d'))
                ->whereIn('shift_id', $shiftIDs)->with('shift')
                ->get()->toArray();
        } else {

            return [];
        }
    }

    public function getCurrentAttendanceByUserId($userId)
    {   
        
        return $this->employeeAttendanceRepository
        ->where('user_id', $userId)
        ->where('punch_out', NULL)
        ->latest('id')
        ->first();
    }

    /**
     * Undocumented function
     *
     * @param [type] $fromDate
     * @param [type] $toDate
     * @param [type] $userId
     * @return void/object/null
     */
    public function getAttendanceByFromAndToDate($fromDate, $toDate, $userId)
    {
        $fromDate = Carbon::parse($fromDate)->startOfDay();
        $toDate = Carbon::parse($toDate)->endOfDay();
        return $this->employeeAttendanceRepository
            ->where('user_id', $userId)
            ->whereBetween('punch_in', [$fromDate, $toDate]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getLastTenDaysAttendance()
    {
        $userId = Auth()->user()->id ?? auth()->guard('employee_api')->user()->id;
        return $this->employeeAttendanceRepository->where('user_id', $userId)->where('punch_in', '>', now()->subDays(10)->endOfDay())->orderBy('id', 'DESC')->get();
    }

    /**
     * Undocumented function
     *
     * @param [type] $companyId
     * @return void
     */
    public function getAllAttendanceByCompanyId($companyId)
    {
        return $this->employeeAttendanceRepository
            ->whereHas('user', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })->orderBy('id', 'desc')->paginate(10);
    }

    /**
     * Undocumented function
     *
     * @param [type] $month
     * @param [type] $userId
     * @param [type] $year
     * @return void/null/object
     */
    public function getAllAttendanceByMonthByUserId($month, $userId, $year)
    {
        return $this->employeeAttendanceRepository->where('user_id', $userId)->whereMonth('punch_in', '=', $month)->whereYear('punch_in', '=', $year);
    }

    /**
     * Undocumented function
     *
     * @param [type] $month
     * @param [type] $userId
     * @param [type] $year
     * @return void/null/object
     */
    public function getAllAttendanceByDateByUserId($startDate, $userId, $endDate)
    {
        return $this->employeeAttendanceRepository->where('user_id', $userId)->where('punch_in', '>=', $startDate)->where('punch_in', '<=', $endDate);
    }

    /**
     * Undocumented function
     *
     * @param [type] $month
     * @param [type] $userId
     * @param [type] $year
     * @return void/object/null
     */
    public function getShortAttendanceByMonthByUserId($month, $userId, $year)
    {
        return $this->employeeAttendanceRepository->where('user_id', $userId)->whereMonth('punch_in', '=', $month)->whereYear('punch_in', '=', $year)->where('is_short_attendance', 1);
    }

    /**
     * Undocumented function
     *
     * @param [type] $userId
     * @param [type] $date
     * @return object/null
     */
    public function getAttendanceByDateByUserId($userId, $date)
    {
        $date = Carbon::parse($date);
        $yesterday = $date->copy()->subDay()->toDateString();
        $currentDate = $date->toDateString();
        return $this->employeeAttendanceRepository
            ->where('user_id', $userId)
            ->where(function ($query) use ($currentDate, $yesterday) {
                $query->whereDate('punch_in', $currentDate)
                    ->orWhereDate('punch_in', $yesterday);
            })
            ->orderBy('punch_in', 'desc');
        // return $this->employeeAttendanceRepository->where('user_id', $userId)->whereDate('punch_in', '=', $date);
    }

    /**
     * Undocumented function
     *
     * @param [type] $data
     * @return void
     */
    public function editAttendanceByUserId($data)
    {
        $data['punch_in'] = date('Y/m/d H:i:s', strtotime($data['date'] . ' ' . $data['punch_in']));
        $data['punch_out'] = date('Y/m/d H:i:s', strtotime($data['date'] . ' ' . $data['punch_out']));
        $payload = Arr::except($data, ['_token', 'date', 'attendance_id']);
        if (isset($data['attendance_id']) && !empty($data['attendance_id'])) {
            return $this->employeeAttendanceRepository->find($data['attendance_id'])->update($payload);
        } else {
            return $this->employeeAttendanceRepository->create($payload);
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $data
     * @return void
     */
    public function addBulkAttendance($data)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $data['from_date']);
        $endDate = Carbon::createFromFormat('Y-m-d', $data['to_date']);
        $payload = [];
        for ($date = $startDate; $date <= $endDate; $date->addDay()) {
            $mainDate = $date->toDateString();
            // $weekDayNumber = $date->dayOfWeekIso;
            $weekDayNumber = $date;

            foreach ($data['employee_id'] as $employeeId) {
                //Get Employee Details By User Id
                $employeeDetails = $this->employeeService->getUserDetailById($employeeId);
                if ($employeeDetails->details->joining_date <= $mainDate) {
                    // Check Holiday for Particular date
                    $checkHoliday = $this->holidayService->getHolidayByCompanyBranchId($employeeDetails->company_id, $mainDate, $employeeDetails->details->company_branch_id);
                    // Check Attendance if employee existing
                    $checkExistingAttendance = $this->getAttendanceByDateByUserId($employeeId, $mainDate)->first();

                    //Check Leave if employee applied and status was approved
                    $checkLeave = $this->leaveService->getUserConfirmLeaveByDate($employeeId, $mainDate);

                    //Check Weekend if Existing
                    $checkWeekend = $this->weekendService->getWeekendDetailByWeekdayId($employeeDetails->company_id, $employeeDetails->details->company_branch_id, $employeeDetails->details->department_id, $weekDayNumber);

                    if ($checkHoliday == null && $checkExistingAttendance == null && $checkLeave == null && $checkWeekend == null) {
                        $payload[] = [
                            'punch_in' => date('Y-m-d H:i:s', strtotime($mainDate . ' ' . $data['punch_in'])),
                            'punch_out' => date('Y-m-d H:i:s', strtotime($mainDate . ' ' . $data['punch_out'])),
                            'user_id' => $employeeId,
                            'remark' => $data['remark'],
                            'punch_in_using' => $data['punch_in_using'],
                            'punch_in_by' => $data['punch_in_by'],
                            'company_id' => $data['company_id'],
                            'created_by' => $data['created_by'],
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ];
                    }
                }
            }
        }
        if (isset($payload) && !empty($payload)) {
            $this->employeeAttendanceRepository->insert($payload);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $breakDetails
     * @param [type] $breakHourValue
     * @return void
     */
    public function updateAttendanceDetails($breakDetails, $breakHourValue)
    {
        $attendanceDetails = $this->employeeAttendanceRepository->where('id', $breakDetails->employee_attendance_id)->first();
        $totalBreak = '00:00:00';
        if ($attendanceDetails->total_break_time == null) {
            // Calculate the time difference between break start and break hour
            $time1 = new DateTime($breakDetails->start_time);
            $time2 = new DateTime($breakHourValue);
            $time_diff = $time1->diff($time2);
            // Format the difference as HH:mm:ss
            $totalBreak = $time_diff->format('%H:%I:%S');
        } else {
            // Calculate the time difference between break start and break hour
            $time1 = new DateTime($breakDetails->start_time);
            $time2 = new DateTime($breakHourValue);
            $time_diff1 = $time1->diff($time2);

            // Add the calculated time difference to total break time
            $time3 = new DateTime($attendanceDetails->total_break_time);
            $time3->add(new DateInterval('PT' . $time_diff1->h . 'H' . $time_diff1->i . 'M' . $time_diff1->s . 'S'));

            // Format the new total break time as HH:mm:ss
            $totalBreak = $time3->format('H:i:s');
        }

        return $attendanceDetails->update(['total_break_time' => $totalBreak]);
    }

    /**
     * Undocumented function
     *
     * @param [type] $date
     * @param [type] $userID
     * @return void
     */
    public function getAttendanceByByDate($date, $userID)
    {
        $attendances = $this->employeeAttendanceRepository->where('user_id', $userID)->whereDate('punch_in', $date)->get();
        $leave = $this->leaveService->getConfirmedLeaveByUserIDAndDate('user_id', $userID);
        
        $response = [
            'attendance' => [],
            'status' => Null
        ];

        $status = null;

        if ($leave) {
            $status = $leave->is_half_day ? 'Half Day' : 'Leave';
        } elseif (count($attendances)) {
            foreach ($attendances as $key => $attendance) {
                $resp = [];
                $resp['punch_in'] = date('H:i A', strtotime($attendance->punch_in));
                $resp['punch_out'] = date('H:i A', strtotime($attendance->punch_out));
                if ($attendance->punch_out) {
                    $punchIn = Carbon::parse($attendance->punch_in);
                    $punchOut = Carbon::parse($attendance->punch_out);
                    $totalBreakSeconds = 0;
                    if ($attendance->total_break_time) {
                        $totalBreakTime = Carbon::parse($attendance->total_break_time); // 45 minutes break
                        $totalBreakSeconds = $totalBreakTime->hour * 3600 + $totalBreakTime->minute * 60 + $totalBreakTime->second;
                    }

                    // Calculate total work duration (without break)
                    $totalWorkDuration = $punchOut->diffInSeconds($punchIn);

                    // Subtract total break time
                    $actualWorkSeconds = $totalWorkDuration - $totalBreakSeconds;

                    // Convert back to hours, minutes, seconds
                    $hours = floor($actualWorkSeconds / 3600);
                    $minutes = floor(($actualWorkSeconds % 3600) / 60);
                    $seconds = $actualWorkSeconds % 60;
                    // Format the output
                    $resp['total_working_hours'] = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                }
                $status = 'Present';
                $response['attendance'][] = $resp;
            }  
        } else {
            $status = 'Absent';
        }
        $response['status'] = $status;

        return $response;
    }

    /**
     * Undocumented function
     *
     * @param [type] $year
     * @param [type] $month
     * @param [type] $userId
     * @return void
     */
    public function getTotalWorkingDaysByUserId($year, $month, $userId)
    {
        $fromDate = Carbon::create($year, $month, 1)->startOfMonth();
        $toDate = Carbon::create($year, $month, 1)->endOfMonth();
        return $this->employeeAttendanceRepository
            ->where('user_id', $userId)
            ->whereBetween('punch_in', [$fromDate, $toDate])
            ->selectRaw('SUM(status = 1) + (SUM(status = 2) / 2) as total_present')
            ->selectRaw('SUM(late = 1) as late_count');  // Count late days;
    }

    public function createAttendanceByAttendanceRequest($data)
    {
        return $this->employeeAttendanceRepository->create($data);
    }

    public function getAllAttendanceByUserId($userId)
    {
        return $this->employeeAttendanceRepository->where('user_id', $userId);
    }

    public function getShiftDetails($userId)
    {
        return UserShiftLog::where('user_id', $userId)
            ->whereDate('date', '<=', now()->toDateString())
            ->latest()
            ->first();
    }


}
