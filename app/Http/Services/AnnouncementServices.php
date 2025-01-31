<?php

namespace App\Http\Services;

use App\Models\Announcement;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Repositories\AnnouncementRepository;
use Throwable;

class AnnouncementServices
{
  private $announcementRepository;
  private $companyBranchServices;
  private $departmentServices;
  private $designationServices;
  public function __construct(AnnouncementRepository $announcementRepository, BranchServices $companyBranchServices, DepartmentServices $departmentServices, DesignationServices $designationServices)
  {
    $this->announcementRepository = $announcementRepository;
    $this->companyBranchServices = $companyBranchServices;
    $this->departmentServices = $departmentServices;
    $this->designationServices = $designationServices;
  }
  public function all()
  {
    return $this->announcementRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    if (isset($data['image']) && !empty($data['image'])) {
      $nameForImage = removingSpaceMakingName($data['title']);
      $upload_path = "/announcement";
      if ($data['image']) {
        $filePath = uploadingImageorFile($data['image'], $upload_path, $nameForImage);
        $data['image'] = $filePath;
      }
    }
    $finalPayload = Arr::except($data, ['_token', 'department_id', 'designation_id', 'company_branch_id']);
    $finalPayload['company_id'] = Auth()->user()->company_id;
    $finalPayload['created_by'] = Auth()->user()->id;
    $announcementDetails = $this->announcementRepository->create($finalPayload);
    if ($announcementDetails) {
      $announcementModelDetails = Announcement::find($announcementDetails->id);
      if ($announcementDetails->all_company_branch == 0) {
        $announcementModelDetails->companyBranches()->sync($data['company_branch_id']);
      }
      if ($announcementDetails->all_department == 0) {
        $announcementModelDetails->departments()->sync($data['department_id']);
      }
      if ($announcementDetails->all_designation == 0) {
        $announcementModelDetails->designations()->sync($data['designation_id']);
      }
    }
    return true;
  }
  public function findById($id)
  {
    return $this->announcementRepository->find($id);
  }

  public function updateDetails(array $data, $id)
  {
    $editDetails = $this->announcementRepository->find($id);
    /** for file or file Upload */
    if (isset($data['image']) && !empty($data['image'])) {
      $nameForImage = removingSpaceMakingName($data['title']);
      $upload_path = "/announcement";
      if ($data['image']) {
        if ($editDetails->image != null) {
          unlinkFileOrImage($editDetails->image);
        }
        $filePath = uploadingImageorFile($data['image'], $upload_path, $nameForImage);
        $data['image'] = $filePath;
      }
    }
    $finalPayload = Arr::except($data, ['_token', 'department_id', 'designation_id', 'company_branch_id']);
    $announceUpdateDetails = $editDetails->update($finalPayload);
    if ($announceUpdateDetails) {
      $announcementDetails = Announcement::find($id);
      if ($editDetails->all_company_branch == 0) {
        $announcementDetails->companyBranches()->sync($data['company_branch_id']);
      }
      if ($editDetails->all_department == 0) {
        $announcementDetails->departments()->sync($data['department_id']);
      }
      if ($editDetails->all_designation == 0) {
        $announcementDetails->designations()->sync($data['designation_id']);
      }
      if ($editDetails->all_company_branch == 1) {
        $announcementDetails->companyBranches()->detach();
      }
      if ($editDetails->all_department == 1) {
        $announcementDetails->departments()->detach();
      }
      if ($editDetails->all_designation == 1) {
        $announcementDetails->designations()->detach();
      }
    }
    return true;
  }
  public function deleteDetails($id)
  {
    $deletedData = Announcement::find($id);
    if ($deletedData->image != null) {
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
    return $this->announcementRepository->find($id)->update(['status' => $statusValue]);
  }
  public function serachAnnouncementFilterList($request)
  {
    $announcementDetails = $this->announcementRepository;
    /**List By Search or Filter */
    if (isset($request->search) && !empty($request->search)) {
      $announcementDetails = $announcementDetails->where('title', 'Like', '%' . $request->search . '%');
    }
    /**List By Status or Filter */
    if (isset($request->status)) {
      $announcementDetails = $announcementDetails->where('status', $request->status);
    }
    /**List By Company Branch or Filter */
    if (isset($request->company_branch_id)) {
      $companyID = $request->company_branch_id;
      $announcementDetails = Announcement::wherehas(
        'companyBranches',
        function ($query) use ($companyID) {
          $query->where('company_branch_id', $companyID);
        }
      );
    }
    /**List By Department or Filter */
    if (isset($request->department_id)) {
      $departmentId = $request->department_id;
      $announcementDetails = Announcement::wherehas(
        'departments',
        function ($query) use ($departmentId) {
          $query->where('department_id', $departmentId);
        }
      );
    }
    return $announcementDetails->orderBy('id', 'DESC')->paginate(10);
  }
  public function getAllAssignedAnnouncementForEmployee()
  {
    $userDetails = Auth()->user() ?? auth()->guard('employee_api')->user();
    $allAnnouncementDetails = $this->announcementRepository->where('company_id', $userDetails->company_id)->where('status', 1)->where('start_date_time', '<=', date('Y-m-d'))
      ->where('expires_at_time', '>=', date('Y-m-d'))->get();
    $allAssignedAnnouncement = [];
    foreach ($allAnnouncementDetails as $announcementsDetails) {
      $assignedCompanyBranchesIds = $this->companyBranchServices->getAllAssignedCompanyBranches($announcementsDetails);
      $assignedDepartmentIds = $this->departmentServices->getAllAssignedDepartment($announcementsDetails);
      $assignedDesignationIds = $this->designationServices->getAllAssignedDesignation($announcementsDetails);

      if (in_array($userDetails->company_branch_id, $assignedCompanyBranchesIds) && in_array($userDetails->department_id, $assignedDepartmentIds) && in_array($userDetails->designation_id, $assignedDesignationIds)) {
        $allAssignedAnnouncement[] = $announcementsDetails;
      }
    }
    return $allAssignedAnnouncement;
  }
}
