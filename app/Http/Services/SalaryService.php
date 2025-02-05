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
        return $this->salaryRepository->where('company_id',$companyId)->orderBy('id', 'DESC');
    }
    public function getAllActiveSalaries($companyId)
    {
        return $this->salaryRepository->where('company_id',$companyId)->where('status','1')->get();
    }
    public function create(array $data)
    {
        return $this->salaryRepository->create($data);
    }
    public function updateDetails(array $data, $id)
    {
        return $this->salaryRepository->find($id)->update($data);
    }
    public function deleteDetails($id)
    {
        return $this->salaryRepository->find($id)->delete();
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
}
