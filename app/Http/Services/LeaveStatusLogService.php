<?php

namespace App\Http\Services;

use App\Repositories\LeaveStatusLogRepository;

class LeaveStatusLogService
{
  private $leaveStatusLogRepository;
  private $leaveService;
  public function __construct(LeaveStatusLogRepository $leaveStatusLogRepository, LeaveService $leaveService)
  {
    $this->leaveStatusLogRepository = $leaveStatusLogRepository;
    $this->leaveService = $leaveService;
  }
  public function all()
  {
    return $this->leaveStatusLogRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    $data['action_taken_by'] = '1'; //Auth()->user()->company_id;
    if ($this->leaveStatusLogRepository->create($data)) {
      $payload = [
        'leave_status_id' => $data['leave_status_id']
      ];
      $response = $this->leaveService->updateDetails($payload, $data['leave_id']);
    }
    return $response;
  }

  public function getDetailsByLeaveId($id)
  {
    return $this->leaveStatusLogRepository->where('leave_id', $id)->first();
  }
}
