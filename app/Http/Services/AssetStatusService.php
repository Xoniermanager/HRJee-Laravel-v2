<?php

namespace App\Http\Services;

use App\Repositories\AssetStatusRepository;

class AssetStatusService
{
  private $assetStatusRepository;
  public function __construct(AssetStatusRepository $assetStatusRepository)
  {
    $this->assetStatusRepository = $assetStatusRepository;
  }
  public function all()
  {
    return $this->assetStatusRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    return $this->assetStatusRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->assetStatusRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->assetStatusRepository->find($id)->delete();
  }
}
