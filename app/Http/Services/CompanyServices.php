<?php

namespace App\Http\Services;
use App\Repositories\CompanyRepository;

class CompanyServices 
{
  private $company_repository ;
  public function __construct(CompanyRepository $company_repository)
  {
    $this->company_repository = $company_repository;
  }
    public function get_companies()
    { 
     return $this->company_repository->all();
    }
    public function delete_company_by_id($id)
    {    
    return $this->company_repository->getCompanyById($id)->delete();
    }
    public function get_company_by_id($id)
    {    
      return $this->company_repository->getCompanyById($id)->get();
    }
    public function update_company($data)
    {    
    return $this->company_repository->updateCompany($data);
    }

    public function get_company_with_branch_details($id)
    {    
      return $this->company_repository->getPrimaryBranchForCompany($id);
    }

  
  }