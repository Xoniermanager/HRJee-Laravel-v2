<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\LeaveStatusRepository;

class LeaveStatusService
{
  private $leaveStatusRepository;
  public function __construct(LeaveStatusRepository $leaveStatusRepository)
  {
    $this->leaveStatusRepository = $leaveStatusRepository;
  }
  public function all()
  {
    return $this->leaveStatusRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    $data['company_id'] = Auth()->user()->company_id ?? '';
    $data['created_by'] = Auth()->user()->id ?? '';
    return $this->leaveStatusRepository->create($data);
  }
  public function updateDetails(array $data, $id)
  {
    return $this->leaveStatusRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->leaveStatusRepository->find($id)->delete();
  }

  public function getAllActiveLeaveStatus()
  {
    return $this->leaveStatusRepository->where('status', '1')->get();
  }
}
