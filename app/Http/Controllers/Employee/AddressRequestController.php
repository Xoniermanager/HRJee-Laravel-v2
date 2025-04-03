<?php

namespace App\Http\Controllers\Employee;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\AddressRequestService;

class AddressRequestController extends Controller
{
    public $addressRequestService;

    public function __construct(AddressRequestService $addressRequestService)
    {
        $this->addressRequestService = $addressRequestService;
    }

    public function index()
    {
        $allAddressRequest = $this->addressRequestService->getAddressRequestByUserId(Auth()->user()->id)->paginate(10);
        return view('employee.address_request.index', compact('allAddressRequest'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateCountryData = Validator::make($request->all(), [
            'address' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!app('geocoder')->geocode($value)->get()->count()) {
                        $fail('The provided address is incorrect.');
                    }
                }
            ],
            'reason' => 'required|string',
        ]);
        if ($validateCountryData->fails()) {
            return response()->json(['error' => $validateCountryData->messages()], 400);
        }
        try {
            $data = $request->all();
            $data['user_id'] = Auth()->user()->id;
            $data['company_id'] = Auth()->user()->company_id;
            $data['created_by'] = Auth()->user()->id;
            if ($this->addressRequestService->create($data)) {
                return response()->json([
                    'message' => 'Address Request Added Successfully!',
                    'data' => view('employee.address_request.list', [
                        'allAddressRequest' => $this->addressRequestService->getAddressRequestByUserId(Auth()->user()->id)->paginate(10)
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'address' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!app('geocoder')->geocode($value)->get()->count()) {
                        $fail('The provided address is incorrect.');
                    }
                }
            ],
            'reason' => 'required|string',
        ]);
        if ($validateData->fails()) {
            return response()->json(['error' => $validateData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $requestDetails = $this->addressRequestService->updateDetails($updateData, $request->id);
        if ($requestDetails) {
            return response()->json(
                [
                    'message' => 'Address Request Updated Successfully!',
                    'data' => view('employee.address_request.list', [
                        'allAddressRequest' => $this->addressRequestService->getAddressRequestByUserId(Auth()->user()->id)->paginate(10)
                    ])->render()
                ]
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $data = $this->addressRequestService->destroy($request->id);
        if ($data) {
            return response()->json([
                'success' => 'Address Request Deleted Successfully',
                'data' => view('employee.address_request.list', [
                    'allAddressRequest' => $this->addressRequestService->getAddressRequestByUserId(Auth()->user()->id)->paginate(10)
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function serachFilterList(Request $request)
    {
        $allAddressRequest = $this->addressRequestService->getFilteredRequestDetails($request->all());
        if ($allAddressRequest) {
            return response()->json([
                'success' => 'Searching',
                'data' => view('employee.address_request.list', compact('allAddressRequest'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
