<?php

namespace App\Http\Services;

use App\Models\companyMenuPermission;

class CompanyFeatureService
{
  private $menuPermissionRepository;
  public function __construct(companyMenuPermission $menuPermissionRepository)
  {
    $this->menuPermissionRepository = $menuPermissionRepository;
  }
  
  public function create($data)
  {
    return $this->menuPermissionRepository->insert($data);
  }
  public function deleteDetails($id)
  {
    return $this->menuPermissionRepository->where('company_id', $id)->delete();
  }
  public function getPermissionByCompanyId($id)
  {
    return $this->menuPermissionRepository->where('company_id', $id)->get();
  }

}
