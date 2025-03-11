<?php

namespace App\Http\Services;

use App\Http\Services\EmployeeServices;
use App\Http\Services\HolidayServices;
use App\Http\Services\LeaveService;
use App\Http\Services\WeekendService;
use App\Models\EmployeeAttendance;
use App\Repositories\EmployeeAttendanceRepository;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Support\Arr;

class EmployeeAttendanceService
{
    private $employeeAttendanceRepository;
    private $leaveService;
    private $holidayService;
    private $employeeService;
    private $weekendService;


    public function __construct(EmployeeAttendanceRepository $employeeAttendanceRepository, LeaveService $leaveService, HolidayServices $holidayService, EmployeeServices $employeeService, WeekendService $weekendService)
    {
        $this->employeeAttendanceRepository = $employeeAttendanceRepository;
        $this->leaveService = $leaveService;
        $this->holidayService = $holidayService;
        $this->employeeService = $employeeService;
        $this->weekendService = $weekendService;
    }
    public function create($data)
    {
        $userDetails = Auth()->user() ?? auth()->guard('employee_api')->user();
        $attendanceTime = date('Y/m/d H:i:s');
        $officeShiftDetails = $userDetails->details->officeShift;
        $officeStartTime = date('H:i:s', strtotime($officeShiftDetails->start_time));
        $officeEndTime = date('H:i:s', strtotime($officeShiftDetails->end_time));
        $payload = [
            'user_id' => $userDetails->id,
            'punch_in_using' => $data['punch_in_using']
        ];
        /** If Data Exit in Table Soo we Implement for Puch Out  */
        $existingDetails = $this->getAttendanceByDateByUserId($userDetails->id, date('Y-m-d'))->first();
        if (isset($existingDetails) && !empty($existingDetails)) {

            //check if user is in short attendance
            if ($officeShiftDetails->check_out_buffer > 0) {
                $bufferTime = ' -' . $officeShiftDetails->check_out_buffer . ' minutes';
                $officeShortAttendanceTime = date('H:i:s', strtotime($officeEndTime . $bufferTime));
                if (date('H:i:s') < $officeShortAttendanceTime) {
                    return array('status' => false, 'message' => 'You are punching out before your shift time. ' . date('H:i:s', strtotime($officeEndTime)));
                } elseif ((date('H:i:s') >= $officeShortAttendanceTime) && (date('H:i:s') < date('H:i:s', strtotime($officeEndTime)))) {
                    $payload['is_short_attendance'] = 1;
                }
            } else {
                if (date('H:i:s') < date('H:i:s', strtotime($officeEndTime))) {
                    return array('status' => false, 'message' => 'You are punching out before your shift time. ' . date('H:i:s', strtotime($officeEndTime)));
                }
            }

            $payload['punch_out'] = $attendanceTime;
            $this->employeeAttendanceRepository->find($existingDetails->id)->update($payload);
            return ['data' => 'Punch Out', 'status' => true];
        } else {
            $payload['punch_in'] = $attendanceTime;
            if ($officeShiftDetails->login_before_shift_time > 0) {
                $beforTime = ' -' . $officeShiftDetails->login_before_shift_time . ' minutes';
                $loginBeforeShiftTime = date('H:i:s', strtotime($officeShiftDetails->start_time . $beforTime));
                if (date('H:i:s') < $loginBeforeShiftTime) {
                    return array('status' => false, 'message' => 'You are punching before your shift time. ' . $loginBeforeShiftTime);
                }
            }

            if (date('H:i:s', strtotime($officeEndTime)) < date('H:i:s')) {
                return array('status' => false, 'message' => 'Your office hours are over. ' . $officeEndTime);
            }

            $todayHoliday = $this->holidayService->getHolidayByCompanyBranchId($userDetails->company_id, date('Y-m-d'), $userDetails->company_branch_id);
            if ($todayHoliday) {
                return array('status' => false, 'message' => 'Today is ' . $todayHoliday->name . ' holiday');
            }
            $checkWeekend = $this->weekendService->getWeekendDetailByWeekdayId($userDetails->company_id, $userDetails->company_branch_id, $userDetails->department_id, date('Y-m-d'));
            if ($checkWeekend) {
                return array('status' => false, 'message' => 'Punch-in cannot be processed today as it is your weekend.');
            }



            $todayConfirmLeaveDeatils = $this->leaveService->getUserConfirmLeaveByDate($userDetails->id, date('Y-m-d'));
            $checkLeaveDetails = $this->leaveService->checkTodayLeaveData($todayConfirmLeaveDeatils);

            if ($officeShiftDetails->check_in_buffer > 0) {
                $bufferTime = ' +' . $officeShiftDetails->check_in_buffer . ' minutes';
                $officeStartTime = date('H:i:s', strtotime($officeShiftDetails->start_time . $bufferTime));
            }
            //dd($checkLeaveDetails);
            if ($checkLeaveDetails['success']) {
                if ($checkLeaveDetails['status'] == 'Full') {
                    return array('status' => false, 'message' => 'Today you are on leave');
                } else if ($checkLeaveDetails['status'] == '1 Half') {
                    if (date('H:i:s', strtotime($officeShiftDetails->half_day_login)) > date('H:i:s')) {
                        return array('status' => false, 'message' => 'Today you are on half day. So please punch in on second half ' . $officeShiftDetails->half_day_login);
                    }
                    if ($officeShiftDetails->check_in_buffer > 0) {
                        $bufferTime = ' +' . $officeShiftDetails->check_in_buffer . ' minutes';
                        $officeStartTime = date('H:i:s', strtotime($officeShiftDetails->half_day_login . $bufferTime));
                    } else {
                        $officeStartTime = $officeShiftDetails->half_day_login;
                    }
                    $payload['status'] = 2;
                } else {
                    //dd( $officeShiftDetails->half_day_login);
                    if (date('H:i:s') >= date('H:i:s', strtotime($officeShiftDetails->half_day_login))) {
                        return array('status' => false, 'message' => 'Today you are on half day');
                    }
                    $payload['status'] = 2;
                }
            }

            if (date('H:i:s') > $officeStartTime) {
                $payload['late'] = 1;
            }


            $this->employeeAttendanceRepository->create($payload);
            return ['status' => true, 'data' => 'Punch In'];
        }
    }
    public function getExtistingDetailsByUserId($userId)
    {
        return $this->employeeAttendanceRepository->where('user_id', $userId)->whereDate('punch_in', Carbon::today())->first();
    }

    /**
     * Undocumented function
     *
     * @param [type] $fromDate
     * @param [type] $toDate
     * @param [type] $userId
     * @return void
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
     * @return void
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
     * @return void
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
     * @return void
     */
    public function getAttendanceByDateByUserId($userId, $date)
    {
        return $this->employeeAttendanceRepository->where('user_id', $userId)->whereDate('punch_in', '=', $date);
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
        $attendance = $this->employeeAttendanceRepository->where('user_id', $userID)->whereDate('punch_in', $date)->first();
        $leave = $this->leaveService->getConfirmedLeaveByUserIDAndDate('user_id', $userID);

        $response = [
            'punch_in' => null,
            'punch_out' => null,
            'total_working_hours' => 'N/A',
            'status' => null,
        ];

        if ($leave) {
            $response['status'] = $leave->is_half_day ? 'Half Day' : 'Leave';

        } elseif ($attendance) {
            $response['punch_in'] = date('H:i A', strtotime($attendance->punch_in));
            $response['punch_out'] = date('H:i A', strtotime($attendance->punch_out));
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
                $response['total_working_hours'] = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
            }
            $response['status'] = 'Present';
        } else {
            $response['status'] = 'Absent';
        }

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
}
