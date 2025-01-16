<?php

namespace App\Http\Services;

use App\Repositories\CompanyRepository;
use Illuminate\Support\Arr;

class CompanyServices
{
    private $company_repository;
    public function __construct(CompanyRepository $company_repository)
    {
        $this->company_repository = $company_repository;
    }
    public function all()
    {
        return $this->company_repository->with('menu')->paginate(10);
    }
    public function allCompanyDetails()
    {
        return $this->company_repository->all();
    }
    public function create($data)
    {

        return $this->company_repository->create($data);
    }

    public function updateDetails(array $data, $id)
    {
        return $this->company_repository->find($id)->update($data);
    }
    public function deleteDetails($id)
    {
        return $this->company_repository->find($id)->delete();
    }

    public function searchInCompany($searchKey)
    {
        $data['key']     =  array_key_exists('key', $searchKey) ? $searchKey['key'] : '';
        $data['status']  =  array_key_exists('status', $searchKey) ? $searchKey['status'] : '';

        return $this->company_repository->where(function ($query) use ($data) {
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
        return $this->company_repository->getCompanyById($id)->delete();
    }
    public function get_company_by_id($id)
    {
        return $this->company_repository->getCompanyById($id)->first();
    }
    public function update_company($data)
    {
        return $this->company_repository->updateCompany($data);
    }

    public function get_company_with_branch_details($id)
    {
        return $this->company_repository->getPrimaryBranchForCompany($id);
    }

    public function searchCompanyMenu($searchKey)
    {
        return $this->company_repository->where(function ($query) use ($searchKey) {
            if (!empty($searchKey)) {
                $query->where('name', 'like', "%{$searchKey}%")
                    ->orWhereHas('menu', function ($menuQuery) use ($searchKey) {
                        $menuQuery->where('title', 'like', "%{$searchKey}%");
                    });
            }
        })->with('menu')->paginate(10);
    }
}
