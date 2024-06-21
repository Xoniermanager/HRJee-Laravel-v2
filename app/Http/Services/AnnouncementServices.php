<?php

namespace App\Http\Services;

use App\Repositories\AnnouncementRepository;

class AnnouncementServices
{
  private $announcementRepository;
  public function __construct(AnnouncementRepository $announcementRepository)
  {
    $this->announcementRepository = $announcementRepository;
  }
  public function all()
  {
    return $this->announcementRepository->orderBy('id', 'DESC')->paginate(10);
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

  
}
