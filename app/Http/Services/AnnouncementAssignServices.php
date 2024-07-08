<?php

namespace App\Http\Services;

use App\Repositories\AnnouncementAssignRepository;

class AnnouncementAssignServices
{
  private $announcementAssignRepository;
  public function __construct(AnnouncementAssignRepository $announcementAssignRepository)
  {
    $this->announcementAssignRepository = $announcementAssignRepository;
  }
  public function all($type = '')
  {
    if ($type == 'paginate')
      return $this->announcementAssignRepository->with('announcement')->orderBy('id', 'DESC')->paginate(10);
    else
      return $this->announcementAssignRepository->with('announcement')->orderBy('id', 'DESC')->get();
  }

  public function announcementAssignDetails($id)
  {
    return  $this->announcementAssignRepository->where('id', $id)->first();
  }
  public function updateDetails(array $data, $id)
  {
    return $this->announcementAssignRepository->find($id)->update($data);
  }

  public function deleteDetails($id)
  {
    return $this->announcementAssignRepository->find($id)->delete();
  }


  public function getAllAssignAnnouncement($companyId,$branchId)
  {
    return $this->announcementAssignRepository->whereHas('announcement', function ($query) use ($companyId,$branchId) {
      $query->where('expires_at', '>=', date('Y-m-d h:i a'))->where('company_branch_id', $companyId)->orWhere('company_branch_id',$branchId)->active();
    })->active()->orderBy('id', 'DESC')->get();
  }
}
