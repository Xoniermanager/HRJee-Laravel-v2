<?php

namespace App\Http\Services;

use App\Repositories\officeTimeConfigRepository;

class OfficeTimeConfigService
{
  private $officeTimeConfigRepository;
  public function __construct(officeTimeConfigRepository $officeTimeConfigRepository)
  {
    $this->officeTimeConfigRepository = $officeTimeConfigRepository;
  }
  public function all()
  {
    return $this->officeTimeConfigRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    return $this->officeTimeConfigRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->officeTimeConfigRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->officeTimeConfigRepository->find($id)->delete();
  }

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
