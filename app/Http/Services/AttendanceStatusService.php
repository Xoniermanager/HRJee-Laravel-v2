<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\AttendanceStatusRepository;

class AttendanceStatusService
{
  private $attendanceStatusRepository;
  public function __construct(AttendanceStatusRepository $attendanceStatusRepository)
  {
    $this->attendanceStatusRepository = $attendanceStatusRepository;
  }
  public function all()
  {
    return $this->attendanceStatusRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    return $this->attendanceStatusRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->attendanceStatusRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->attendanceStatusRepository->find($id)->delete();
  }
}
