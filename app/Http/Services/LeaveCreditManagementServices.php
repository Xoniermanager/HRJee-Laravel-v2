<?php

namespace App\Http\Services;

use App\Repositories\LeaveCreditManagementRepository;

class LeaveCreditManagementServices
{
  private $leaveCreditManagementRepository;
  public function __construct(LeaveCreditManagementRepository $leaveCreditManagementRepository)
  {
    $this->leaveCreditManagementRepository = $leaveCreditManagementRepository;
  }
  public function all()
  {
    return $this->leaveCreditManagementRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    return $this->leaveCreditManagementRepository->create($data);
  }
  public function updateDetails($data)
  {
    return $this->leaveCreditManagementRepository->find($data['id'])->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->leaveCreditManagementRepository->find($id)->delete();
  }
  public function serachLeaveCreditFilterList($request)
  {
    $leaveCreditManagementDetails = $this->leaveCreditManagementRepository;
    /**List By Status or Filter */
    if (isset($request->status)) {
      $leaveCreditManagementDetails = $leaveCreditManagementDetails->where('status', $request->status);
    }
    /**List By Company Branches or Filter */
    if (isset($request->filter_company_branch)) {
      $leaveCreditManagementDetails = $leaveCreditManagementDetails->where('company_branch_id', $request->filter_company_branch);
    }
    /**List By Employee Type or Filter */
    if (isset($request->filter_employee_type)) {
      $leaveCreditManagementDetails = $leaveCreditManagementDetails->where('employee_type_id', $request->filter_employee_type);
    }
    /**List By Leave Type or Filter */
    if (isset($request->filter_leave_type)) {
      $leaveCreditManagementDetails = $leaveCreditManagementDetails->where('leave_type_id', $request->filter_leave_type);
    }
    return $leaveCreditManagementDetails->orderBy('id', 'DESC')->paginate(10);
  }
}
