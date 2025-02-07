<?php

namespace App\Http\Services;

use App\Repositories\SalaryComponentRepository;

class SalaryComponentService
{
    private $salaryComponentRepository;

    public function __construct(SalaryComponentRepository $salaryComponentRepository)
    {
        $this->salaryComponentRepository = $salaryComponentRepository;
    }

    public function getAllSalaryComponentByCompanyId($companyId)
    {
        return $this->salaryComponentRepository->where('company_id', $companyId)->orderBy('id', 'DESC');
    }
    public function getActiveSalaryComponentByCompanyId($companyId)
    {
        return $this->salaryComponentRepository->where('company_id', $companyId)->where('status', '1')->get();
    }
    public function create($data)
    {
        return $this->salaryComponentRepository->create($data);
    }
    public function updateDetails($data, $id)
    {
        return $this->salaryComponentRepository->find($id)->update($data);
    }
    public function deleteDetails($id)
    {
        return $this->salaryComponentRepository->find($id)->delete();
    }

    public function serachSalaryComponentFilterList($request, $companyID)
    {
        $salaryComponentDetails = $this->salaryComponentRepository->where('company_id', $companyID);
        if (isset($request['search']) && !empty($request['search'])) {
            $salaryComponentDetails->where('name', 'Like', '%' . $request['search'] . '%');
            $salaryComponentDetails->orWhere('value_type', 'Like', '%' . $request['search'] . '%');
            $salaryComponentDetails->orWhere('earning_or_deduction', 'Like', '%' . $request['search'] . '%');
        }
        /**List By is_default or Filter */
        if (isset($request['is_default']) && $request['is_default'] != "") {
            $salaryComponentDetails->where('is_default', $request['is_default']);
        }
        /**List By earning_or_deduction or Filter */
        if (isset($request['earning_or_deduction']) && $request['earning_or_deduction'] != "") {
            $salaryComponentDetails->where('earning_or_deduction', $request['earning_or_deduction']);
        }
        return $salaryComponentDetails->orderBy('id', 'DESC')->paginate(10);
    }

    public function getBasicPayDetails($companyId)
    {
        return $this->salaryComponentRepository->where('company_id', $companyId)->where('name', 'Basic Pay')->first();
    }

    public function getDetailsBySalaryComponentId($salaryComponentId)
    {
        return $this->salaryComponentRepository->find($salaryComponentId);
    }
}
