<?php

namespace App\Http\Services;

use App\Repositories\ComplainStatusRepository;

class ComplainStatusService
{
  private $complainStatusRepository;
  public function __construct(ComplainStatusRepository $complainStatusRepository)
  {
    $this->complainStatusRepository = $complainStatusRepository;
  }
  public function all()
  {
    return $this->complainStatusRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    $data['company_id'] = Auth()->guard('admin')->user()->company_id ?? '';
    return $this->complainStatusRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->complainStatusRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->complainStatusRepository->find($id)->delete();
  }
  public function getAllActiveComplainStatus()
  {
    return $this->complainStatusRepository->where('status', '1')->get();
  }

  public function serachComplainStatusFilterList($request)
  {
    $complainStatusDetails = $this->complainStatusRepository;
    /**List By Search or Filter */
    if (isset($request->search) && !empty($request->search)) {
      $complainStatusDetails = $complainStatusDetails->where('name', 'Like', '%' . $request->search . '%');
    }
    /**List By Status or Filter */
    if (isset($request->status)) {
      $complainStatusDetails = $complainStatusDetails->where('status', $request->status);
    }
    return $complainStatusDetails->orderBy('id', 'DESC')->paginate(10);
  }
}
