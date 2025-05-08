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

  /**
   * Undocumented function
   *
   * @return void
   */
  public function all()
  {
    return $this->previousCompanyRepository->orderBy('id', 'DESC')->paginate(10);
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function get_previous_company_ajax_call()
  {
    return $this->previousCompanyRepository->orderBy('id', 'DESC')->get();
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @return void
   */
  public function create(array $data)
  {
    $data['created_by'] = auth()->user()->id;
    
    return $this->previousCompanyRepository->create($data);
  }

  /**
   * Undocumented function
   *
   * @param array $data
   * @param [type] $id
   * @return void
   */
  public function updateDetails(array $data, $id)
  {
    return $this->previousCompanyRepository->find($id)->update($data);
  }

  /**
   * Undocumented function
   *
   * @param [type] $id
   * @return void
   */
  public function deleteDetails($id)
  {
    return $this->previousCompanyRepository->find($id)->delete();
  }

  /**
   * Undocumented function
   *
   * @param [type] $request
   * @return void
   */
  public function searchPreviousCompanyFilter($request)
  {
    $previousCountryDetails = $this->previousCompanyRepository;

    /**List By Search or Filter */
    if (isset($request->search) && !empty($request->search)) {
      $previousCountryDetails = $previousCountryDetails->where('name', 'Like', '%' . $request->search . '%');
    }
    /**List By Status or Filter */
    if (isset($request->status)) {
      $previousCountryDetails = $previousCountryDetails->where('status', $request->status);
    }
    return $previousCountryDetails->orderBy('id', 'DESC')->paginate(10);
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function getAllActivePreviousCompany()
  {
    return $this->previousCompanyRepository->where('status','1')->get();
  }
}
