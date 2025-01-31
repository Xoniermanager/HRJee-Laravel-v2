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
  public function all()
  {
    return $this->newsCategoryRepository->where('company_id', Auth()->user()->company_id)->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    $data['company_id'] = Auth()->user()->company_id ?? '';
    return $this->newsCategoryRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->newsCategoryRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->newsCategoryRepository->find($id)->delete();
  }

  public function getAllActiveNewsCategory()
  {
    return $this->newsCategoryRepository->where('status', '1')->get();
  }

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
  public function getAllActiveNewsCategoryByCompanyID($companyId)
  {
    return $this->newsCategoryRepository->where('company_id', $companyId)->orwhere('company_id', '')->where('status', '1')->get();
  }
}
