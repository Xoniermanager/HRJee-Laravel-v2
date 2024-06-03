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
    return $this->designationRepository->where('department_id', $department_id)->where('status', '1')->get();
  }
  public function searchInDesignation($searchKey)
  {

    $data['key']          = array_key_exists('key', $searchKey) ? $searchKey['key'] : '';
    $data['status']       = array_key_exists('status', $searchKey) ? $searchKey['status'] : '';
    $data['departmentID'] = array_key_exists('departmentID', $searchKey) ? $searchKey['departmentID'] : '';

    return $this->designationRepository->where(function($query) use ($data) {
      if (!empty($data['key'])) {
          $query->where('name', 'like', "%{$data['key']}%");
      }
      if (!empty($data['departmentID'])) {
          $query->where('department_id', $data['departmentID']);
      }
      if (isset($data['status'])) {
          $query->where('status', $data['status']);
      }
    })->get();

  }

}
