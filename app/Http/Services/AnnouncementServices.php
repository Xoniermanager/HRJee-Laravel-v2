<?php

namespace App\Http\Services;

use App\Models\Announcement;
use App\Repositories\AnnouncementAssignRepository;
use App\Repositories\AnnouncementRepository;

class AnnouncementServices
{
  private $announcementRepository;
  private $announcementAssignRepository;
  public function __construct(AnnouncementRepository $announcementRepository, AnnouncementAssignRepository $announcementAssignRepository)
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
  public function announcementAssignStore($request)
  {
    $created = $this->announcementAssignRepository->updateOrCreate(['announcement_id' => $request['announcement_id']], $request);
    if ($created)
      return  true;
    else
      return false;
  }
}
