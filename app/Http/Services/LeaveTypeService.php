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

  /**
   * Undocumented function
   *
   * @return void
   */
  public function all()
  {
    return $this->leaveTypeRepository->orderBy('id', 'DESC')->paginate(10);
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @return void
   */
  public function create(array $data)
  {
    $data['company_id'] = Auth()->user()->company_id ?? '';
    $data['created_by'] = Auth()->user()->id ?? '';
    return $this->leaveTypeRepository->create($data);
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @param [type] $id
   * @return void
   */
  public function updateDetails(array $data, $id)
  {
    return $this->leaveTypeRepository->find($id)->update($data);
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function deleteDetails($id)
  {
    return $this->leaveTypeRepository->find($id)->delete();
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function getAllActiveLeaveType()
  {
    return $this->leaveTypeRepository->where('status', '1')->get();
  }
}
