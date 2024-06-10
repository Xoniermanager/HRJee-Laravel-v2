<?php

namespace App\Http\Services;

use App\Repositories\AssetManufacturerRepository;

class AssetManufacturerService
{
  private $assetManufacturerRepository;
  public function __construct(AssetManufacturerRepository $assetManufacturerRepository)
  {
    $this->assetManufacturerRepository = $assetManufacturerRepository;
  }
  public function all()
  {
    return $this->assetManufacturerRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    return $this->assetManufacturerRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->assetManufacturerRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->assetManufacturerRepository->find($id)->delete();
  }
  public function getAllActiveAssetManufacturer()
  {
    return $this->assetManufacturerRepository->where('status', '1')->get();
  }
}
