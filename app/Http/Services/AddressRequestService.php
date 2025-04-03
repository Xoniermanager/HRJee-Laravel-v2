<?php

namespace App\Http\Services;

use Illuminate\Support\Arr;
use App\Models\UserActiveLocation;
use App\Repositories\AddressRequestRepository;

class AddressRequestService
{
    private $addressRequestRepository;
    public function __construct(AddressRequestRepository $addressRequestRepository)
    {
        $this->addressRequestRepository = $addressRequestRepository;
    }

    public function getAddressRequestByUserId($userId)
    {
        return $this->addressRequestRepository->where('user_id', $userId);
    }
    public function getAddressRequestByCompanyId($companyId)
    {
        return $this->addressRequestRepository->where('company_id', $companyId);
    }

    public function create($data)
    {
        $result = app('geocoder')->geocode($data['address'])->get();
        $coordinates = $result[0]->getCoordinates();
        $data['latitude'] = $coordinates->getLatitude();
        $data['longitude'] = $coordinates->getLongitude();
        return $this->addressRequestRepository->create($data);
    }
    public function updateDetails($data, $requestId)
    {
        $result = app('geocoder')->geocode($data['address'])->get();
        $coordinates = $result[0]->getCoordinates();
        $data['latitude'] = $coordinates->getLatitude();
        $data['longitude'] = $coordinates->getLongitude();
        return $this->addressRequestRepository->find($requestId)->update($data);
    }

    public function destroy($requestId)
    {
        return $this->addressRequestRepository->find($requestId)->delete();
    }

    public function updateStatus($data)
    {
        $attendanceRequest = $this->addressRequestRepository->find($data['requestId']);
        $payload = Arr::only($attendanceRequest->toArray(), ['user_id', 'address', 'latitude', 'longitude']);
        if ($data['status'] == 'approved') {
            UserActiveLocation::where('user_id', $attendanceRequest->user_id)->update(['status' => false]);
            UserActiveLocation::create($payload);
        }
        return $attendanceRequest->update(['status' => $data['status']]);
    }

    public function getFilteredRequestDetails($request)
    {
        $assetCategoryDetails = $this->addressRequestRepository->where('company_id', Auth()->user()->company_id);
        /**List By Search or Filter */
        if (isset($request['search']) && !empty($request['search'])) {
            $searchKey = $request['search'];
            // Searching by name or email in the related user
            $assetCategoryDetails->whereHas('user', function ($query) use ($searchKey) {
                $query->where('name', 'like', '%' . $searchKey . '%')
                    ->orWhere('email', 'like', '%' . $searchKey . '%');
            });
        }
        /**List By Status or Filter */
        if (isset($request['status'])) {
            $assetCategoryDetails = $assetCategoryDetails->where('status', $request['status']);
        }
        return $assetCategoryDetails->orderBy('id', 'DESC')->paginate(10);
    }

    public function createAddressRequestByApi($data)
    {
        return $this->addressRequestRepository->create($data);
    }
    public function updateAddressRequestByApi($data, $requestId)
    {
        return $this->addressRequestRepository->find($requestId)->update($data);
    }

    public function getAddressDetailsByRequestId($requestId)
    {
        return $this->addressRequestRepository->find($requestId);
    }
}
