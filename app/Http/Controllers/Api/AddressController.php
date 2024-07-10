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

            $addresOne = $data['address'][0];
            $addresTwo = $data['address'][1];
            if ($request->both_same == 1) {
                $this->userAddressServices->deleteUserAddress(Auth::guard('employee_api')->user()->id);
                $addressCreate  = $addresOne;
                $addressCreate['user_id'] = Auth::guard('employee_api')->user()->id;
                unset($addressCreate['addressId']);
                $addressCreate['address_type'] = 'both_same';

                // check address type both type should not same 
                if ($addresTwo['address_type'] == $addresOne['address_type']) {
                    return errorMessage('null', 'both address can not be same time ');
                }

                if ($addressCreate['address'] != $addressCreate['address'])
                    return errorMessage('null', 'address are not same');
                if ($addressCreate['city'] != $addressCreate['city'])
                    return errorMessage('null', 'city are not same');
                if ($addressCreate['pin_code'] != $addressCreate['pin_code'])
                    return errorMessage('null', 'pin code are not same');
                if ($addressCreate['country_id'] != $addressCreate['country_id'])
                    return errorMessage('null', 'country are not same');
                if ($addressCreate['state_id'] != $addressCreate['state_id'])
                    return errorMessage('null', 'state are not same');



                $addressUpdate =   $this->userAddressServices->createAddress($addressCreate);
            } else {
                // if ($addresOne['address_type'] == 'permanent') {
                if (isset($addresOne['addressId']) && !empty($addresOne['addressId'])) {
                    $addressId = $addresOne['addressId'];
                    unset($addresOne['addressId']);
                    $addresOne['address_type'] = 'permanent';
                    $this->userAddressServices->update(Auth::guard('employee_api')->user()->id, $addressId, $addresOne);
                }

                // check address type both type should not same 
                if ($addresTwo['address_type'] == $addresOne['address_type']) {
                    return errorMessage('null', 'both address can not be same time ');
                }

                if (isset($addresTwo['addressId']) && !empty($addresTwo['addressId'])) {
                    $addressId = $addresTwo['addressId'];
                    unset($addresTwo['addressId']);
                    $addressUpdate =   $this->userAddressServices->update(Auth::guard('employee_api')->user()->id, $addressId, $addresTwo);
                } else {
                    $checkAddress = $this->userAddressServices->getDetailById(Auth::guard('employee_api')->user()->id);
                    if (count($checkAddress) == 2) {
                        return errorMessage('null', 'not allowed to add more then two address,instead add you can update');
                    }
                    
                    $addresTwo['user_id'] = Auth::guard('employee_api')->user()->id;
                    $addressUpdate =  $this->userAddressServices->createAddress($addresTwo);
                }
                // }
            }



            if ($addressUpdate)
                return apiResponse('address_updated');
            else
                return errorMessage('null', 'Address not found!');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
