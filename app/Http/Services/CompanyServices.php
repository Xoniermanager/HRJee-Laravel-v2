<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\CompanyRepository;
use Illuminate\Support\Facades\Session;
use App\Repositories\CompanyUserRepository;

class CompanyServices
{
    private $companyRepository;
    private $companyUserRepository;
    public function __construct(CompanyRepository $companyRepository, CompanyUserRepository $companyUserRepository)
    {
        $this->companyRepository = $companyRepository;
        $this->companyUserRepository = $companyUserRepository;
    }
    public function all()
    {
        return $this->companyRepository->with('menu')->paginate(10);
    }
    public function allCompanyDetails()
    {
        return $this->companyRepository->all();
    }
    public function create($data)
    {
        return $this->companyRepository->create($data);
    }

    public function updateDetails(array $data, $id)
    {
        return $this->companyRepository->find($id)->update($data);
    }
    public function deleteDetails($id)
    {
        return $this->companyRepository->find($id)->delete();
    }

    public function searchInCompany($searchKey)
    {
        return $this->companyRepository->where(function ($query) use ($searchKey) {
            if (!empty($searchKey['key'])) {
                $query->where('name', 'like', "%{$searchKey['key']}%")
                    ->orWhere('username', 'like', "%{$searchKey['key']}%")
                    ->orWhere('email', 'like', "%{$searchKey['key']}%")
                    ->orWhere('contact_no', 'like', "%{$searchKey['key']}%")
                    ->orWhere('company_address', 'like', "%{$searchKey['key']}%");
            }
            if (isset($searchKey['status'])) {
                $query->where('status', $searchKey['status']);
            }
            if (isset($searchKey['deletedAt'])) {
                $query->where('deleted_at', $searchKey['deletedAt']);
            }
            if (isset($searchKey['companyTypeId'])) {
                $query->where('company_type_id', $searchKey['companyTypeId']);
            }
        })->paginate(10);
    }
    public function delete_company_by_id($id)
    {
        return $this->companyRepository->getCompanyById($id)->delete();
    }
    public function get_company_by_id($id)
    {
        return $this->companyRepository->getCompanyById($id)->first();
    }
    public function update_company($data)
    {
        return $this->companyRepository->updateCompany($data);
    }

    public function get_company_with_branch_details($id)
    {
        return $this->companyRepository->getPrimaryBranchForCompany($id);
    }

    public function searchCompanyMenu($searchKey)
    {
        return $this->companyRepository->where(function ($query) use ($searchKey) {
            if (!empty($searchKey)) {
                $query->where('name', 'like', "%{$searchKey}%")
                    ->orWhereHas('menu', function ($menuQuery) use ($searchKey) {
                        $menuQuery->where('title', 'like', "%{$searchKey}%");
                    });
            }
        })->with('menu')->paginate(10);
    }

    public function updateStatus($companyId, $statusValue)
    {
        $companyStatusUpdate =  $this->companyRepository->find($companyId)->update(['status' => $statusValue]);
        if ($companyStatusUpdate) {
            $this->companyUserRepository->where('company_id', $companyId)->update(['status' => $statusValue]);
        }
        return $companyStatusUpdate;
    }
}
