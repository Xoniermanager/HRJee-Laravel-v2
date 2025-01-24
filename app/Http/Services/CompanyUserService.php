<?php

namespace App\Http\Services;

use App\Repositories\CompanyUserRepository;

class CompanyUserService
{
    private $companyUserRepository;
    public function __construct(CompanyUserRepository $companyUserRepository)
    {
        $this->companyUserRepository = $companyUserRepository;
    }
    public function all()
    {
        return $this->companyUserRepository->all();
    }
    public function create($data)
    {
        return $this->companyUserRepository->create($data);
    }
    public function updateOrCreate($match, $data)
    {
        return $this->companyUserRepository->updateOrCreate($match, $data);
    }
    public function updateDetails(array $data, $id)
    {
        return $this->companyUserRepository->find($id)->update($data);
    }

    public function updateDetailsByCompanyId(array $data, $id)
    {
        return $this->companyUserRepository->where('company_id', $id)->update($data);
    }
    public function deleteDetails($id)
    {
        return $this->companyUserRepository->find($id)->delete();
    }

    public function hardDelete($id)
    {
        return $this->companyUserRepository->find($id)->forceDelete();
    }

    public function softDelete($id)
    {
        return $this->companyUserRepository->where('branch_id', $id)->delete();
    }
    public function searchInCompany($searchKey)
    {
        $data['key']     =  array_key_exists('key', $searchKey) ? $searchKey['key'] : '';
        $data['status']  =  array_key_exists('status', $searchKey) ? $searchKey['status'] : '';

        return $this->companyUserRepository->where(function ($query) use ($data) {
            if (!empty($data['key'])) {
                $query->where('name', 'like', "%{$data['key']}%")
                    ->orWhere('username', 'like', "%{$data['key']}%")
                    ->orWhere('email', 'like', "%{$data['key']}%")
                    ->orWhere('contact_no', 'like', "%{$data['key']}%")
                    ->orWhere('company_address', 'like', "%{$data['key']}%");
            }

            if (isset($data['status'])) {
                $query->where('status', $data['status']);
            }
        })->get();
    }
    public function delete_company_by_id($id)
    {
        return $this->companyUserRepository->getCompanyById($id)->delete();
    }
    public function get_company_by_id($id)
    {
        return $this->companyUserRepository->getCompanyById($id)->first();
    }
    public function update_company($data)
    {
        return $this->companyUserRepository->updateCompany($data);
    }

    public function get_company_with_branch_details($id)
    {
        return $this->companyUserRepository->getPrimaryBranchForCompany($id);
    }

    public function deleteCompanyUserByCompanyId($companyId)
    {
        return $this->companyUserRepository->where('company_id', $companyId)->delete();
    }
}
