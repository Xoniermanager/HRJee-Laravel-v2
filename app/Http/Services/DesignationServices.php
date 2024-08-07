<?php

namespace App\Http\Services;

use App\Repositories\DesignationsRepository;

class DesignationServices
{
  private $designationRepository;
  public function __construct(DesignationsRepository $designationRepository)
  {
    $this->designationRepository = $designationRepository;
  }
  public function all()
  {
    return $this->designationRepository->with('departments')->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    return $this->designationRepository->create($data);
  }
  public function getDesignationsAdminOrCompany($department_id = '')
  {
    if (empty($department_id))
      return  $this->designationRepository->whereNull('company_id')->orWhere('company_id', auth()->guard('admin')->user()->id)->get();
    else
      return  $this->designationRepository->where('department_id', $department_id)->get();
  }

  public function updateDetails(array $data, $id)
  {
    return $this->designationRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->designationRepository->find($id)->delete();
  }

  public function getAllDesignationUsingDepartmentID($department_id)
  {
    return $this->designationRepository->whereIn('department_id', $department_id)->where('status', '1')->get();
  }
  public function serachDesignationFilterList($request)
  {
    $designationDetails = $this->designationRepository;
    /**List By Search or Filter */
    if (isset($request->search) && !empty($request->search)) {
      $designationDetails = $designationDetails->where('name', 'Like', '%' . $request->search . '%');
    }
    /**List By Status or Filter */
    if (isset($request->status) && !empty($request->status)) {
      if ($request->status == 2) {
        $status = 0;
      } else {
        $status = $request->status;
      }
      $designationDetails = $designationDetails->where('status', $status);
    }
    /**List By Department ID or Filter */
    if (isset($request->department_id) && !empty($request->department_id)) {
      $designationDetails = $designationDetails->where('department_id', $request->department_id);
    }
    return $designationDetails->orderBy('id', 'DESC')->paginate(10);
  }


  public function getAllDesignationByDesignationId($ids)
  {
    return $this->designationRepository->whereIn('id', $ids)->get();
  }
}
