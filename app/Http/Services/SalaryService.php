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

    /**
     * Undocumented function
     *
     * @param [type] $companyId
     * @return null
     */
    public function getAllSalariesByCompanyId($companyId)
    {
        return $this->salaryRepository->where('company_id', $companyId)->orderBy('id', 'DESC');
    }

    /**
     * Undocumented function
     *
     * @param [type] $companyId
     * @return void
     */
    public function getAllActiveSalaries($companyId)
    {
        return $this->salaryRepository->where('company_id', $companyId)->where('status', '1')->with('salaryComponentAssignments')->get();
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        $createdSalary = $this->salaryRepository->create($data);
        $createdSalary->createSalaryComponentAssignment($data['componentDetails']);
        return true;
    }

    /**
     * Undocumented function
     *
     * @param array $data
     * @param [type] $id
     * @return void
     */
    public function updateDetails(array $data, $id)
    {
        $salariesDetails = $this->salaryRepository->find($id);
        $salariesDetails->createSalaryComponentAssignment($data['componentDetails']);
        return $salariesDetails->update($data);
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDetails($id)
    {
        $salaryDetails = $this->salaryRepository->find($id);
        $salaryDetails->salaryComponentAssignments()->delete();
        return $salaryDetails->delete();
    }

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @param [type] $companyID
     * @return void
     */
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

    /**
     * Undocumented function
     *
     * @param [type] $salaryId
     * @return void
     */
    public function getSalaryIdById($salaryId)
    {
        return $this->salaryRepository->find($salaryId);
    }
    public function statusUpdatebyStructuredId($salaryId,$status)
    {
        return $this->salaryRepository->find($salaryId)->update(['status' => $status]);
    }
}
