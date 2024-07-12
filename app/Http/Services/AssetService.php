<?php

namespace App\Http\Services;

use App\Models\AssetStatus;
use Illuminate\Support\Facades\Auth;
use App\Repositories\AssetRepository;

class AssetService
{
  private $assetRepository;
  public function __construct(AssetRepository $assetRepository)
  {
    $this->assetRepository = $assetRepository;
  }
  public function all($type = '')
  {
    $query = $this->assetRepository->orderBy('id', 'DESC');
    if ($type == 'all') {
      $query = $query->get();
    } else {
      $query =   $query->paginate(10);
    }
    return $query;
  }
  public function allAssetWithUser()
  {

    return  $this->assetRepository->with('userAsset.user')->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    if (isset($data['invoice_file']) && !empty($data['invoice_file'])) {
      $nameForImage = removingSpaceMakingName($data['name']);
      $upload_path = "/asset_file";
      $filePath = uploadingImageorFile($data['invoice_file'], $upload_path, $nameForImage);
      $data['invoice_file'] = $filePath;
    }
    $data['asset_status_id'] = AssetStatus::CREATED;
    $data['company_id'] = Auth::guard('admin')->user()->company_id;
    return $this->assetRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    $existingDetails = $this->assetRepository->find($id);
    if (isset($data['invoice_file']) && !empty($data['invoice_file'])) {
      $nameForImage = removingSpaceMakingName($data['name']);
      $upload_path = "/asset_file";
      $filePath = uploadingImageorFile($data['invoice_file'], $upload_path, $nameForImage);
      $data['invoice_file'] = $filePath;
      if ($existingDetails->invoice_file != null) {
        unlinkFileOrImage($existingDetails->invoice_file);
      }
    }
    $data['asset_status_id'] = AssetStatus::UPDATED;
    return $existingDetails->update($data);
  }
  public function deleteDetails($id)
  {
    $existingDetails =  $this->assetRepository->find($id);
    if ($existingDetails->invoice_file != null) {
      unlinkFileOrImage($existingDetails->invoice_file);
    }
    return $existingDetails->delete();
  }
  public function findDetailsById($id)
  {
    return $this->assetRepository->find($id);
  }

  public function serachAssetFilterList($request)
  {
    $assetDetails = $this->assetRepository;

    /**List By Search or Filter */
    if (isset($request->search) && !empty($request->search)) {
      $searchKey = $request->search;
      $assetDetails = $assetDetails->where(function ($query) use ($searchKey) {
        $query->where('name', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('model', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('purchase_value', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('depreciation_per_year', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('invoice_no', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('serial_no', 'LIKE', '%' . $searchKey . '%');
      });
    }
    /**List By Category or Filter */
    if (isset($request->status) && !empty($request->status)) {
      $assetDetails = $assetDetails->where('allocation_status', $request->status);
    }
    /**List By Category or Filter */
    if (isset($request->category_id) && !empty($request->category_id)) {
      $assetDetails = $assetDetails->where('asset_category_id', $request->category_id);
    }
    /**List By Manufacturer or Filter */
    if (isset($request->manufacturer_id) && !empty($request->manufacturer_id)) {
      $assetDetails = $assetDetails->where('asset_manufacturer_id', $request->manufacturer_id);
    }
    /**List By Manufacturer or Filter */
    if (isset($request->ownership) && !empty($request->ownership)) {
      $assetDetails = $assetDetails->where('ownership', $request->ownership);
    }
    return $assetDetails->orderBy('id', 'DESC')->paginate(10);
  }

  public function getAllAssetByCategoryId($id)
  {
    return $this->assetRepository->where('asset_category_id', $id)->where('allocation_status', 'available')->get();
  }
}
