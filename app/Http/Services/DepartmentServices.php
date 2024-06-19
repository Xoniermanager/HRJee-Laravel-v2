<?php

namespace App\Http\Services;

use App\Repositories\DepartmentRepository;

class DepartmentServices
{
  private $departmentRepository;
  public function __construct(DepartmentRepository $departmentRepository)
  {
    $this->departmentRepository = $departmentRepository;
  }
  public function all()
  {
    return $this->departmentRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    return $this->departmentRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->departmentRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->departmentRepository->find($id)->delete();
  }

  public function serachDepartmentFilterList($request)
  {
    $departmentDetails = $this->departmentRepository;
    /**List By Search or Filter */
    if (isset($request->search) && !empty($request->search)) {
      $departmentDetails = $departmentDetails->where('name', 'Like', '%' . $request->search . '%');
    }
    /**List By Status or Filter */
    if (isset($request->status) && !empty($request->status)) {
      if ($request->status == 2) {
        $status = 0;
      } else {
        $status = $request->status;
      }
      $departmentDetails = $departmentDetails->where('status',$status);
    }
    return $departmentDetails->orderBy('id', 'DESC')->paginate(10);
  }
}
