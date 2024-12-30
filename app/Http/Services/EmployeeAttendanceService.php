<?php

namespace App\Http\Services;

use Carbon\Carbon;
use App\Repositories\EmployeeAttendanceRepository;

class EmployeeAttendanceService
{
  private $employeeAttendanceRepository;
  private $leaveService;
  private $holidayService;


  public function __construct(EmployeeAttendanceRepository $employeeAttendanceRepository,LeaveService $leaveService,HolidayServices $holidayService)
  {
    $this->employeeAttendanceRepository = $employeeAttendanceRepository;
    $this->leaveService = $leaveService;
    $this->holidayService = $holidayService;
  }
  public function create($data)
  {
    $userDetails = Auth()->guard('employee')->user() ?? auth()->guard('employee_api')->user();
    $attendanceTime = date('Y/m/d H:i:s');
    $startingTime = Carbon::parse($userDetails->officeShift->start_time);
    $loginBeforeShiftTime = $startingTime->subMinutes($userDetails->officeShift->login_before_shift_time);
    // dd($userDetails->officeShift->officeTimingConfigs->half_day_hours);

    //dd($userDetails);
    if ($attendanceTime >= $loginBeforeShiftTime) {
      $payload = [];
      $payload =
        [
          'user_id' => $userDetails->id,
          'punch_in_using' => $data['punch_in_using']
        ];
      /** If Data Exit in Table Soo we Implement for Puch Out  */
      $existingDetails = $this->getExtistingDetailsByUserId($userDetails->id);
      if (isset($existingDetails) && !empty($existingDetails)) {
        $payload['punch_out'] = $attendanceTime;
        $puchOutDetail =  $this->employeeAttendanceRepository->find($existingDetails->id)->update($payload);
      }

      /** If Data No Exit in Table Soo we Implement for Puch In  */
      else {
        $payload['punch_in'] = $attendanceTime;
        $puchInDetail =  $this->employeeAttendanceRepository->create($payload);
      }
      if (isset($puchInDetail)) {
        $message = 'Puch In';
      }
      if (isset($puchOutDetail)) {
        $message = 'Puch Out';
      }
      return $response = ['data' => $message, 'status' => true];
    } else {
      return $response = ['status' => false];
    }
  }

  public function create2($data)
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
    $existingDetails = $this->getExtistingDetailsByUserId($userDetails->id);

    if (isset($existingDetails) && !empty($existingDetails)) {
      $payload['punch_out'] = $attendanceTime;
      $this->employeeAttendanceRepository->find($existingDetails->id)->update($payload);
      return $response = ['data' => 'Punch Out', 'status' => true];
    }else {

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


      if ($userDetails->officeShift->check_in_buffer > 0) {
        $bufferTime = ' +' . $userDetails->officeShift->check_in_buffer . ' minutes';
        $officeStartTime  = date('H:i:s', strtotime($userDetails->officeShift->start_time . $bufferTime));
      }

      if(date('H:i:s')>$officeStartTime){
        $payload['late'] = 1;
      }

      $todayConfirmLeaveDeatils = $this->leaveService->getUserConfirmLeaveByDate($userDetails->id,date('Y-m-d'));
      $checkLeaveDetails = $this->leaveService->checkTodayLeaveData($todayConfirmLeaveDeatils);

      if($checkLeaveDetails['success']){
        if($checkLeaveDetails['status']=='Full'){
          return array('status' => false, 'message' => 'Today you are on leave');
        }else if($checkLeaveDetails['status']=='1 Half'){
          if (date('H:i:s', strtotime($userDetails->officeShift->half_day_login)) > date('H:i:s')) {
            return array('status' => false, 'message' => 'Today you are on half day. So please punch in on second half '.$userDetails->officeShift->half_day_login);
          }
        }else{
          if (date('H:i:s') >= date('H:i:s', strtotime($userDetails->officeShift->half_day_login)) ) {
            return array('status' => false, 'message' => 'Today you are on half day');
          }
        }
      }

      $todayHoliday = $this->holidayService->getHolidayByDate($userDetails->id,date('Y-m-d'));
      dd($todayHoliday);
      if($todayHoliday){
        return array('status' => false, 'message' => 'Today is '.$todayHoliday->name.' holiday');
      }
      dd($todayHoliday);

      // if($todayLeave){
      //   // if($todayLeave->){

      //   // }
      // }
      //dd($userDetails,$checkLeaveDetails);

      $this->employeeAttendanceRepository->create($payload);

      return $response = ['data' => 'Punch In', 'status' => true];
    }

  }

  public function getExtistingDetailsByUserId($userId)
  {
    return $this->employeeAttendanceRepository->where('user_id', $userId)->whereDate('created_at', Carbon::today())->first();
  }
  public function getAllAttendanceDetails($userId)
  {
    return $this->employeeAttendanceRepository->where('user_id', $userId)->orderBy('id', 'DESC')->paginate(10);
  }
  public function getAttendanceByFromAndToDate($fromDate, $toDate)
  {
    $userId = Auth()->guard('employee')->user()->id ?? auth()->guard('employee_api')->user()->id;
    return $this->employeeAttendanceRepository->where('user_id', $userId)->whereBetween('punch_in', [$fromDate, $toDate . ' 23:59:59'])->orderBy('id', 'DESC')->paginate(10);
  }
  public function getLastTenDaysAttendance()
  {
    $userId = Auth()->guard('employee')->user()->id ?? auth()->guard('employee_api')->user()->id;
    return $this->employeeAttendanceRepository->where('user_id', $userId)->where('punch_in', '>', now()->subDays(10)->endOfDay())->orderBy('id', 'DESC')->get();
  }
  public function getWorkingHours($attendanceDetails)
  {
    if ($attendanceDetails) {
      $punch_in = $attendanceDetails->punch_in;
      $punch_out = $attendanceDetails->punch_out;
      if ($punch_in != '' && $punch_out != '') {
        $startTime = strtotime($punch_in);
        $endTime = strtotime($punch_out);

        // Calculate the difference in seconds
        $timeDiff = $endTime - $startTime;

        // Calculate hours, minutes, and seconds
        $hours = floor($timeDiff / 3600);
        $minutes = floor(($timeDiff % 3600) / 60);
        $seconds = $timeDiff % 60;

        // Display the result
        $hours = $hours > 9 ? $hours : '0' . $hours;
        $minutes = $minutes > 9 ? $minutes : '0' . $minutes;
        $seconds = $seconds > 9 ? $seconds : '0' . $seconds;
        $time = $hours . ':' . $minutes . ':' . $seconds;
        return $time;
      } else {
        return '00:00:00';
      }
    } else {
      return '00:00:00';
    }
  }
}
