<?php

namespace App\Http\Services;

use App\Models\News;
use Illuminate\Support\Arr;
use App\Repositories\NewsRepository;
use Illuminate\Support\Facades\Auth;

class NewsService
{
  private $newsRepository;
  private $imageUploadService;
  public function __construct(NewsRepository $newsRepository, FileUploadService $imageUploadService)
  {
    $this->newsRepository = $newsRepository;
    $this->imageUploadService = $imageUploadService;
  }
  public function all()
  {
    return $this->newsRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    /** for file or file Upload */
    $nameForImage = removingSpaceMakingName($data['title']);
    if ((isset($data['file']) && !empty($data['file'])) || (isset($data['image']) && !empty($data['image']))) {
      $upload_path = "/news";
      if ($data['image']) {
        $imagePath = $this->imageUploadService->imageUpload($data['image'], $upload_path, $nameForImage);
        $data['image'] = $imagePath;
      }
      if (isset($data['file'])) {
        $imagePath = $this->imageUploadService->imageUpload($data['file'], $upload_path, $nameForImage);
        $data['file'] = $imagePath;
      }
    }
    $finalPayload = Arr::except($data, ['_token', 'department_id', 'designation_id', 'company_branch_id']);
    $newsCreatedDetails =  $this->newsRepository->create($finalPayload);

    if ($newsCreatedDetails) {
      $newsDetails = News::find($newsCreatedDetails->id);
      $newsDetails->companyBranches()->sync($data['company_branch_id']);
      $newsDetails->departments()->sync($data['department_id']);
      $newsDetails->designations()->sync($data['designation_id']);
    }
    return true;
  }

  public function findByNewsId($id)
  {
    return $this->newsRepository->find($id);
  }

  public function updateDetails(array $data, $id)
  {
    $editDetails = $this->newsRepository->find($id);
    /** for file or file Upload */
    $nameForImage = removingSpaceMakingName($data['title']);
    if ((isset($data['file']) && !empty($data['file'])) || (isset($data['image']) && !empty($data['image']))) {
      $upload_path = "/news";
      if ($data['image']) {
        if ($editDetails->image != null) {
          unlinkFileOrImage($editDetails->image);
        }
        $imagePath = $this->imageUploadService->imageUpload($data['image'], $upload_path, $nameForImage);
        $data['image'] = $imagePath;
      }
      if (isset($data['file'])) {
        if ($editDetails->file != null) {
          unlinkFileOrImage($editDetails->file);
        }
        $imagePath = $this->imageUploadService->imageUpload($data['file'], $upload_path, $nameForImage);
        $data['file'] = $imagePath;
      }
    }
    $finalPayload = Arr::except($data, ['_token', 'department_id', 'designation_id', 'company_branch_id']);
    $newsUodatesDetails = $editDetails->update($finalPayload);
    if ($newsUodatesDetails) {
      $newsDetails = News::find($id);
      $newsDetails->companyBranches()->sync($data['company_branch_id']);
      $newsDetails->departments()->sync($data['department_id']);
      $newsDetails->designations()->sync($data['designation_id']);
    }
    return true;
  }
  public function deleteDetails($id)
  {
    $deletedData = News::find($id);
    if ($deletedData->image != null || $deletedData->file != null) {
      if (isset($deletedData->file)) {
        unlinkFileOrImage($deletedData->file);
      }
      if (isset($deletedData->image)) {
        unlinkFileOrImage($deletedData->image);
      }
    }
    $deletedData->companyBranches()->detach();
    $deletedData->departments()->detach();
    $deletedData->designations()->detach();
    $deletedData->delete();
    return true;
  }
  public function updateStatus($id, $statusValue)
  {
    return $this->newsRepository->find($id)->update(['status' => $statusValue]);
  }

  public function getAllActiveNewsCategory()
  {
    return $this->newsRepository->where('status', '1')->get();
  }

  public function serachNewsCategoryFilterList($request)
  {
    $assetCategoryDetails = $this->newsRepository;
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
}
