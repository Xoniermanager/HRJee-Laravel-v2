<?php

namespace App\Http\Services;

use App\Repositories\OfficeTimeConfigRepository;

class OfficeTimeConfigService
{
  private $officeTimeConfigRepository;
  public function __construct(OfficeTimeConfigRepository $officeTimeConfigRepository)
  {
    $this->officeTimeConfigRepository = $officeTimeConfigRepository;
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function all()
  {
    return $this->officeTimeConfigRepository->orderBy('id', 'DESC')->paginate(10);
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @return void
   */
  public function create(array $data)
  {
    $data['company_id'] = Auth()->user()->company_id;
    $data['created_by'] = Auth()->user()->id;
    return $this->officeTimeConfigRepository->create($data);
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
    return $this->officeTimeConfigRepository->find($id)->update($data);
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function deleteDetails($id)
  {
    return $this->officeTimeConfigRepository->find($id)->delete();
  }

  /**
   * Undocumented function
   *
   * @param [type] $request
   * @return void
   */
  public function searchOfficeTimeFilter($request)
  {
    $officeTimeConfigDetails = $this->officeTimeConfigRepository;

    /**List By Search or Filter */
    if (isset($request->search) && !empty($request->search)) {
      $searchKey = $request->search;
      $officeTimeConfigDetails = $officeTimeConfigDetails->where(function ($query) use ($searchKey) {
        $query->where('name', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('shift_hours', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('half_day_hours', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('min_shift_Hours', 'LIKE', '%' . $searchKey . '%');
        $query->orWhere('min_half_day_hours', 'LIKE', '%' . $searchKey . '%');
      });
    }
    /**List By Branch or Filter */
    if (isset($request->branch) && !empty($request->branch)) {
      $officeTimeConfigDetails = $officeTimeConfigDetails->where('company_branch_id', $request->branch);
    }
    return $officeTimeConfigDetails->orderBy('id', 'DESC')->paginate(10);
  }
}
