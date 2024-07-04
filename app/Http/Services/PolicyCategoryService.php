<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\PolicyCategoryRepository;

class PolicyCategoryService
{
  private $policyCategoryRepository;
  public function __construct(PolicyCategoryRepository $policyCategoryRepository)
  {
    $this->policyCategoryRepository = $policyCategoryRepository;
  }
  public function all()
  {
    return $this->policyCategoryRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    $data['company_id'] = Auth::guard('admin')->user()->company_id ?? '';
    return $this->policyCategoryRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->policyCategoryRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->policyCategoryRepository->find($id)->delete();
  }

  public function getAllActivePolicyCategory()
  {
    return $this->policyCategoryRepository->where('status', '1')->get();
  }

  public function serachPolicyCategoryFilterList($request)
  {
    $assetCategoryDetails = $this->policyCategoryRepository;
    /**List By Search or Filter */
    if (isset($request->search) && !empty($request->search)) {
      $assetCategoryDetails = $assetCategoryDetails->where('name', 'Like', '%' . $request->search . '%');
    }
    /**List By Status or Filter */
    if (isset($request->status)) {
      $assetCategoryDetails = $assetCategoryDetails->where('status', $request->status);
    }
    return $assetCategoryDetails->orderBy('id', 'DESC')->paginate(10);
  }
  public function getAllActivePolicyCategoryUsingByCompanyID($companyId)
  {
    return $this->policyCategoryRepository->where('company_id', $companyId)->orwhere('company_id', '')->where('status', '1')->get();
  }
}
