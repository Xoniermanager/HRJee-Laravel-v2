<?php

namespace App\Http\Services;

use App\Repositories\CompanySizeRepository;

class CompanySizeService
{
  private $companySizeRepository;
  public function __construct(CompanySizeRepository $companySizeRepository)
  {
    $this->companySizeRepository = $companySizeRepository;
  }
  public function all()
  {
    return $this->companySizeRepository->paginate(10);
  }

  public function create(array $data)
  {
    return $this->companySizeRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->companySizeRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->companySizeRepository->find($id)->delete();
  }
}
