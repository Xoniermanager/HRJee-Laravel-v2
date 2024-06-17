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
}
