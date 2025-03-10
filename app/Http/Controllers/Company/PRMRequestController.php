<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Services\PrmRequestService;
use Illuminate\Http\Request;

class PRMRequestController extends Controller
{
    //
    private $prmRequestService;
    public function __construct(PrmRequestService $prmRequestService)
    {
        $this->prmRequestService = $prmRequestService;
    }

    public function index(){
        //dd( $this->prmRequestService->getAllRequest(auth()->user()->company_id));
        return view('company.prm_request.index', [
            'allPRMRequestDetails' => $this->prmRequestService->getAllRequest(auth()->user()->company_id)
        ]);
    }
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->prmRequestService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }
    public function searchPrmRequestFilterList(){
        $allPRMRequestDetails = $this->prmRequestService->searchPRMRequestFilterList($request);
        if ($allPRMRequestDetails) {
            return response()->json([
                'success' => 'Searching',
                'data'   =>  view("company.prm_request.prm_request_list", compact('allPRMRequestDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
