<?php

namespace App\Http\Services;

use App\Repositories\EmployeeLeaveManagementRepository;

class EmployeeLeaveManagementService
{
  private $emoloyeeLeaveManagementRepository;
  public function __construct(EmployeeLeaveManagementRepository $emoloyeeLeaveManagementRepository)
  {
    $this->emoloyeeLeaveManagementRepository = $emoloyeeLeaveManagementRepository;
  }

  /**
   * Undocumented function
   *
   * @param [type] $userID
   * @param [type] $employeeLeaveAvailableId
   * @param [type] $creditValue
   * @param [type] $mode
   * @return void
   */
  public function createAndUpdateToCreditDetails($userID, $employeeLeaveAvailableId, $creditValue, $mode)
  {
    $data = [
      'employee_leave_available_id' => $employeeLeaveAvailableId,
      'user_id' => $userID,
      'credit' => $creditValue,
      'mode'   => $mode
    ];
    $finalCreditedDetails = $this->emoloyeeLeaveManagementRepository->where('employee_leave_available_id', $employeeLeaveAvailableId)->orderBy('id', 'DESC')->first();
    if (isset($finalCreditedDetails) && !empty($finalCreditedDetails)) {
      $data['available'] = $finalCreditedDetails->available + $creditValue;
    } else {
      $data['available'] = $creditValue;
    }
    $response = $this->emoloyeeLeaveManagementRepository->create($data);
    if ($response) {
      return true;
    } else {
      return false;
    }
  }

  /** Debit Operation After applied Leave*/
  /**
   * Undocumented function
   *
   * @param [type] $userID
   * @param [type] $employeeLeaveAvailableId
   * @param [type] $debitValue
   * @return void
   */
  public function debitLeaveDetails($userID, $employeeLeaveAvailableId, $debitValue)
  {
    $data = [
      'employee_leave_available_id' => $employeeLeaveAvailableId,
      'user_id' => $userID,
      'debit' => $debitValue,
      'mode'   => 'Applied Leave'
    ];
    $finalCreditedDetails = $this->emoloyeeLeaveManagementRepository->where('employee_leave_available_id', $employeeLeaveAvailableId)->orderBy('id', 'DESC')->first();
    if (isset($finalCreditedDetails) && !empty($finalCreditedDetails)) {
      $data['available'] = $finalCreditedDetails->available - $debitValue;
    } else {
      $data['available'] = $debitValue;
    }
    $response = $this->emoloyeeLeaveManagementRepository->create($data);
    if ($response) {
      return true;
    } else {
      return false;
    }
  }
}
