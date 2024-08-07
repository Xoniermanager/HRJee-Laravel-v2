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
  
  public function getDepartmentsByAdminAndCompany()
  {
    return $this->departmentRepository->whereNull('company_id')->orWhere('company_id', auth()->guard('admin')->user()->id)->get();
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
      $departmentDetails = $departmentDetails->where('status', $status);
    }
    return $departmentDetails->orderBy('id', 'DESC')->paginate(10);
  }

  public function getAllActiveDepartments()
  {
    return $this->departmentRepository->where('status', '1')->get();
  }
  public function getAllActiveDepartmentsUsingByCompanyID($companyId)
  {
    return $this->departmentRepository->where('company_id', $companyId)->orwhere('company_id', NUll)->where('status', '1')->get();
  }


   // if for this use already have created then let me know
   public function getAllDepartmentByDepartmentId($ids)
   {
     return $this->departmentRepository->whereIn('id',$ids)->get();
   }
}
