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


  public function searchInState($searchKey)
  {
    $data['key']    = array_key_exists('key', $searchKey) ? $searchKey['key'] : '';
    $data['status'] = array_key_exists('status', $searchKey) ? $searchKey['status'] : '';

    return $this->stateRepository->where(function($query) use ($data) {
      if (!empty($data['key'])) {
          $query->where('name', 'like', "%{$data['key']}%");
      }

      if (isset($data['status'])) {
          $query->where('status', $data['status']);
      }
    })->get();

  }


}
