<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResignationStatusRequest;
use App\Http\Services\ResignationStatusService;
use Exception;
use Illuminate\Http\Request;

class ResignationStatusController extends Controller
{
    private $resignationStatusService;
    public function __construct(ResignationStatusService $resignationStatusService)
    {
        $this->resignationStatusService = $resignationStatusService;
    }

    public function index()
    {
        $AllResignationStatus = $this->resignationStatusService->all();
        return view('company.resignation_status.index', compact('AllResignationStatus'));
    }

    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->resignationStatusService->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Resignation Status Updated Successfully',
                'data'    =>  view('company.resignation_status.resignation-status-list', [
                    'AllResignationStatus' => $this->resignationStatusService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function store(ResignationStatusRequest $request)
    {
        try {
            $resignationStatus = $this->resignationStatusService->create($request->all());
            if ($resignationStatus) {
                return response()->json(
                    [
                        'message' => 'Created Successfully!',
                        'data'   =>  view('company.resignation_status.resignation-status-list', [
                            'AllResignationStatus' => $this->resignationStatusService->all()
                        ])->render()
                    ]
                );
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function update(ResignationStatusRequest $request)
    {
        try {



            $updateData = $request->except(['_token', 'id']);
            $companyBranches = $this->resignationStatusService->updateDetails($updateData, $request->id);
            if ($companyBranches) {
                return response()->json(
                    [
                        'message' => 'Updated Successfully!',
                        'data'    =>  view(
                            'company.resignation_status.resignation-status-list',
                            ['AllResignationStatus' => $this->resignationStatusService->all()]
                        )->render()
                    ]
                );
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->resignationStatusService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Status Deleted Successfully',
                'data'    =>  view('company.resignation_status.resignation-status-list', [
                    'AllResignationStatus' => $this->resignationStatusService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }


    public function searchResignationStatusFilter(Request $request)
    {
        $AllResignationStatus = $this->resignationStatusService->searchInResignationStatus($request);
        if ($AllResignationStatus) {
            return response()->json([
                'success' => 'Searching',
                'data'    =>  view('company.resignation_status.resignation-status-list', compact('AllResignationStatus'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
