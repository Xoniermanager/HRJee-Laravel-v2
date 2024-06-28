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
  public function all($type = '')
  {
    $query = $this->announcementRepository->orderBy('id', 'DESC');
    if ($type == 'paginate')
      return $query->paginate(10);
    else
      return $query->get();
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
