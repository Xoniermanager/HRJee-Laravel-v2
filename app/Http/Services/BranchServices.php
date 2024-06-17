<?php

namespace App\Http\Services;
use App\Repositories\BranchRepository;

class BranchServices 
{
  private $branch_repository ;
  public function __construct(BranchRepository $branch_repository)
  {
    $this->branch_repository = $branch_repository;
  }
    public function get_branches()
    { 
     return $this->branch_repository->all();
    }
    public function delete_branch_by_id($id)
    {    
    return $this->branch_repository->getbranchById($id)->delete();
    }
    public function get_branch_by_id($id)
    {    
    return $this->branch_repository->getbranchById($id)->get();
    }
    public function update_branch($data,$id)
    {
      return $this->branch_repository->updateBranch($data,$id);
    }
    

}