<?php

namespace App\Http\Services;

use App\Http\Requests\ChangeResignationStatusRequest;
use App\Repositories\ResignationLogRepository;
use App\Repositories\ResignationRepository;
use App\Repositories\ResignationStatusRepository;
use Illuminate\Support\Facades\Auth;

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

  public function all($type = '')
  {
    $query = $this->resignationStatusRepository->select('id', 'name', 'status')->orderBy('id', 'DESC');
    if ($type == 'all')
      $query =     $query->active()->get();
    else
      $query =  $query->paginate(10);

    return $query;
  }

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



  public function changeStatus($data, $userType)
  {

    $resignation = $this->resignationRepository->find($data['resignation_id']);
    if ($resignation) {

      // // check perssion for employee have only withdraw resgination
      // if ($userType == 'Employee' && $data['resignation_status_id'] != 4) {
      //   return ['status' => false, 'msg' => `you have only permission to cancel resignation!`];
      // }
      // to store old status in log table
      $resignationStatusId = $resignation->resignation_status_id;
      $updateData = ['resignation_status_id' => $data['resignation_status_id']];

      // check the action already applied or not
      if ($resignationStatusId == $data['resignation_status_id']) {
        return ['status' => false, 'msg' => 'this action just before taken!'];
      }

      // update realease date if status is for approved
      if ($data['resignation_status_id'] == 1) {
        $updateData['release_date'] = date('Y-m-d H:m:s', strtotime("+60 days"));
      }

      $update = $resignation->update($updateData);
      if ($update) {
        // create resignation log 
        $data['resignation_status_id'] = $resignationStatusId;
        $createLog = $this->resignationLogRepository->create($data);
        if ($createLog)
          return ['status' => true, 'msg' => 'executed'];
        else
          return ['status' => false, 'msg' => 'not executed'];
      }
    }
  }
  public function updateDetails($data, $id)
  {
    return $this->resignationStatusRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->resignationStatusRepository->find($id)->delete();
  }

  public function create($data)
  {

    $data['company_id'] = Auth::guard('admin')->user()->company_id;
    return $this->resignationStatusRepository->create($data);
  }

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
