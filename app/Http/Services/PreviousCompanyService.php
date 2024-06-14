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


  public function searchPreviousCompanyFilter($request)
  {
    $previousCountryDetails = $this->previousCompanyRepository;

    /**List By Search or Filter */
    if (isset($request->search) && !empty($request->search)) {
      $previousCountryDetails = $previousCountryDetails->where('name', 'Like', '%' . $request->search . '%');
    }
    /**List By Status or Filter */
    if (isset($request->status) && !empty($request->status)) {
      if ($request->status == 2) {
        $status = 0;
      } else {
        $status = $request->status;
      }
      $previousCountryDetails = $previousCountryDetails->where('status', $status);
    }
    return $previousCountryDetails->orderBy('id', 'DESC')->paginate(10);
  }
}
