<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\PRMCategoryRepository;

class PRMCategoryService
{
  private $prmCategoryRepository;
  public function __construct(PRMCategoryRepository $prmCategoryRepository)
  {
    $this->prmCategoryRepository = $prmCategoryRepository;
  }

  public function all()
  {
    return $this->prmCategoryRepository->where('company_id', Auth()->user()->company_id)->orderBy('id', 'DESC')->paginate(10);
  }

  public function create(array $data)
  {
    $data['company_id'] = Auth()->user()->company_id ?? '';
    return $this->prmCategoryRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->prmCategoryRepository->find($id)->update($data);
  }

  public function deleteDetails($id)
  {
    return $this->prmCategoryRepository->find($id)->delete();
  }

  public function searchPRMCategoryFilterList($request)
  {
    $assetCategoryDetails = $this->prmCategoryRepository;
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

  public function getAllActiveCategoryByCompanyID($companyId)
  {
    return $this->prmCategoryRepository->whereIn('company_id', $companyId)->orwhere('company_id', '')->where('status', '1')->get();
  }


}
