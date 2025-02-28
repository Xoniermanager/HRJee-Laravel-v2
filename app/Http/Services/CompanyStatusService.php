<?php

namespace App\Http\Services;

use App\Repositories\CompanyStatusRepository;

class CompanyStatusService
{
  private $companyStatusRepository;
  public function __construct(CompanyStatusRepository $companyStatusRepository)
  {
    $this->companyStatusRepository = $companyStatusRepository;
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function all()
  {
    return $this->companyStatusRepository->orderBy('id','DESC')->paginate(10);
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @return void
   */
  public function create(array $data)
  {
    return $this->companyStatusRepository->create($data);
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
    return $this->companyStatusRepository->find($id)->update($data);
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function deleteDetails($id)
  {
    return $this->companyStatusRepository->find($id)->delete();
  }
}
