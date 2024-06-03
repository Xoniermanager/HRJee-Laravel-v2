<?php

namespace App\Http\Services;

use App\Repositories\CountryRepository;

class CountryServices
{
  private $countryRepository;
  public function __construct(CountryRepository $countryRepository)
  {
    $this->countryRepository = $countryRepository;
  }
  public function all()
  {
    return $this->countryRepository->orderBy('id', 'DESC')->paginate(10);
  }
  public function create(array $data)
  {
    return $this->countryRepository->create($data);
  }

  public function updateDetails(array $data, $id)
  {
    return $this->countryRepository->find($id)->update($data);
  }
  public function deleteDetails($id)
  {
    return $this->countryRepository->find($id)->delete();
  }
  // public function searchCountry($key)
  // {
  //   return $this->countryRepository->where(function($query) use ($key) {
  //       $query->where('name', 'like', "%$key%");
  //   })->get();
  // }

  public function searchInCountry($searchKey)
  {
    $data['key']    = array_key_exists('key', $searchKey) ? $searchKey['key'] : '';
    $data['status'] = array_key_exists('status', $searchKey) ? $searchKey['status'] : '';

    return $this->countryRepository->where(function($query) use ($data) {
      if (!empty($data['key'])) {
          $query->where('name', 'like', "%{$data['key']}%");
      }

      if (isset($data['status'])) {
          $query->where('status', $data['status']);
      }
    })->get();

  }
}
