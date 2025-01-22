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
        return $this->stateRepository->where('country_id', $country_id)->where('status', '1')->get();
    }
    // created by ashish
    public function getAllStates()
    {
        return $this->stateRepository->where('status', '1')->get();
    }

    public function searchStateFilter($request)
    {
        $stateDetails = $this->stateRepository->orderBy('id', 'DESC');
        // List By Search or Filter
        if (!empty($request['search'])) {
            $stateDetails = $stateDetails->where('name', 'LIKE', '%' . $request['search'] . '%');
        }
        // List By Country ID or Filter
        if (!empty($request['country_id'])) {
            $stateDetails = $stateDetails->where('country_id', $request['country_id']);
        }
        // List By Status or Filter
        if (isset($request['status']) && $request['status'] !== null) {
            $stateDetails = $stateDetails->where('status', $request['status']);
        }
        // Return paginated results
        return $stateDetails->paginate(10);
    }
}
