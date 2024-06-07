<?php

namespace App\Http\Services;
use App\Repositories\BranchRepository;

class BranchServices 
{
  private $branchRepository ;
  public function __construct(BranchRepository $branchRepository)
  {
    $this->branchRepository = $branchRepository;
  }
    public function get_branches()
    { 
     return $this->branchRepository->orderBy('id','DESC')->paginate(10);
    }
    public function create($data)
    {
      return $this->branchRepository->create($data);
    }
    public function deleteDetails($id)
    {    
      return $this->branchRepository->find($id)->delete();
    }
    public function get_branch_by_id($id)
    {    
    return $this->branchRepository->getbranchById($id)->get();
    }
    public function updateDetails($data,$id)
    {
      return $this->branchRepository->find($id)->update($data);
    }
    public function searchInCompanyBranch($searchKey)
    {
      $data['key']     =  array_key_exists('key', $searchKey) ? $searchKey['key'] : '';
      $data['status']  =  array_key_exists('status', $searchKey) ? $searchKey['status'] : '';
  
      return $this->branchRepository->where(function($query) use ($data) {
        if (!empty($data['key'])) {
            $query->where('name', 'like', "%{$data['key']}%")
             ->orWhere('email', 'like', "%{$data['key']}%")
             ->orWhere('contact_no', 'like', "%{$data['key']}%")
             ->orWhere('address', 'like', "%{$data['key']}%");
        }
  
        if (isset($data['status'])) {
            $query->where('status', $data['status']);
        }
      })->get();
    }
    

}

