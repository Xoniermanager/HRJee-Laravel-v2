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

    /**
     * all function
     *
     * @return void
     */
    public function all()
    {
        return $this->countryRepository->orderBy('id', 'DESC')->paginate(10);
    }

    /**
     * create function
     *
     * @param array $data
     * @return void
     */
    public function create(array $data)
    {
        return $this->countryRepository->create($data);
    }

    /**
     * updateDetails function
     *
     * @param array $data
     * @param [type] $id
     * @return void
     */
    public function updateDetails(array $data, $id)
    {
        return $this->countryRepository->find($id)->update($data);
    }

    /**
     * deleteDetails function
     *
     * @param [type] $id
     * @return void
     */
    public function deleteDetails($id)
    {
        return $this->countryRepository->find($id)->delete();
    }

    /**
     * serachFilterList function
     *
     * @param [type] $request
     * @return void
     */
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

    /**
     * getAllActiveCountry function
     *
     * @return void
     */
    public function getAllActiveCountry()
    {
        return $this->countryRepository->where('status', '1')->get();
    }
}
