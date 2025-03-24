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

  /**
   * Undocumented function
   *
   * @return void
   */
  public function all()
  {
    return $this->companySkillsRepository->orderBy('id','DESC')->paginate(10);
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function get_skill_ajax_call()
  {
    return $this->companySkillsRepository->orderBy('id','DESC')->get();
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @return void
   */
  public function create(array $data)
  {
    return $this->companySkillsRepository->create($data);
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @param [type] $id
   * @return void
   */
  public function updateDetails(array $data, $id)
  {
    return $this->companySkillsRepository->find($id)->update($data);
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function deleteDetails($id)
  {
    return $this->companySkillsRepository->find($id)->delete();
  }

  /**
   * Undocumented function
   *
   * @param [type] $searchKey
   * @return void
   */
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
  
  /**
   * Undocumented function
   *
   * @return void
   */
  public function getAllActiveSkills()
  {
    return $this->companySkillsRepository->where('status','1')->get();
  }
}
