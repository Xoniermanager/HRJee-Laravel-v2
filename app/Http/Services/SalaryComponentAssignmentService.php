<?php

namespace App\Http\Services;

use App\Repositories\SalaryComponentAssignmentRepository;

class SalaryComponentAssignmentService
{
    private $salaryComponentAssignmentRepository;

    public function __construct(SalaryComponentAssignmentRepository $salaryComponentAssignmentRepository)
    {
        $this->salaryComponentAssignmentRepository = $salaryComponentAssignmentRepository;
    }

    public function getAllSalaryComponentAssignmentByCompanyId($companyId)
    {
        return $this->salaryComponentAssignmentRepository->where('company_id', $companyId)->orderBy('id', 'DESC');
    }
    public function create($data)
    {
        return $this->salaryComponentAssignmentRepository->create($data);
    }
    public function updateDetails($data, $id)
    {
        return $this->salaryComponentAssignmentRepository->find($id)->update($data);
    }
    public function deleteDetails($id)
    {
        return $this->salaryComponentAssignmentRepository->find($id)->delete();
    }

    public function serachSalaryComponentAssignmentFilterList($request, $companyID)
    {
        $salaryComponentDetails = $this->salaryComponentAssignmentRepository->where('company_id', $companyID);
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
        return $this->salaryComponentAssignmentRepository->where('company_id', $companyId)->where('name', 'Basic Pay')->first();
    }

    public function getDetailsBySalaryComponentAssignmentId($salaryComponentAssignId)
    {
        return $this->salaryComponentAssignmentRepository->find($salaryComponentAssignId);
    }
}
