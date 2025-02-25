<?php

namespace App\Http\Services;

use App\Repositories\SalaryRepository;

class SalaryService
{
    private $salaryRepository;

    public function __construct(SalaryRepository $salaryRepository)
    {
        $this->salaryRepository = $salaryRepository;
    }

    public function getAllSalariesByCompanyId($companyId)
    {
        return $this->salaryRepository->where('company_id', $companyId)->orderBy('id', 'DESC');
    }
    public function getAllActiveSalaries($companyId)
    {
        return $this->salaryRepository->where('company_id', $companyId)->where('status', '1')->with('salaryComponentAssignments')->get();
    }
    public function create(array $data)
    {
        $createdSalary = $this->salaryRepository->create($data);
        $createdSalary->createSalaryComponentAssignment($data['componentDetails']);
        return true;
    }
    public function updateDetails(array $data, $id)
    {
        $salariesDetails = $this->salaryRepository->find($id);
        $salariesDetails->createSalaryComponentAssignment($data['componentDetails']);
        return $salariesDetails->update($data);
    }
    public function deleteDetails($id)
    {
        $salaryDetails = $this->salaryRepository->find($id);
        $salaryDetails->salaryComponentAssignments()->delete();
        return $salaryDetails->delete();
    }

    public function serachSalaryFilterList($request, $companyID)
    {
        $salaryDetails = $this->salaryRepository->where('company_id', $companyID);
        /**List By Search or Filter */
        if (isset($request['search']) && !empty($request['search'])) {
            $salaryDetails = $salaryDetails->where('name', 'Like', '%' . $request['search'] . '%');
        }
        /**List By Status or Filter */
        if (isset($request['status']) && $request['status'] != "") {
            $salaryDetails = $salaryDetails->where('status', $request['status']);
        }
        return $salaryDetails->orderBy('id', 'DESC')->paginate(10);
    }

    public function getSalaryIdById($salaryId)
    {
        return $this->salaryRepository->find($salaryId);
    }
}
