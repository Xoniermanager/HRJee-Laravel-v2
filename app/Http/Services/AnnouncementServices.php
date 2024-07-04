<?php

namespace App\Http\Services;

use App\Models\Announcement;
use App\Repositories\AnnouncementAssignRepository;
use App\Repositories\AnnouncementRepository;

class AnnouncementServices
{
  private $announcementRepository;
  private $announcementAssignRepository;
  public function __construct(AnnouncementRepository $announcementRepository,AnnouncementAssignRepository $announcementAssignRepository)
  {
    $this->announcementRepository = $announcementRepository;
    $this->announcementAssignRepository = $announcementAssignRepository;
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
    return $this->announcementRepository->create($data);
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
  public function announcementAssignStore($request)
  {

    $data['announcement_id'] = $request['announcement_id'];
    // $data['department_id'] = json_encode($request['department_id']);
    // $data['company_branch_id'] = json_encode($request['company_branch_id']);
    // $data['designation_id'] = json_encode($request['designation_id']);
    $data['notification_schedule_time'] = $request['notification_schedule_time'];
    $created = $this->announcementAssignRepository->updateOrCreate(['announcement_id'=>$request['announcement_id'],'company_branch_id'=>$request['company_branch_id']],$data);
    if ($created)
      return  true;
    else
      return false;
  }
}
