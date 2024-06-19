<?php

namespace App\Http\Services;

use App\Repositories\QualificationRepository;

class QualificationService
{
  private $qualificationRepository;
  public function __construct(QualificationRepository $qualificationRepository)
  {
    $this->qualificationRepository = $qualificationRepository;
  }
  public function all()
  {
    return $this->qualificationRepository->orderBy('id','DESC')->paginate(10);
  }

  public function get_qualification_ajax_call()
  {
    return $this->qualificationRepository->orderBy('id','DESC')->get();
  }

  public function create(array $data)
  {
    return $this->qualificationRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->qualificationRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->qualificationRepository->find($id)->delete();
  }

  public function searchInQualification($searchKey)
  {
    $data['key']    = array_key_exists('key', $searchKey) ? $searchKey['key'] : '';
    $data['status'] = array_key_exists('status', $searchKey) ? $searchKey['status'] : '';

    return $this->qualificationRepository->where(function($query) use ($data) {
      if (!empty($data['key'])) {
          $query->where('name', 'like', "%{$data['key']}%");
      }

      if (isset($data['status'])) {
          $query->where('status', $data['status']);
      }
    })->get();

  }
}
