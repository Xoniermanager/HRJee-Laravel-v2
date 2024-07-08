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
    $userId = Auth()->guard('employee')->user()->id;
    $userDetails =  $this->userDetailRepository->getDetailsByUserId($userId);
    $startingTime = Carbon::parse($userDetails->officeShift->start_time);
    $loginBeforeShiftTime = $startingTime->subMinutes($userDetails->officeShift->login_before_shift_time);
    // dd($userDetails->officeShift->officeTimingConfigs->half_day_hours);
    if ($data['time_date'] >= $loginBeforeShiftTime) {
      $payload = [];
      $payload =
        [
          'user_id' => $userId,
          'punch_in_using' => 'Web'
        ];
      /** If Data Exit in Table Soo we Implement for Puch Out  */
      $existingDetails = $this->getExtistingDetailsByUserId($userId);
      if (isset($existingDetails) && !empty($existingDetails)) {
        $payload['punch_out'] = $data['time_date'];
        $puchOutDetail =  $this->employeeAttendanceRepository->find($existingDetails->id)->update($payload);
      }

      /** If Data No Exit in Table Soo we Implement for Puch In  */
      else {
        $payload['punch_in'] = $data['time_date'];
        $puchInDetail =  $this->employeeAttendanceRepository->create($payload);
      }
      if (isset($puchInDetail)) {
        $data = 'Puch In';
      }
      if (isset($puchOutDetail)) {
        $data = 'Puch Out';
      }
      return $response = ['data' => $data, 'status' => true];
    } else {
      return $response = ['status' => true];
    }
  }

  public function getExtistingDetailsByUserId($userId)
  {
    return $this->employeeAttendanceRepository->where('user_id', $userId)->whereDate('created_at', Carbon::today())->first();
  }
}
