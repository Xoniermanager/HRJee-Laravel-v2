<?php

namespace App\Http\Services;

use App\Models\ResignationLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ResignationRepository;
use App\Repositories\ResignationLogRepository;
use App\Repositories\ResignationStatusRepository;
use App\Http\Requests\ChangeResignationStatusRequest;

class ResignationStatusService
{
  private $resignationStatusRepository;
  private $resignationRepository;
  private $resignationLogRepository;

  public function __construct(ResignationLogRepository $resignationLogRepository, ResignationRepository $resignationRepository, ResignationStatusRepository $resignationStatusRepository)
  {
    $this->resignationStatusRepository = $resignationStatusRepository;
    $this->resignationRepository = $resignationRepository;
    $this->resignationLogRepository = $resignationLogRepository;
  }

  /**
   * Undocumented function
   *
   * @param string $type
   * @return void
   */
  public function all($type = '')
  {
    $query = $this->resignationStatusRepository->select('id', 'name', 'status')->orderBy('id', 'DESC');
    if ($type == 'all')
      $query = $query->active()->get();
    else
      $query = $query->paginate(10);

    return $query;
  }

  /**
   * Undocumented function
   *
   * @param [type] $type
   * @param [type] $value
   * @return void
   */
  public function getResignationStatusByIdOrStatus($type, $value)
  {
    $query = $this->resignationStatusRepository;
    if ($type == 'id') {
      $query = $query->where('id', $value);
    } else if ($type == 'status') {
      $query = $query->where('name', $value);
    }
    return $query->first();
  }

  /**
   * Undocumented function
   *
   * @param [type] $resignationId
   * @param [type] $data
   * @param [type] $action_taken_by
   * @return void
   */
  public function changeStatus($resignationId, $data, $action_taken_by)
  {
    try {
      DB::beginTransaction();
      $resignation = $this->resignationRepository->find($resignationId);

      if ($resignation) {
        $resignation->update([
          'status' => $data['status'],
          'release_date' => $data['release_date'] ?? null
        ]);

        // Save Log
        $resignationLog = new ResignationLog([
          'status' => $data['status'],
          'resignation_id' => $resignationId,
          'remark' => $data['remark']
        ]);
        $resignationLog->actionTakenBy()->associate($action_taken_by);
        $resignationLog->save();
      }

      DB::commit();
      return true;
    } catch (\Throwable $th) {
      DB::rollBack();
      return false;
    }
  }

  /**
   * Undocumented function
   *
   * @param [type] $data
   * @param [type] $id
   * @return void
   */
  public function updateDetails($data, $id)
  {
    return $this->resignationStatusRepository->find($id)->update($data);
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function deleteDetails($id)
  {
    return $this->resignationStatusRepository->find($id)->delete();
  }

  /**
   * Undocumented function
   *
   * @param [type] $data
   * @return void
   */
  public function create($data)
  {

    $data['company_id'] = Auth()->user()->company_id;
    $data['created_by'] = Auth()->user()->id;
    return $this->resignationStatusRepository->create($data);
  }

  /**
   * Undocumented function
   *
   * @param [type] $request
   * @return void
   */
  public function searchInResignationStatus($request)
  {
    $resignationStatusDetails = $this->resignationStatusRepository;

    if (isset($request->search) && !empty($request->search)) {
      $searchKey = $request->search;
      $resignationStatusDetails = $resignationStatusDetails->where(function ($query) use ($searchKey) {
        $query->where('name', 'LIKE', '%' . $searchKey . '%');
      });
    }

    /**List By Status or Filter */
    if (isset($request->status) && !empty($request->status)) {
      if ($request->status == 2) {
        $status = 0;
      } else {
        $status = $request->status;
      }
      $resignationStatusDetails = $resignationStatusDetails->where('status', $status);
    }

    return $resignationStatusDetails->orderBy('id', 'DESC')->paginate(10);
  }
}
