<?php

namespace App\Http\Services;

use App\Repositories\DesignationsRepository;

class DesignationServices
{
  private $designationRepository;
  private $departmentService;
  public function __construct(DesignationsRepository $designationRepository, DepartmentServices $departmentService)
  {
    $this->designationRepository = $designationRepository;
    $this->departmentService = $departmentService;
  }
  public function all()
  {
    return $this->designationRepository->with('departments')->orderBy('id', 'DESC')->paginate(10);
  }

  public function getByCompanyId($companyID)
  {
    return $this->designationRepository->whereIn('created_by', $companyID)->orderBy('id', 'DESC')->paginate(10);
  }

  public function create(array $data)
  {
    return $this->designationRepository->create($data);
  }
  public function getDesignationsAdminOrCompany($department_id = '')
  {
    if (empty($department_id))
      return $this->designationRepository->whereNull('company_id')->orWhere('company_id', Auth()->user()->id)->get();
    else
      return $this->designationRepository->where('department_id', $department_id)->get();
  }

  public function updateDetails(array $data, $id)
  {
    return $this->designationRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->designationRepository->find($id)->delete();
  }

  public function getAllDesignationByDepartmentIds($departmentIds = null, $allDepartment = null)
  {
    if ($allDepartment == true) {
      $company_id = Auth()->user()->id ?? Auth()->user()->company_id ?? auth()->guard('employee_api')->user()->company_id;
      $departmentIds = $this->departmentService->getAllActiveDepartmentsByCompanyId($company_id)->pluck('id')->toArray();
      return $this->designationRepository->whereIn('department_id', $departmentIds)->where('status', '1')->get();
    } else {
      return $this->designationRepository->whereIn('department_id', $departmentIds)->where('status', '1')->get();
    }
  }
  public function serachDesignationFilterList($request)
  {
    $designationDetails = $this->designationRepository;
    /**List By Search or Filter */
    if (isset($request['search']) && !empty($request['search'])) {
      $designationDetails = $designationDetails->where('name', 'Like', '%' . $request['search'] . '%');
    }
    /**List By Status or Filter */
    if (isset($request['status']) && $request['status'] != "") {
      $designationDetails = $designationDetails->where('status', $request['status']);
    }
    /**List By Department ID or Filter */
    if (isset($request['department_id']) && !empty($request['department_id'])) {
      $designationDetails = $designationDetails->where('department_id', $request['department_id']);
    }
    return $designationDetails->orderBy('id', 'DESC')->paginate(10);
  }
  public function getAllAssignedDesignation($data)
  {
    if ($data->all_designation == 1) {
      return $this->getAllDesignationByDepartmentIds('', true)->pluck('id')->toArray();
    } else {
      return $data->designations->pluck('id')->toArray();
    }
  }
}
