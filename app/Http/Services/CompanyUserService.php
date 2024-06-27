<?php

namespace App\Http\Services;
use App\Repositories\CompanyUserRepository;

class CompanyUserService 
{
  private $company_user_repository ;
  public function __construct(CompanyUserRepository $company_user_repository)
  {
    $this->company_user_repository = $company_user_repository;
  }

   
    public function all()
    { 
     return $this->company_user_repository->all();
    }
    public function create($data)
    { 
     return $this->company_user_repository->create($data);
    }
    public function updateOrCreate($match,$data)
    { 
     return $this->company_user_repository->updateOrCreate($match,$data);
    }
    public function updateDetails(array $data, $id)
    {
      return $this->company_user_repository->find($id)->update($data);
    }
    public function deleteDetails($id)
    {
      return $this->company_user_repository->find($id)->delete();
    }
    public function softDelete($id)
    {
      return $this->company_user_repository->where('branch_id',$id)->delete();
    }

    public function searchInCompany($searchKey)
    {
      $data['key']     =  array_key_exists('key', $searchKey) ? $searchKey['key'] : '';
      $data['status']  =  array_key_exists('status', $searchKey) ? $searchKey['status'] : '';
  
      return $this->company_user_repository->where(function($query) use ($data) {
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









    // old methods
    public function delete_company_by_id($id)
    {    
    return $this->company_user_repository->getCompanyById($id)->delete();
    }
    public function get_company_by_id($id)
    {    
      return $this->company_user_repository->getCompanyById($id)->first();
    }
    public function update_company($data)
    {    
    return $this->company_user_repository->updateCompany($data);
    }

    public function get_company_with_branch_details($id)
    {    
      return $this->company_user_repository->getPrimaryBranchForCompany($id);
    }

  
  }