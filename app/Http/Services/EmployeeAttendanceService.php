<?php

namespace App\Http\Services;

use App\Http\Services\EmployeeServices;
use App\Http\Services\HolidayServices;
use App\Http\Services\LeaveService;
use App\Http\Services\WeekendService;
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
    // public function create($data)
    // {
    //     $userDetails = Auth()->guard('employee')->user() ?? auth()->guard('employee_api')->user();
    //     $attendanceTime = date('Y/m/d H:i:s');
    //     $startingTime = Carbon::parse($userDetails->officeShift->start_time);
    //     $loginBeforeShiftTime = $startingTime->subMinutes($userDetails->officeShift->login_before_shift_time);
    //     // dd($userDetails->officeShift->officeTimingConfigs->half_day_hours);

    //     //dd($userDetails);
    //     if ($attendanceTime >= $loginBeforeShiftTime) {
    //         $payload = [];
    //         $payload =
    //             [
    //                 'user_id' => $userDetails->id,
    //                 'punch_in_using' => $data['punch_in_using']
    //             ];
    //         /** If Data Exit in Table Soo we Implement for Puch Out  */
    //         $existingDetails = $this->getExtistingDetailsByUserId($userDetails->id);
    //         if (isset($existingDetails) && !empty($existingDetails)) {
    //             $payload['punch_out'] = $attendanceTime;
    //             $puchOutDetail =  $this->employeeAttendanceRepository->find($existingDetails->id)->update($payload);
    //         }

    //         /** If Data No Exit in Table Soo we Implement for Puch In  */
    //         else {
    //             $payload['punch_in'] = $attendanceTime;
    //             $puchInDetail =  $this->employeeAttendanceRepository->create($payload);
    //         }
    //         if (isset($puchInDetail)) {
    //             $message = 'Puch In';
    //         }
    //         if (isset($puchOutDetail)) {
    //             $message = 'Puch Out';
    //         }
    //         return $response = ['data' => $message, 'status' => true];
    //     } else {
    //         return $response = ['status' => false];
    //     }
    // }

    public function create($data)
    {
        $userDetails = Auth()->guard('employee')->user() ?? auth()->guard('employee_api')->user();
        $attendanceTime = date('Y/m/d H:i:s');
        $officeStartTime = $userDetails->officeShift->start_time;
        $officeEndTime = $userDetails->officeShift->end_time;
        $payload = [];
        $payload =
            [
                'user_id' => $userDetails->id,
                'punch_in_using' => $data['punch_in_using']
            ];
        /** If Data Exit in Table Soo we Implement for Puch Out  */
        $existingDetails = $this->getAttendanceByDateByUserId($userDetails->id, date('Y-m-d'))->first();
        if (isset($existingDetails) && !empty($existingDetails)) {
            $payload['punch_out'] = $attendanceTime;
            $this->employeeAttendanceRepository->find($existingDetails->id)->update($payload);
            return ['data' => 'Punch Out', 'status' => true];
        } else {
            $payload['punch_in'] = $attendanceTime;
            if ($userDetails->officeShift->login_before_shift_time > 0) {
                $beforTime = ' -' . $userDetails->officeShift->login_before_shift_time . ' minutes';
                $loginBeforeShiftTime  = date('H:i:s', strtotime($userDetails->officeShift->start_time . $beforTime));
                if (date('H:i:s') < $loginBeforeShiftTime) {
                    return array('status' => false, 'message' => 'You are punching before your shift time. ' . $loginBeforeShiftTime);
                }
            }

            if (date('H:i:s', strtotime($officeEndTime)) < date('H:i:s')) {
                return array('status' => false, 'message' => 'Your office hours are over. ' . $officeEndTime);
            }

            $todayHoliday =  $this->holidayService->getHolidayByCompanyBranchId($userDetails->company_id, date('Y-m-d'), $userDetails->company_branch_id);
            if ($todayHoliday) {
                return array('status' => false, 'message' => 'Today is ' . $todayHoliday->name . ' holiday');
            }
            $checkWeekend = $this->weekendService->getWeekendDetailByWeekdayId($userDetails->company_id, $userDetails->company_branch_id, $userDetails->department_id, date('N'));
            if ($checkWeekend) {
                return array('status' => false, 'message' => 'Punch-in cannot be processed today as it is your weekend.');
            }



            $todayConfirmLeaveDeatils = $this->leaveService->getUserConfirmLeaveByDate($userDetails->id, date('Y-m-d'));
            $checkLeaveDetails = $this->leaveService->checkTodayLeaveData($todayConfirmLeaveDeatils);

            if ($userDetails->officeShift->check_in_buffer > 0) {
                $bufferTime = ' +' . $userDetails->officeShift->check_in_buffer . ' minutes';
                $officeStartTime  = date('H:i:s', strtotime($userDetails->officeShift->start_time . $bufferTime));
            }
            //dd($checkLeaveDetails);
            if ($checkLeaveDetails['success']) {
                if ($checkLeaveDetails['status'] == 'Full') {
                    return array('status' => false, 'message' => 'Today you are on leave');
                } else if ($checkLeaveDetails['status'] == '1 Half') {
                    if (date('H:i:s', strtotime($userDetails->officeShift->half_day_login)) > date('H:i:s')) {
                        return array('status' => false, 'message' => 'Today you are on half day. So please punch in on second half ' . $userDetails->officeShift->half_day_login);
                    }
                    if ($userDetails->officeShift->check_in_buffer > 0) {
                        $bufferTime = ' +' . $userDetails->officeShift->check_in_buffer . ' minutes';
                        $officeStartTime  = date('H:i:s', strtotime($userDetails->officeShift->half_day_login . $bufferTime));
                    } else {
                        $officeStartTime = $userDetails->officeShift->half_day_login;
                    }
                    $payload['status'] = 2;
                } else {
                    //dd($userDetails->officeShift->half_day_login);
                    if (date('H:i:s') >= date('H:i:s', strtotime($userDetails->officeShift->half_day_login))) {
                        return array('status' => false, 'message' => 'Today you are on half day');
                    }
                    $payload['status'] = 2;
                }
            }

            if (date('H:i:s') > $officeStartTime) {
                $payload['late'] = 1;
            }


            $this->employeeAttendanceRepository->create($payload);
            return  ['status' => true, 'data' => 'Punch In'];
        }
    }

    public function getExtistingDetailsByUserId($userId)
    {
        return $this->employeeAttendanceRepository->where('user_id', $userId)->whereDate('punch_in', Carbon::today())->first();
    }
    public function getAttendanceByFromAndToDate($fromDate, $toDate, $userId)
    {
        $fromDate = Carbon::parse($fromDate)->startOfDay();
        $toDate = Carbon::parse($toDate)->endOfDay();
        return $this->employeeAttendanceRepository
            ->where('user_id', $userId)
            ->whereBetween('punch_in', [$fromDate, $toDate]);
    }
    public function getLastTenDaysAttendance()
    {
        $userId = Auth()->guard('employee')->user()->id ?? auth()->guard('employee_api')->user()->id;
        return $this->employeeAttendanceRepository->where('user_id', $userId)->where('punch_in', '>', now()->subDays(10)->endOfDay())->orderBy('id', 'DESC')->get();
    }
    // public function getWorkingHours($attendanceDetails)
    // {
    //     if ($attendanceDetails) {
    //         $punch_in = $attendanceDetails->punch_in;
    //         $punch_out = $attendanceDetails->punch_out;
    //         if ($punch_in != '' && $punch_out != '') {
    //             $startTime = strtotime($punch_in);
    //             $endTime = strtotime($punch_out);

    //             // Calculate the difference in seconds
    //             $timeDiff = $endTime - $startTime;

    //             // Calculate hours, minutes, and seconds
    //             $hours = floor($timeDiff / 3600);
    //             $minutes = floor(($timeDiff % 3600) / 60);
    //             $seconds = $timeDiff % 60;

    //             // Display the result
    //             $hours = $hours > 9 ? $hours : '0' . $hours;
    //             $minutes = $minutes > 9 ? $minutes : '0' . $minutes;
    //             $seconds = $seconds > 9 ? $seconds : '0' . $seconds;
    //             $time = $hours . ':' . $minutes . ':' . $seconds;
    //             return $time;
    //         } else {
    //             return '00:00:00';
    //         }
    //     } else {
    //         return '00:00:00';
    //     }
    // }
    public function getAllAttendanceByCompanyId($companyId)
    {
        return $this->employeeAttendanceRepository
            ->whereHas('user', function ($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })->orderBy('id', 'desc')->paginate(10);
    }

    public function getAllAttendanceByMonthByUserId($month, $userId, $year)
    {
        return $this->employeeAttendanceRepository->where('user_id', $userId)->whereMonth('punch_in', '=', $month)->whereYear('punch_in', '=', $year);
    }

    public function getAttendanceByDateByUserId($userId, $date)
    {
        return $this->employeeAttendanceRepository->where('user_id', $userId)->whereDate('punch_in', '=', $date);
    }

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

    public function addBulkAttendance($data)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $data['from_date']);
        $endDate = Carbon::createFromFormat('Y-m-d', $data['to_date']);
        $payload = [];
        for ($date = $startDate; $date <= $endDate; $date->addDay()) {
            $mainDate = $date->toDateString();
            $weekDayNumber = $date->dayOfWeekIso;
            foreach ($data['employee_id'] as $employeeId) {

                //Get Employee Details By User Id
                $employeeDetails = $this->employeeService->getUserDetailById($employeeId);

                // Check Holiday for Particular date
                $checkHoliday = $this->holidayService->getHolidayByCompanyBranchId($employeeDetails->company_id, $mainDate, $employeeDetails->company_branch_id);

                // Check Attendance if employee existing
                $checkExistingAttendance = $this->getAttendanceByDateByUserId($employeeId, $mainDate)->first();

                //Check Leave if employee applied and status was approved
                $checkLeave =  $this->leaveService->getUserConfirmLeaveByDate($employeeId, $mainDate);

                //Check Weekend if Existing
                $checkWeekend = $this->weekendService->getWeekendDetailByWeekdayId($employeeDetails->company_id, $employeeDetails->company_branch_id, $employeeDetails->department_id, $weekDayNumber);

                if ($checkHoliday == null && $checkExistingAttendance == null && $checkLeave == null && $checkWeekend == null) {
                    $payload[] = [
                        'punch_in'          => date('Y/m/d H:i:s', strtotime($mainDate . ' ' . $data['punch_in'])),
                        'punch_out'         => date('Y/m/d H:i:s', strtotime($mainDate . ' ' . $data['punch_out'])),
                        'user_id'           => $employeeId,
                        'remark'            => $data['remark'],
                        'punch_in_using'    => $data['punch_in_using'],
                        'created_at'        => Carbon::now(),
                        'updated_at'        => Carbon::now()
                    ];
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

    public function updateAttendanceDetails($breakDetails, $breakHourValue)
    {
        $attendanceDetails = $this->employeeAttendanceRepository->where('id', $breakDetails->employee_attendance_id)->first();
       
        //dd($attendanceDetails);
        $totalBreak = '00:00:00';
        //dd($attendanceDetails);
        if ($attendanceDetails->total_break_time == null) {
            // Calculate the time difference between break start and break hour
            $time1 = new DateTime($breakDetails->start_time);
            $time2 = new DateTime($breakHourValue);
            $time_diff = $time1->diff($time2);
            //dd($time_diff);
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
        //dd($totalBreak);
        return $attendanceDetails->update(['total_break_time' => $totalBreak]);
    }
}
