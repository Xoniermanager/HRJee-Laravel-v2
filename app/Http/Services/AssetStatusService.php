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
    $data['created_by'] = Auth()->user()->id;
    $data['company_id'] = Auth()->user()->company_id;
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
  public function getAllActiveAssetStatus()
  {
    return $this->assetStatusRepository->where('status','1')->get();
  }

  public function serachAssetStatusFilterList($request)
  {
    $assetStatusDetails = $this->assetStatusRepository;
    /**List By Search or Filter */
    if (isset($request->search) && !empty($request->search)) {
      $assetStatusDetails = $assetStatusDetails->where('name', 'Like', '%' . $request->search . '%');
    }
    /**List By Status or Filter */
    if (isset($request->status)) {
      $assetStatusDetails = $assetStatusDetails->where('status', $request->status);
    }
    return $assetStatusDetails->orderBy('id', 'DESC')->paginate(10);
  }
}
