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

    public function getByCompanyId($companyID)
    {
        return $this->departmentRepository->whereIn('company_id', $companyID)->orderBy('id', 'DESC')->paginate(10);
    }

    public function create(array $data)
    {
        return $this->departmentRepository->create($data);
    }

    public function getAllDepartmentsByCompanyId($companyID)
    {
        return $this->departmentRepository->whereIn('company_id', $companyID)->get();
    }

    public function updateDetails(array $data, $id)
    {
        return $this->departmentRepository->find($id)->update($data);
    }
    public function deleteDetails($id)
    {
        return $this->departmentRepository->find($id)->delete();
    }

    public function serachDepartmentFilterList($request, $companyID)
    {
        $departmentDetails = $this->departmentRepository->where('company_id', $companyID);
        /**List By Search or Filter */
        if (isset($request['search']) && !empty($request['search'])) {
            $departmentDetails = $departmentDetails->where('name', 'Like', '%' . $request['search'] . '%');
        }
        /**List By Status or Filter */
        if (isset($request['status']) && $request['status'] != "") {
            $departmentDetails = $departmentDetails->where('status', $request['status']);
        }
        return $departmentDetails->orderBy('id', 'DESC')->paginate(10);
    }

    public function getAllActiveDepartments()
    {
        return $this->departmentRepository->where('status', '1')->get();
    }
    public function getAllActiveDepartmentsByCompanyId($companyId)
    {
        if(is_array($companyId)) {
            return $this->departmentRepository->whereIn('company_id', $companyId)->where('status', '1')->get();
        } else {
            return $this->departmentRepository->where('company_id', $companyId)->where('status', '1')->get();
        }
    }
    public function getAllAssignedDepartment($data)
    {
        if ($data->all_department == 1) {
            return $this->getAllActiveDepartmentsByCompanyId($data->company_id)->pluck('id')->toArray();
        } else {
            return $data->departments->pluck('id')->toArray();
        }
    }
}
