<?php

namespace App\Http\Services;

use Carbon\Carbon;
use App\Repositories\EmployeeAttendanceRepository;

class EmployeeAttendanceService
{
  private $employeeAttendanceRepository;

  private $userDetailRepository;

  public function __construct(EmployeeAttendanceRepository $employeeAttendanceRepository, UserDetailServices $userDetailRepository)
  {
    $this->employeeAttendanceRepository = $employeeAttendanceRepository;
    $this->userDetailRepository = $userDetailRepository;
  }
  public function create($data)
  {
    $userId = Auth()->guard('employee')->user()->id ?? auth()->guard('employee_api')->user()->id;
    $attendanceTime = date('Y/m/d H:i:s');
    $userDetails =  $this->userDetailRepository->getDetailsByUserId($userId);
    $startingTime = Carbon::parse($userDetails->officeShift->start_time);
    $loginBeforeShiftTime = $startingTime->subMinutes($userDetails->officeShift->login_before_shift_time);
    // dd($userDetails->officeShift->officeTimingConfigs->half_day_hours);
    if ($attendanceTime >= $loginBeforeShiftTime) {
      $payload = [];
      $payload =
        [
          'user_id' => $userId,
          'punch_in_using' => $data['punch_in_using']
        ];
      /** If Data Exit in Table Soo we Implement for Puch Out  */
      $existingDetails = $this->getExtistingDetailsByUserId($userId);
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
}
