<?php

namespace App\Http\Services;

use App\Repositories\StateRepository;

class StateServices
{
  private $stateRepository;
  public function __construct(StateRepository $stateRepository)
  {
    $this->stateRepository = $stateRepository;
  }
  public function all()
  {
    return $this->stateRepository->with('countries')->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    return $this->stateRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->stateRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->stateRepository->find($id)->delete();
  }

  public function getAllStateUsingCountryID($country_id)
  {
    return $this->stateRepository->where('country_id', $country_id)->where('status','1')->get();
  }
}
