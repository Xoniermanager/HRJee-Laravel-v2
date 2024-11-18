<?php

namespace App\Http\Services;

use App\Repositories\ResignationRepository;
use Throwable;

class ResignationService
{
  private $resignationRepository;
  private $resignationStatusService;
  public function __construct(ResignationStatusService $resignationStatusService, ResignationRepository $resignationRepository)
  {
    $this->resignationRepository = $resignationRepository;
    $this->resignationStatusService = $resignationStatusService;
  }


  public function all($userId = '')
  {
    $query = $this->resignationRepository->with(['resignationStatus'])->orderBy('id', 'DESC');
    if (!empty($userId))
      $query = $query->where('user_id', $userId);

    return $query->paginate(10);
  }

  public function getResignationByResigtionStatusIds($ids, $userId)
  {
    return $this->resignationRepository->whereNotIn('resignation_status_id', $ids)->where('user_id', $userId)->orderBy('id', 'DESC')->get();
  }

  public function resignation($data, $guard)
  {
    $resignationStatus = $this->resignationStatusService->getResignationStatusByIdOrStatus('status', 'pending');
    $data['resignation_status_id'] = $resignationStatus->id;
    $data['user_id'] = auth()->guard($guard)->user()->id;
    $checkActionStatus = $this->resignationRepository->create($data);
    if ($checkActionStatus)
      return true;
    else
      return false;
  }
  public function resignationUpdate($data,$resignationId)
  {
    $checkActionStatus = $this->resignationRepository->where('id', $resignationId)->update($data);
    if ($checkActionStatus)
      return true;
    else
      return false;
  }


  public function getResignationDetails($resignationId)
  {
    return  $this->resignationRepository->with(['resignationStatus:id,name', 'resignationActionDetails:id,action_taken_by,resignation_status_id,remark,resignation_id', 'resignationActionDetails.actionTakenBy:id,name', 'resignationActionDetails.resignationStatus:id,name'])->find($resignationId);
  }

  public function deleteDetails($id)
  {
    return $this->resignationRepository->find($id)->delete();
  }
}
