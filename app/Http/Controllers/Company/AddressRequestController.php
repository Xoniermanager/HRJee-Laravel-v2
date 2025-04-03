<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Services\AddressRequestService;
use Illuminate\Http\Request;

class AddressRequestController extends Controller
{
    protected $addressRequestService;

    public function __construct(AddressRequestService $addressRequestService)
    {
        $this->addressRequestService = $addressRequestService;
    }
    public function index()
    {
        $allAddressRequest = $this->addressRequestService->getAddressRequestByCompanyId(Auth()->user()->company_id)->orderBy('id')->paginate(10);
        return view('company.address_request.index', compact('allAddressRequest'));
    }

    public function statusUpdate(Request $request)
    {
        $allAddressRequest = $this->addressRequestService->updateStatus($request->all());
        if ($allAddressRequest) {
            return response()->json([
                'status' => true,
                'message' => "Address Request Status Updated Successfully",
                'data' => view('company.address_request.list', [
                    'allAddressRequest' => $this->addressRequestService->getAddressRequestByCompanyId(Auth()->user()->company_id)->paginate(10)
                ])->render()
            ]);
        } else {
            return response()->json(['status' => false, 'message' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function serachFilterList(Request $request)
    {
        $allAddressRequest = $this->addressRequestService->getFilteredRequestDetails($request->all());
        if ($allAddressRequest) {
            return response()->json([
                'success' => 'Searching',
                'data' => view('company.address_request.list', compact('allAddressRequest'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
