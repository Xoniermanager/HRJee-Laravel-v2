<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\LeaveTypeRepository;

class LeaveTypeService
{
  private $leaveTypeRepository;
  public function __construct(LeaveTypeRepository $leaveTypeRepository)
  {
    $this->leaveTypeRepository = $leaveTypeRepository;
  }
  public function all()
  {
    return $this->leaveTypeRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    $data['company_id'] = Auth::guard('admin')->user()->id ?? '';
    return $this->leaveTypeRepository->create($data);
  }
  public function updateDetails(array $data, $id)
  {
    return $this->leaveTypeRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->leaveTypeRepository->find($id)->delete();
  }
  public function getAllActiveLeaveType()
  {
    return $this->leaveTypeRepository->where('status','1')->get();
  }
}
