<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddressDetailRequest;
use App\Http\Requests\UserAddressUpdateRequest;
use App\Http\Services\UserAddressDetailServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class AddressController extends Controller
{


    private $userAddressServices;
    public function __construct(UserAddressDetailServices $userAddressServices)
    {
        $this->userAddressServices = $userAddressServices;
    }
    public function addressDetails(UserAddressDetailRequest $request)
    {
        try {

            $address = $this->userAddressServices->checkExistingDetails(Auth::user()->id, $request->address_type);
            if ($address)
                return apiResponse('address', $address);
            else
                return errorMessage('null', 'Address not found!');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
    public function getAllAddresses(Request $request)
    {
        try {

            $address = $this->userAddressServices->getDetailById(Auth::user()->id);
            if (count($address) > 0)
                return apiResponse('address', $address);
            else
                return errorMessage('null', 'Address not found!');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
    public function updateAddress(UserAddressUpdateRequest $request)
    {
        try {
            $data = $request->except(['addressId','address_type']);
            $address = $this->userAddressServices->update(Auth::user()->id, $request->addressId,$request->address_type, $data);
            if ($address)
                return apiResponse('address_updated');
            else
                return errorMessage('null', 'Address not found!');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
