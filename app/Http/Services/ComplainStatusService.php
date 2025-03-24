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

  /**
   * all function
   *
   * @return void
   */
  public function all()
  {
    return $this->complainStatusRepository->orderBy('id', 'DESC')->paginate(10);
  }

  /**
   * create
   *
   * @param array $data
   * @return void
   */
  public function create(array $data)
  {
    $data['company_id'] = Auth()->user()->id ?? '';
    return $this->complainStatusRepository->create($data);
  }

  /**
   * updateDetails
   *
   * @param array $data
   * @param [type] $id
   * @return void
   */
  public function updateDetails(array $data, $id)
  {
    return $this->complainStatusRepository->find($id)->update($data);
  }

  /**
   * deleteDetails
   *
   * @param [type] $id
   * @return void
   */
  public function deleteDetails($id)
  {
    return $this->complainStatusRepository->find($id)->delete();
  }

  /**
   * getAllActiveComplainStatus
   *
   * @return void
   */
  public function getAllActiveComplainStatus()
  {
    return $this->complainStatusRepository->where('status', '1')->get();
  }

  /**
   * serachComplainStatusFilterList
   *
   * @param [type] $request
   * @return void
   */
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
