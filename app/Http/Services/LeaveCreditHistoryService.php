<?php

namespace App\Http\Services;

use App\Repositories\LeaveCreditHistoryRepository;

class LeaveCreditHistoryService
{
  private $leaveCreditHistoryRepository;
  public function __construct(LeaveCreditHistoryRepository $leaveCreditHistoryRepository)
  {
    $this->leaveCreditHistoryRepository = $leaveCreditHistoryRepository;
  }

  /**
   * Undocumented function
   *
   * @param [type] $userId
   * @param [type] $leaveCreditManagementid
   * @return void
   */
  public function createHistory($userId, $leaveCreditManagementid)
  {
    $data = [
      'user_id' => $userId,
      'leave_credit_management_id' => $leaveCreditManagementid,
    ];
    $response = $this->leaveCreditHistoryRepository->create($data);
    if ($response) {
      return true;
    } else {
      return false;
    }
  }

  /**
   * Undocumented function
   *
   * @param [type] $leaveCreditManagementId
   * @param [type] $userId
   * @return void
   */
  public function getDetailsByLeaveCreditManagementIdUserId($leaveCreditManagementId, $userId)
  {
    return $this->leaveCreditHistoryRepository->where('leave_credit_management_id', $leaveCreditManagementId)->where('user_id', $userId)->orderBy('id', 'Desc')->first();
  }
}
