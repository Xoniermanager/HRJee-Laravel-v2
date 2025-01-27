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
    $query = $this->resignationRepository->orderBy('id', 'DESC');
    if (!empty($userId))
      $query = $query->where('user_id', $userId);

    return $query->paginate(10);
  }

  public function getResignationByResignationStatusIds($statuses, $userId)
  {
    return $this->resignationRepository
      ->whereIn('status', $statuses)
      ->where('user_id', $userId)
      ->orderBy('id', 'DESC')
      ->get();
  }

  public function resignation($data, $userId)
  {
    $data['user_id'] = $userId;
    $checkActionStatus = $this->resignationRepository->create($data);
    if ($checkActionStatus)
      return true;
    else
      return false;
  }

  public function resignationUpdate($data, $resignationId)
  {
    $checkActionStatus = $this->resignationRepository->where('id', $resignationId)->update([
      'remark' => $data['remark'],
    ]);
    if ($checkActionStatus)
      return true;
    else
      return false;
  }


  public function getResignationDetails($resignationId)
  {
    return $this->resignationRepository
      ->with([
        'resignationActionDetails:id,action_taken_by_id,action_taken_by_type,status,remark,resignation_id',
        'resignationActionDetails.actionTakenBy:id,name',
        'user:id,name',
      ])
      ->find($resignationId);
  }

  public function deleteDetails($id)
  {
    return $this->resignationRepository->find($id)->delete();
  }
}
