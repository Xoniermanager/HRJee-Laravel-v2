<?php

namespace App\Http\Services;

use App\Models\AssetStatus;
use Illuminate\Support\Facades\Auth;
use App\Repositories\AssetRepository;

class AssetService
{
  private $assetRepository;
  private $fileUploadService;

  public function __construct(AssetRepository $assetRepository, FileUploadService $fileUploadService)
  {
    $this->assetRepository = $assetRepository;
    $this->fileUploadService = $fileUploadService;
  }
  public function all()
  {
    return $this->assetRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    if (isset($data['invoice_file']) && !empty($data['invoice_file'])) {
      $nameForImage = removingSpaceMakingName($data['name']);
      $upload_path = "/asset_file";
      $imagePath = $this->fileUploadService->imageUpload($data['invoice_file'], $upload_path, $nameForImage);
      $data['invoice_file'] = $imagePath;
    }
    $data['asset_status_id'] = AssetStatus::CREATED;
    $data['company_id'] = Auth::guard('admin')->user()->id;
    return $this->assetRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    $existingDetails = $this->assetRepository->find($id);
    if (isset($data['invoice_file']) && !empty($data['invoice_file'])) {
      $nameForImage = removingSpaceMakingName($data['name']);
      $upload_path = "/asset_file";
      $imagePath = $this->fileUploadService->imageUpload($data['invoice_file'], $upload_path, $nameForImage);
      $data['invoice_file'] = $imagePath;
      if ($existingDetails->invoice_file != null) {
        if (file_exists(storage_path('app/public') . $existingDetails->invoice_file)) {
          unlink(storage_path('app/public') . $existingDetails->invoice_file);
        }
      }
    }
    $data['asset_status_id'] = AssetStatus::UPDATED;
    return $existingDetails->update($data);
  }
  public function deleteDetails($id)
  {
    $existingDetails =  $this->assetRepository->find($id);
    if ($existingDetails->invoice_file != null) {
      if (file_exists(storage_path('app/public') . $existingDetails->invoice_file)) {
        unlink(storage_path('app/public') . $existingDetails->invoice_file);
      }
    }
    return $existingDetails->delete();
  }
  public function findDetailsById($id)
  {
    return $this->assetRepository->find($id);
  }
}
