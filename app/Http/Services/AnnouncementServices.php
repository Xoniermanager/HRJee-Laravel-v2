<?php

namespace App\Http\Services;

use App\Repositories\AnnouncementRepository;
use Throwable;

class AnnouncementServices
{
  private $announcementRepository;
  private $userDetailServices;
  private $departmentServices;
  private $designationServices;
  private $branchServices;
  public function __construct(DesignationServices $designationServices,BranchServices $branchServices,UserDetailServices $userDetailServices, DepartmentServices $departmentServices, AnnouncementRepository $announcementRepository)
  {
    $this->announcementRepository = $announcementRepository;
    $this->departmentServices = $departmentServices;
    $this->userDetailServices = $userDetailServices;
    $this->branchServices = $branchServices;
    $this->designationServices = $designationServices;
  }
  public function all($type = '')
  {

    if ($type == 'paginate')
      return $this->announcementRepository->orderBy('id', 'DESC')->paginate(10);
    else
      return $this->announcementRepository->orderBy('id', 'DESC')->get();
  }
  public function create(array $data)
  {
    return $this->announcementRepository->create($data)->id;
  }
  public function announcementDetails($id)
  {
    return $this->announcementRepository->find($id);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->announcementRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->announcementRepository->find($id)->delete();
  }
  // public function announcementAssignStore($request)
  // {
  //   $created = $this->announcementRepository->where('id',$request['announcement_id'])->update($request);
  //   if ($created)
  //     return  true;
  //   else
  //     return false;
  // }


  public function getAllAssignedAnnouncement()
  {
    try {

      $user = auth()->guard('employee_api')->user();
      $announcementIds = [];
      $announcements = $this->announcementRepository->where('company_id', $user->company_id)->get();
      //->select('id','title','image','start_date','end_date','file','description','news_category_id')
      $departments = $this->departmentServices->getAllActiveDepartmentsUsingByCompanyID($user->company_id);
      $userDetails = $this->userDetailServices->getDetailsByUserId($user->id);

      foreach ($announcements as $row) {
        // check for branch 
        if ($row->all_branch == 1) {
          $branches = $this->branchServices->allActiveCompanyBranchesByUsingCompanyId($row->company_id);
          $branchIds = $branches->pluck('id')->toArray();
        } else if ($row->all_branch == 0) {
          $branchIds = $row->branches()->pluck('branch_id')->toArray();
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
          array_push($announcementIds, $row->id);
        }
      }

      $finalAnnouncement = $announcements->whereIn('id', $announcementIds)->makeHidden([
        "all_branch",
        "all_department",
        "all_designation",
        "company_id",
        "company_branch_id",
        "created_at",
        "updated_at"
      ]);
      return $finalAnnouncement;
    } catch (Throwable $th) {
      return errorMessage('null', $th->getMessage());
    }
  }
}
