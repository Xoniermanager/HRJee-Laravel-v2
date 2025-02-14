<?php

namespace App\Http\Services;

use App\Repositories\LeaveStatusLogRepository;
use App\Repositories\LeaveManagerUpdateRepository;

class LeaveStatusLogService
{
  private $leaveStatusLogRepository;
  private $leaveManagerUpdateRepository;
  private $leaveService;

  public function __construct(LeaveStatusLogRepository $leaveStatusLogRepository, LeaveManagerUpdateRepository $leaveManagerUpdateRepository, LeaveService $leaveService)
  {
    $this->leaveStatusLogRepository = $leaveStatusLogRepository;
    $this->leaveManagerUpdateRepository = $leaveManagerUpdateRepository;
    $this->leaveService = $leaveService;
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function all()
  {
    return $this->leaveStatusLogRepository->orderBy('id', 'DESC')->paginate(10);
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @return void
   */
  public function create(array $data)
  {
    //$data['action_taken_by'] = '1'; //Auth()->user()->company_id;
    $data['action_taken_by'] = Auth()->user()->id;
    if ($this->leaveStatusLogRepository->create($data)) {
      $payload = [
        'leave_status_id' => $data['leave_status_id']
      ];

      if(Auth()->user()->type == "company") {
        $this->leaveService->updateDetails($payload, $data['leave_id']);
      } else {
        $this->leaveManagerUpdateRepository->where('leave_id', $data['leave_id'])->where('manager_id', $data['action_taken_by'])->update([
          'leave_status_id' => $data['leave_status_id'],
          'remark' => $data['remarks'],
        ]);

        $pendingStatus = $this->leaveManagerUpdateRepository->where('leave_id', $data['leave_id'])->where('leave_status_id', 1)->count();

        if(!$pendingStatus) {
          $this->leaveService->updateDetails($payload, $data['leave_id']);
        }
      }
    }
    return true;
  }

  /**
   * Get log details by leave id
   *
   * @param [type] $id
   * @return collection
   */
  public function getDetailsByLeaveId($id)
  {
    return $this->leaveStatusLogRepository->where('leave_id', $id)->get();
  }

  /**
   * Get manager details by leave id
   *
   * @param [type] $id
   * @return collection
   */
  public function getManagerDetailsByLeaveId($id)
  {
    return $this->leaveManagerUpdateRepository->where('leave_id', $id)->get();
  }
}
