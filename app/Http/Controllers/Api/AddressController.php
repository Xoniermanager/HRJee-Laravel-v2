<?php

namespace App\Http\Controllers\Api;

use Exception;
use Throwable;
use Illuminate\Http\Request;
use App\Models\UserAddressDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\AddressRequestService;
use App\Http\Requests\UserAddressDetailRequest;
use App\Http\Requests\UserAddressUpdateRequest;
use App\Http\Services\UserAddressDetailServices;

class AddressController extends Controller
{


    private $userAddressServices;
    private $addressRequestService;
    public function __construct(UserAddressDetailServices $userAddressServices,AddressRequestService $addressRequestService)
    {
        $this->userAddressServices = $userAddressServices;
        $this->addressRequestService = $addressRequestService;
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

    public function storeAddressRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!app('geocoder')->geocode($value)->get()->count()) {
                        $fail('The provided address is incorrect.');
                    }
                }
            ],
            'latitude' => 'required',
            'longitude' => 'required',
            'reason' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 400);
        }
        try {
            $data = $request->all();
            $data['user_id'] = Auth()->user()->id;
            $data['company_id'] = Auth()->user()->company_id;
            $data['created_by'] = Auth()->user()->id;
            if ($this->addressRequestService->createAddressRequestByApi($data)) {
                return response()->json([
                    'status' => true,
                    'message' => "Address Request Added Successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Unable to Add Address Request Please try Again"
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "error" => $e->getMessage(),
                "message" => "Unable to Add the Address Request"
            ], 500);
        }
    }
    public function detailsAddressRequest($requestId)
    {
        try {
            $AddressRequestDetails = $this->addressRequestService->getAddressDetailsByRequestId($requestId);
            return response()->json([
                'status' => true,
                'message' => "Address Request Details",
                'data' => $AddressRequestDetails
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "error" => $e->getMessage(),
                "message" => "Unable to Fetch Address Request"
            ], 500);
        }
    }

    public function updateAddressRequest(Request $request, $requestId)
    {
        $validator = Validator::make($request->all(), [
            'address' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!app('geocoder')->geocode($value)->get()->count()) {
                        $fail('The provided address is incorrect.');
                    }
                }
            ],
            'latitude' => 'required',
            'longitude' => 'required',
            'reason' => 'required|string|max:255',
        ],);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 400);
        }
        try {
            $data = $request->all();
            if ($this->addressRequestService->updateAddressRequestByApi($data, $requestId)) {
                return response()->json([
                    'status' => true,
                    'message' => "Address Request Update Successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Unable to Update Address Request Please try Again"
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "error" => $e->getMessage(),
                "message" => "Unable to Update the Address Request"
            ], 500);
        }
    }

    public function deleteAttendanceRequest($requestId)
    {
        try {
            if ($this->addressRequestService->destroy($requestId)) {
                return response()->json([
                    'status' => true,
                    'message' => "Attendance Request Deleted Successfully"
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => "Unable to Deleted Attendance Request Please try Again"
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "error" => $e->getMessage(),
                "message" => "Unable to Deleted the Attendance Request"
            ], 500);
        }
    }

    public function getAllAddressRequestList()
    {
        try {
            $addressRequestDetails = $this->addressRequestService->getAddressRequestByUserId(Auth()->guard('employee_api')->user()->id)->paginate(10);
            return response()->json([
                'status' => true,
                'message' => "All Attendance Request List",
                'data' => $addressRequestDetails
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "error" => $e->getMessage(),
                "message" => "Unable to Fetch Attendance Request"
            ], 500);
        }
    }
}
