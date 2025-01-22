<?php

namespace App\Http\Services;

use App\Repositories\EmployeeLeaveAvailableRepository;

class EmployeeLeaveAvailableService
{
  private $employeeLeaveAvailableRepository;
  private $employeeLeaveManagementService;
  public function __construct(EmployeeLeaveAvailableRepository $employeeLeaveAvailableRepository, EmployeeLeaveManagementService $employeeLeaveManagementService)
  {
    $this->employeeLeaveAvailableRepository = $employeeLeaveAvailableRepository;
    $this->employeeLeaveManagementService  = $employeeLeaveManagementService;
  }

  public function getAllEmployeeLeaveAvailable()
  {
    return $this->employeeLeaveAvailableRepository->paginate(10)->groupBy('user_id');
  }
  public function getAllLeaveAvailableByUserId($id)
  {
    return $this->employeeLeaveAvailableRepository->where('user_id',$id)->paginate(10)->groupBy('leave_type_id');
  }
  public function createDetails($userId, $leaveTypeId, $creditValue, $mode)
  {
    $existingDetails = $this->employeeLeaveAvailableRepository->where('user_id', $userId)->where('leave_type_id', $leaveTypeId)->orderBy('id', 'Desc')->first();
    if (isset($existingDetails) && !empty($existingDetails)) {
      $finalAvailableValue = $existingDetails->available + $creditValue;
      $updateDetails = $existingDetails->update(['available' => $finalAvailableValue]);
      if ($updateDetails) {
        $response = $this->employeeLeaveManagementService->createAndUpdateToCreditDetails($userId, $existingDetails->id, $creditValue, $mode);
      }
    } else {
      $data =
        [
          'user_id'            => $userId,
          'leave_type_id'      => $leaveTypeId,
          'available'          => $creditValue
        ];
      $createLeaveDetails = $this->employeeLeaveAvailableRepository->create($data);
      if ($createLeaveDetails) {
        $response = $this->employeeLeaveManagementService->createAndUpdateToCreditDetails($userId, $createLeaveDetails->id, $creditValue, $mode);
      }
    }
    return $response;
  }
  public function debitLeaveDetails($userId, $leaveTypeId, $debitValue)
  {
    $existingDetails = $this->employeeLeaveAvailableRepository->where('user_id', $userId)->where('leave_type_id', $leaveTypeId)->orderBy('id', 'Desc')->first();
    $response = array('status'=>true,'message'=>'leave not available','data'=>[]);

    if (isset($existingDetails) && !empty($existingDetails)) {
      $finalAvailableValue = $existingDetails->available - $debitValue;
      $updateDetails = $existingDetails->update(['available' => $finalAvailableValue]);
      if ($updateDetails) {
        $data = $this->employeeLeaveManagementService->debitLeaveDetails($userId, $existingDetails->id, $debitValue);
        $response = array('status'=>true,'message'=>'leave not available','data'=>$data);
      }
    }
    return $response;
  }
}
