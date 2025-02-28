<?php

namespace App\Http\Services;

use Throwable;
use App\Models\News;
use Illuminate\Support\Arr;
use App\Repositories\NewsRepository;
use Illuminate\Support\Facades\Auth;

class NewsService
{
  private $newsRepository;
  private $companyBranchServices;
  private $departmentServices;
  private $designationServices;
  public function __construct(DesignationServices $designationServices, DepartmentServices $departmentServices, NewsRepository $newsRepository, BranchServices $companyBranchServices)
  {
    $this->newsRepository = $newsRepository;
    $this->companyBranchServices = $companyBranchServices;
    $this->departmentServices = $departmentServices;
    $this->designationServices = $designationServices;
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function all()
  {
    return $this->newsRepository->orderBy('id', 'DESC')->paginate(10);
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @return void
   */
  public function create(array $data)
  {
    /** for file or file Upload */
    $nameForImage = removingSpaceMakingName($data['title']);
    if ((isset($data['file']) && !empty($data['file'])) || (isset($data['image']) && !empty($data['image']))) {
      $upload_path = "/news";
      if ($data['image']) {
        $filePath = uploadingImageorFile($data['image'], $upload_path, $nameForImage);
        $data['image'] = $filePath;
      }
      if (isset($data['file'])) {
        $filePath = uploadingImageorFile($data['file'], $upload_path, $nameForImage);
        $data['file'] = $filePath;
      }
    }
    $finalPayload = Arr::except($data, ['_token', 'department_id', 'designation_id', 'company_branch_id']);
    $finalPayload['company_id'] = Auth()->user()->company_id;
    $finalPayload['created_by'] = Auth()->user()->id;
    $newsCreatedDetails = $this->newsRepository->create($finalPayload);
    if ($newsCreatedDetails) {
      $newsDetails = News::find($newsCreatedDetails->id);
      if ($newsCreatedDetails->all_company_branch == 0) {
        $newsDetails->companyBranches()->sync($data['company_branch_id']);
      }
      if ($newsCreatedDetails->all_department == 0) {
        $newsDetails->departments()->sync($data['department_id']);
      }
      if ($newsCreatedDetails->all_designation == 0) {
        $newsDetails->designations()->sync($data['designation_id']);
      }
    }
    return true;
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function findByNewsId($id)
  {
    return $this->newsRepository->find($id);
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @param [type] $id
   * @return void
   */
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
        $filePath = uploadingImageorFile($data['image'], $upload_path, $nameForImage);
        $data['image'] = $filePath;
      }
      if (isset($data['file'])) {
        if ($editDetails->file != null) {
          unlinkFileOrImage($editDetails->file);
        }
        $filePath = uploadingImageorFile($data['file'], $upload_path, $nameForImage);
        $data['file'] = $filePath;
      }
    }
    $finalPayload = Arr::except($data, ['_token', 'department_id', 'designation_id', 'company_branch_id']);
    $newsUodatesDetails = $editDetails->update($finalPayload);
    if ($newsUodatesDetails) {
      $newsDetails = News::find($id);
      if ($editDetails->all_company_branch == 0) {
        $newsDetails->companyBranches()->sync($data['company_branch_id']);
      }
      if ($editDetails->all_department == 0) {
        $newsDetails->departments()->sync($data['department_id']);
      }
      if ($editDetails->all_designation == 0) {
        $newsDetails->designations()->sync($data['designation_id']);
      }
      if ($editDetails->all_company_branch == 1) {
        $newsDetails->companyBranches()->detach();
      }
      if ($editDetails->all_department == 1) {
        $newsDetails->departments()->detach();
      }
      if ($editDetails->all_designation == 1) {
        $newsDetails->designations()->detach();
      }
    }
    return true;
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
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

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @param [type] $statusValue
   * @return void
   */
  public function updateStatus($id, $statusValue)
  {
    return $this->newsRepository->find($id)->update(['status' => $statusValue]);
  }

  /**
   * Undocumented function
   *
   * @param [type] $request
   * @return void
   */
  public function serachNewsFilterList($request)
  {
    $newsDetails = $this->newsRepository;
    /**List By Search or Filter */
    if (isset($request->search) && !empty($request->search)) {
      $newsDetails = $newsDetails->where('title', 'Like', '%' . $request->search . '%');
    }
    /**List By Status or Filter */
    if (isset($request->status)) {
      $newsDetails = $newsDetails->where('status', $request->status);
    }
    /**List By News Category or Filter */
    if (isset($request->news_category_id)) {
      $newsDetails = $newsDetails->where('news_category_id', $request->news_category_id);
    }
    /**List By Company Branch or Filter */
    if (isset($request->company_branch_id)) {
      $companyID = $request->company_branch_id;
      $newsDetails = News::wherehas(
        'companyBranches',
        function ($query) use ($companyID) {
          $query->where('company_branch_id', $companyID);
        }
      );
    }
    /**List By Department or Filter */
    if (isset($request->department_id)) {
      $departmentId = $request->department_id;
      $newsDetails = News::wherehas(
        'departments',
        function ($query) use ($departmentId) {
          $query->where('department_id', $departmentId);
        }
      );
    }
    return $newsDetails->orderBy('id', 'DESC')->paginate(10);
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function getAllAssignedNewsForEmployee()
  {
    $user = Auth()->user() ?? auth()->guard('employee_api')->user();
    $allNewsDetails = $this->newsRepository->where('company_id', $user->company_id)->where('status', 1)->where('start_date', '<=', date('Y-m-d'))
      ->where('end_date', '>=', date('Y-m-d'))->get();
    $allAssignedNews = [];
    foreach ($allNewsDetails as $newsDetails) {
      $assignedCompanyBranchesIds = $this->companyBranchServices->getAllAssignedCompanyBranches($newsDetails);
      $assignedDepartmentIds = $this->departmentServices->getAllAssignedDepartment($newsDetails);
      $assignedDesignationIds = $this->designationServices->getAllAssignedDesignation($newsDetails);
      if (in_array($user->details->company_branch_id, $assignedCompanyBranchesIds) && in_array($user->details->department_id, $assignedDepartmentIds) && in_array($user->details->designation_id, $assignedDesignationIds)) {
        $allAssignedNews[] = $newsDetails;
      }
    }
    return $allAssignedNews;
  }
}
