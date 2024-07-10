<?php

namespace App\Http\Services;

use App\Models\News;
use App\Models\UserDetail;
use Illuminate\Support\Arr;
use App\Repositories\NewsRepository;
use Illuminate\Support\Facades\Auth;
use Throwable;

class NewsService
{
  private $newsRepository;
  private $branchServices;
  private $userDetailServices;
  private $departmentServices;
  private $designationServices;
  public function __construct(DesignationServices $designationServices, DepartmentServices $departmentServices, UserDetailServices $userDetailServices, NewsRepository $newsRepository, BranchServices $branchServices)
  {
    $this->newsRepository = $newsRepository;
    $this->branchServices = $branchServices;
    $this->userDetailServices = $userDetailServices;
    $this->departmentServices = $departmentServices;
    $this->designationServices = $designationServices;
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
        $filePath = uploadingImageorFile($data['image'], $upload_path, $nameForImage);
        $data['image'] = $filePath;
      }
      if (isset($data['file'])) {
        $filePath = uploadingImageorFile($data['file'], $upload_path, $nameForImage);
        $data['file'] = $filePath;
      }
    }
    $finalPayload = Arr::except($data, ['_token', 'department_id', 'designation_id', 'company_branch_id']);
    $finalPayload['company_id'] = Auth::guard('admin')->user()->company_id;
    // $finalPayload['company_branch_id'] = Auth::guard('admin')->user()->branch_id ?? 'NULL';
    $newsCreatedDetails =  $this->newsRepository->create($finalPayload);
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


  public function getAllAssignedNews($request)
  {
    try {

      $user = auth()->guard('employee_api')->user();
      $newsIds = [];
      $news = $this->newsRepository->with('newsCategories:id,name')->where('company_id', $user->company_id)->get();
      // ->select('id','title','image','start_date','end_date','file','description','news_category_id')
      $departments = $this->departmentServices->getAllActiveDepartmentsUsingByCompanyID($user->company_id);
      $userDetails = $this->userDetailServices->getDetailsByUserId($user->id);

      foreach ($news as $row) {
        // check for branch 
        if ($row->all_company_branch == 1) {
          $branches = $this->branchServices->allActiveCompanyBranchesByUsingCompanyId($row->company_id);
          $branchIds = $branches->pluck('id')->toArray();
        } else if ($row->all_company_branch == 0) {
          $branchIds = $row->companyBranches()->pluck('company_branch_id')->toArray();
        }

        // check for department 
        if ($row->all_department == 1) {
          $departmentIds = $departments->pluck('id')->toArray();
        } else if ($row->all_department == 0) {
          $departmentIds = $row->departments()->pluck('department_id')->toArray();
        }


        // check for designation 
        if ($row->all_designation == 1) {
          $designationIds = $this->designationServices->getAllDesignationUsingDepartmentID($departmentIds)->pluck('id')->toArray();
        } else if ($row->all_designation == 0) {
          $designationIds = $row->designations()->pluck('designation_id')->toArray();
        }

        // check user is exists or not in assigned branches & departments & designations 
        if (in_array($userDetails->company_branch_id, $branchIds) && in_array($userDetails->department_id, $departmentIds) &&  in_array($userDetails->designation_id, $designationIds)) {
          array_push($newsIds, $row->id);
        }
      }

      $finalNews = $news->whereIn('id', $newsIds)->makeHidden([
        "all_company_branch",
        "all_department",
        "all_designation",
        "company_id",
        "company_branch_id",
        "created_at",
        "news_category_id",
        "updated_at"
      ]);;
      return $finalNews;
    } catch (Throwable $th) {
      return errorMessage('null', $th->getMessage());
    }
  }
}
