<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAddressDetailRequest;
use App\Http\Requests\UserAddressUpdateRequest;
use App\Http\Services\UserAddressDetailServices;
use App\Models\UserAddressDetail;
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

            $address = $this->userAddressServices->checkExistingDetails(Auth::guard('employee_api')->user()->id, $request->address_type);
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

            $address = $this->userAddressServices->getDetailById(Auth::guard('employee_api')->user()->id);
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
        $data = $request->validated();
        try {
            // if(count($data))
            // {

            // }

            if (count($data['address']) == 2) {
                foreach ($data['address'] as $address) {
                    if (isset($address['addressId']) && !empty($address['addressId'])) {
                        $addressId = $address['addressId'];
                        unset($address['addressId']);
                        $address['address_type'] = 'permanent';
                        $addressUpdate =   $this->userAddressServices->update(Auth::guard('employee_api')->user()->id, $addressId, $address);
                    } else {
                        $address['address_type'] = 'local';
                        $address['user_id'] = Auth::guard('employee_api')->user()->id;
                        $addressUpdate =  $this->userAddressServices->createAddress($address);
                    }
                }
            } else if (count($data['address']) == 1) {
                foreach ($data['address'] as $address) {
                    if (isset($address['addressId']) && !empty($address['addressId'])) {
                        $this->userAddressServices->deleteUserAddress(Auth::guard('employee_api')->user()->id);
                        $addressId = $address['addressId'];
                        $address['address_type'] = 'both_same';
                        $address['user_id'] = Auth::guard('employee_api')->user()->id;
                        unset($address['addressId']);
                        $addressUpdate =   $this->userAddressServices->createAddress($address);
                    }
                }
            }

            // $data = $request->except(['addressId', 'address_type']);
            // $address = $this->userAddressServices->update(Auth::guard('employee_api')->user()->id, $request->addressId, $request->address_type, $data);
            if ($addressUpdate)
                return apiResponse('address_updated');
            else
                return errorMessage('null', 'Address not found!');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
