<?php

namespace App\Http\Services;

use App\Repositories\shiftRepository;

class ShiftServices
{
  private $shiftRepository;
  public function __construct(ShiftRepository $shiftRepository)
  {
    $this->shiftRepository = $shiftRepository;
  }
  public function all()
  {
    return $this->shiftRepository->orderBy('id','DESC')->paginate(10);
  }
  public function create(array $data)
  {
    return $this->shiftRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->shiftRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->shiftRepository->find($id)->delete();
  }
}
