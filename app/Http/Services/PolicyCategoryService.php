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

  /**
   * Undocumented function
   *
   * @return void
   */
  public function all()
  {
    return $this->policyCategoryRepository->where('company_id', Auth()->user()->company_id)->orderBy('id', 'DESC')->paginate(10);
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @return void
   */
  public function create(array $data)
  {
    $data['company_id'] = Auth()->user()->company_id ?? '';
    return $this->policyCategoryRepository->create($data);
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @param [type] $id
   * @return void
   */
  public function updateDetails(array $data, $id)
  {
    return $this->policyCategoryRepository->find($id)->update($data);
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function deleteDetails($id)
  {
    return $this->policyCategoryRepository->find($id)->delete();
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function getAllActivePolicyCategory()
  {
    return $this->policyCategoryRepository->where('status', '1')->get();
  }

  /**
   * Undocumented function
   *
   * @param [type] $request
   * @return void
   */
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

  /**
   * Undocumented function
   *
   * @param [type] $companyId
   * @return void
   */
  public function getAllActivePolicyCategoryUsingByCompanyID($companyId)
  {
    return $this->policyCategoryRepository->where('company_id', $companyId)->orwhere('company_id', '')->where('status', '1')->get();
  }
}
