<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\ComplainStatusService;

class ComplainStatusController extends Controller
{
    private $complainStatusService;
    public function __construct(ComplainStatusService $complainStatusService)
    {
        $this->complainStatusService = $complainStatusService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.complain_status.index', [
            'allComplainStatusDetails' => $this->complainStatusService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateData  = Validator::make($request->all(), [
                'name' => ['required', 'string'],
            ]);

            if ($validateData->fails()) {
                return response()->json(['error' => $validateData->messages()], 400);
            }
            $data = $request->all();
            if ($this->complainStatusService->create($data)) {
                return response()->json([
                    'message' => 'Complain Status Created Successfully!',
                    'data'   =>  view('company.complain_status.complain_status_list', [
                        'allComplainStatusDetails' => $this->complainStatusService->all()
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validateData  = Validator::make($request->all(), [
            'name' => ['required', 'string']
        ]);

        if ($validateData->fails()) {
            return response()->json(['error' => $validateData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->complainStatusService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json([
                'message' => 'Complain Status Updated Successfully!',
                'data'   =>  view('company.complain_status.complain_status_list', [
                    'allComplainStatusDetails' => $this->complainStatusService->all()
                ])->render()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = $this->complainStatusService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Complain Status Deleted Successfully!',
                'data'   =>  view('company.complain_status.complain_status_list', [
                    'allComplainStatusDetails' => $this->complainStatusService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error', 'Something Went Wrong! Pleaase try Again']);
        }
    }

    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->complainStatusService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function serachComplainStatusFilterList(Request $request)
    {
        $allComplainStatusDetails = $this->complainStatusService->serachComplainStatusFilterList($request);
        if ($allComplainStatusDetails) {
            return response()->json([
                'success' => 'Searching',
                'data'   =>  view("company.complain_status.complain_status_list", compact('allComplainStatusDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
