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

    public function serachFilterList($request)
    {
        $countryDetails = $this->countryRepository;

        /**List By Search or Filter */
        if (isset($request->search) && !empty($request->search)) {
            $countryDetails = $countryDetails->where('name', 'Like', '%' . $request->search . '%');
        }
        /**List By Status or Filter */
        if (isset($request->status)) {
            $countryDetails = $countryDetails->where('status', $request->status);
        }
        return $countryDetails->orderBy('id', 'DESC')->paginate(10);
    }
    public function getAllActiveCountry()
    {
        return $this->countryRepository->where('status', '1')->get();
    }
}
