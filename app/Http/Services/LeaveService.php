<?php

namespace App\Http\Services;

use Carbon\Carbon;
use App\Models\LeaveStatus;
use Illuminate\Support\Facades\Auth;
use App\Repositories\LeaveRepository;

class LeaveService
{
  private $leaveRepository;
  private $employeeLeaveAvailableService;
  public function __construct(LeaveRepository $leaveRepository, EmployeeLeaveAvailableService $employeeLeaveAvailableService)
  {
    $this->leaveRepository = $leaveRepository;
    $this->employeeLeaveAvailableService = $employeeLeaveAvailableService;
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

    if (isset($data['leave_applied_by']) && !empty($data['leave_applied_by'])) {
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
    $appliedLeaveDetails = $this->leaveRepository->create($payload);
    if ($appliedLeaveDetails)
    {
      $startDate = Carbon::parse($data['from']);
      $endDate = Carbon::parse($data['to']);
      $days = $startDate->diffInDays($endDate);
      $response = $this->employeeLeaveAvailableService->debitLeaveDetails($payload['user_id'], $data['leave_type_id'], $days);
    }
    return $response;
  }
  public function updateDetails(array $data, $id)
  {
    $existingUpdateDetails = $this->leaveRepository->find($id);
    if ($existingUpdateDetails) {
      $response = $existingUpdateDetails->update($data);
      if ($existingUpdateDetails->leave_status_id == 3 || $existingUpdateDetails->leave_status_id == 4) {
        $startDate = Carbon::parse($existingUpdateDetails->from);
        $endDate = Carbon::parse($existingUpdateDetails->to);
        $days = $startDate->diffInDays($endDate);
        $mode = "Leave Cancelled Or Rejected Reverse Leave Credit Amount";
        $response = $this->employeeLeaveAvailableService->createDetails($existingUpdateDetails->user_id, $existingUpdateDetails->leave_type_id, $days, $mode);
      }
    }
    return $response;
  }
  public function getLeaveDetailsOnlyUserId()
  {
    return $this->leaveRepository->select('id', 'user_id')->get();
  }
  public function getAppliedLeaveDetailsUsingId($id)
  {
    return $this->leaveRepository->where('id', $id)->where('leave_status_id', '!=', 3)->where('leave_status_id', '!=', 4)->first();
  }
  public function getDetailsById($id)
  {
    return $this->leaveRepository->find($id);
  }
}
