<?php

namespace App\Http\Services;

use App\Repositories\PreviousCompanyRepository;

class PreviousCompanyService
{
  private $previousCompanyRepository;
  public function __construct(PreviousCompanyRepository $previousCompanyRepository)
  {
    $this->previousCompanyRepository = $previousCompanyRepository;
  }
  public function all()
  {
    return $this->previousCompanyRepository->orderBy('id', 'DESC')->paginate(10);
  }

  public function get_previous_company_ajax_call()
  {
    return $this->previousCompanyRepository->orderBy('id', 'DESC')->get();
  }

  public function create(array $data)
  {
    return $this->previousCompanyRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->previousCompanyRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->previousCompanyRepository->find($id)->delete();
  }


  public function searchInPreviousCompany($searchKey)
  {
    $data['key']    = array_key_exists('key', $searchKey) ? $searchKey['key'] : '';
    $data['status'] = array_key_exists('status', $searchKey) ? $searchKey['status'] : '';

    return $this->previousCompanyRepository->where(function($query) use ($data) {
      if (!empty($data['key'])) {
          $query->where('name', 'like', "%{$data['key']}%");
      }

      if (isset($data['status'])) {
          $query->where('status', $data['status']);
      }
    })->get();

  }
}
