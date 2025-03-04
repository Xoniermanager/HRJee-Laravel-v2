<?php

namespace App\Http\Services;

use App\Repositories\CompanySizeRepository;

class CompanySizeService
{
  private $companySizeRepository;
  public function __construct(CompanySizeRepository $companySizeRepository)
  {
    $this->companySizeRepository = $companySizeRepository;
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function all()
  {
    return $this->companySizeRepository->orderBy('id','DESC')->paginate(10);
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @return void
   */
  public function create(array $data)
  {
    return $this->companySizeRepository->create($data);
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
    return $this->companySizeRepository->find($id)->update($data);
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function deleteDetails($id)
  {
    return $this->companySizeRepository->find($id)->delete();
  }

  /**
   * Undocumented function
   *
   * @param [type] $searchKey
   * @return void
   */
  public function searchInCompanySize($searchKey)
  {
    $data['key']     =  array_key_exists('key', $searchKey) ? $searchKey['key'] : '';
    $data['status']  =  array_key_exists('status', $searchKey) ? $searchKey['status'] : '';

    return $this->companySizeRepository->where(function($query) use ($data) {
      if (!empty($data['key'])) {
          $query->where('company_size', 'like', "%{$data['key']}%")
          ->orWhere('description', 'like', "%{$data['key']}%");
      }

      if (isset($data['status'])) {
          $query->where('status', $data['status']);
      }
    })->get();
  }
}
