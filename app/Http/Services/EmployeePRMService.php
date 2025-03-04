<?php

namespace App\Http\Services;

use App\Repositories\EmployeePRMRepository;

class EmployeePRMService
{
  private $employeePRMRepository;
  public function __construct(EmployeePRMRepository $employeePRMRepository)
  {
    $this->employeePRMRepository = $employeePRMRepository;
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function all()
  {
    return $this->employeePRMRepository->with('category')->orderBy('id', 'DESC')->paginate(10);
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @return void
   */
  public function create(array $data)
  {
    $data['user_id'] = Auth()->user()->id;

    return $this->employeePRMRepository->create($data);
  }


  public function update(array $data, $id)
  {

    return $this->employeePRMRepository->where('id', $id)->update($data);
  }

  public function delete($id)
  {

    return $this->employeePRMRepository->where('id', $id)->delete();
  }

  /**
   * Undocumented function
   *
   * @param [type] $userId
   * @return void
   */
  public function getAllPRMByUserId($userId)
  {
    return $this->employeePRMRepository->where('user_id', $userId)->with('category')->orderBy('id', 'DESC')->paginate(10);
  }

  /**
   * Undocumented function
   *
   * @param [type] $Id
   * @return void
   */
  public function findById($Id)
  {
    return $this->employeePRMRepository->where('id', $Id)->with('category')->first();
  }
}
