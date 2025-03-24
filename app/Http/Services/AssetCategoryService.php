<?php

namespace App\Http\Services;

use App\Repositories\AssetCategoryRepository;

class AssetCategoryService
{
  private $assetCategoryRepository;
  public function __construct(AssetCategoryRepository $assetCategoryRepository)
  {
    $this->assetCategoryRepository = $assetCategoryRepository;
  }
  public function all()
  {
    return $this->assetCategoryRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    $data['created_by'] = Auth()->user()->id;
    $data['company_id'] = Auth()->user()->company_id;
    return $this->assetCategoryRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->assetCategoryRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->assetCategoryRepository->find($id)->delete();
  }

  public function getAllActiveAssetCategory()
  {
    return $this->assetCategoryRepository->where('status', '1')->get();
  }
  public function getAllActiveAssetCategoryWithAsset()
  {
    return $this->assetCategoryRepository->with('assets')->where('status', '1')->get();
  }

  public function serachAssetCategoryFilterList($request)
  {
    $assetCategoryDetails = $this->assetCategoryRepository;
    /**List By Search or Filter */
    if (isset($request->search) && !empty($request->search)) {
      $assetManufacturerDetails = $assetCategoryDetails->where('name', 'Like', '%' . $request->search . '%');
    }
    /**List By Status or Filter */
    if (isset($request->status)) {
      $assetCategoryDetails = $assetCategoryDetails->where('status', $request->status);
    }
    return $assetCategoryDetails->orderBy('id', 'DESC')->paginate(10);
  }
}
