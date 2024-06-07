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
}
