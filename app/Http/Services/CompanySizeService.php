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
    return $this->companySizeRepository->orderBy('id','DESC')->paginate(10);
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

  public function searchInCompanySize($searchKey)
  {
    $data['key']     =  array_key_exists('key', $searchKey) ? $searchKey['key'] : '';
    $data['status']  =  array_key_exists('status', $searchKey) ? $searchKey['status'] : '';

    return $this->companySizeRepository->where(function($query) use ($data) {
      if (!empty($data['key'])) {
          $query->where('company_size', 'like', "%{$data['key']}%")
          ->orWhere('description', 'like', "%{$data['key']}%");
      }

      if (isset($data['status'])) {
          $query->where('status', $data['status']);
      }
    })->get();
  }
}
