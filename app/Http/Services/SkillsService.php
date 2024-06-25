<?php

namespace App\Http\Services;

use App\Repositories\SkillRepository;

class SkillsService
{
  private $companySkillsRepository;
  public function __construct(SkillRepository $companySkillsRepository)
  {
    $this->companySkillsRepository = $companySkillsRepository;
  }
  public function all()
  {
    return $this->companySkillsRepository->orderBy('id','DESC')->paginate(10);
  }
  public function get_skill_ajax_call()
  {
    return $this->companySkillsRepository->orderBy('id','DESC')->get();
  }

  public function create(array $data)
  {
    return $this->companySkillsRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->companySkillsRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->companySkillsRepository->find($id)->delete();
  }

  public function searchInSkills($searchKey)
  {
    $data['key']    = array_key_exists('key', $searchKey) ? $searchKey['key'] : '';
    $data['status'] = array_key_exists('status', $searchKey) ? $searchKey['status'] : '';

    return $this->companySkillsRepository->where(function($query) use ($data) {
      if (!empty($data['key'])) {
          $query->where('name', 'like', "%{$data['key']}%");
      }

      if (isset($data['status'])) {
          $query->where('status', $data['status']);
      }
    })->get();
  }
  
  public function getAllActiveSkills()
  {
    return $this->companySkillsRepository->where('status','1')->get();
  }
}
