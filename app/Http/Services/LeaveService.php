<?php

namespace App\Http\Services;

use App\Models\LeaveStatus;
use Illuminate\Support\Facades\Auth;
use App\Repositories\LeaveRepository;

class LeaveService
{
  private $leaveRepository;
  public function __construct(LeaveRepository $leaveRepository)
  {
    $this->leaveRepository = $leaveRepository;
  }
  public function all()
  {
    return $this->leaveRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    $payload = array();
    $payload =
      [
        'leave_type_id'            => $data['leave_type_id'],
        'from'                     => $data['from'],
        'to'                       => $data['to'],
        'reason'                   => $data['reason'],
        'leave_status_id'          => LeaveStatus::PENDING
      ];

    if(isset($data['leave_applied_by']) && !empty($data['leave_applied_by'])) {
        $payload['user_id']          = $data['user_id'];
    } 
    else {
      $payload['leave_applied_by'] = Auth::guard('admin')->user()->id ?? Auth::guard('employee')->user()->id ?? Auth()->user()->id;           
      $payload['user_id'] = Auth::guard('admin')->user()->id ?? Auth::guard('employee')->user()->id ?? Auth()->user()->id;
    }
    if (isset($data['is_half_day']) && !empty($data['is_half_day'])) {
      $payload['is_half_day']      = $data['is_half_day'];
      $payload['from_half_day']    = $data['from_half_day'];
      $payload['to_half_day']      = $data['to_half_day'] ?? '';
    }
    return $this->leaveRepository->create($payload);
  }
  public function updateDetails(array $data, $id)
  {
    return $this->leaveRepository->find($id)->update($data);
  }
  public function getLeaveDetailsOnlyUserId()
  {
    return $this->leaveRepository->select('id', 'user_id')->get();
  }
  public function getAppliedLeaveDetailsUsingId($id)
  {
    return $this->leaveRepository->find($id);
  }
}
