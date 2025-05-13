<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\NewsCategoryRepository;

class NewsCategoryService
{
  private $newsCategoryRepository;
  public function __construct(NewsCategoryRepository $newsCategoryRepository)
  {
    $this->newsCategoryRepository = $newsCategoryRepository;
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function all()
  {
    return $this->newsCategoryRepository->where('company_id', Auth()->user()->company_id)->orderBy('id', 'DESC')->paginate(10);
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
    $data['created_by'] = Auth()->user()->id ?? '';
    return $this->newsCategoryRepository->create($data);
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
    return $this->newsCategoryRepository->find($id)->update($data);
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function deleteDetails($id)
  {
    return $this->newsCategoryRepository->find($id)->delete();
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function getAllActiveNewsCategory()
  {
    return $this->newsCategoryRepository->where('status', '1')->get();
  }

  /**
   * Undocumented function
   *
   * @param [type] $request
   * @return void
   */
  public function serachNewsCategoryFilterList($request)
  {
    $assetCategoryDetails = $this->newsCategoryRepository;
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
  public function getAllActiveNewsCategoryByCompanyID($companyId)
  {
    return $this->newsCategoryRepository->where('company_id', $companyId)->orwhere('company_id', '')->where('status', '1')->get();
  }
}
