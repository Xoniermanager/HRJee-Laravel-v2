<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CompanyStatusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class CompanyStatusController extends Controller
{
    private $companyStatusService;
    public function __construct(CompanyStatusService $companyStatusService)
    {
        $this->companyStatusService = $companyStatusService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.company_status.index', [
            'allCompanyStatusDetails' => $this->companyStatusService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateCompanyStatus  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:company_statuses,name'],
                'description' => ['required', 'string']
            ]);

            if ($validateCompanyStatus->fails()) {
                return response()->json(['error' => $validateCompanyStatus->messages()], 400);
            }
            $data = $request->all();
            if ($this->companyStatusService->create($data)) {
                return response()->json([
                    'message' => 'Company Status Created Successfully!',
                    'data'   =>  view('admin.company_status.company_status_list', [
                        'allCompanyStatusDetails' => $this->companyStatusService->all()
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
        $validateCompanyStatus  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:company_statuses,name,' . $request->id],
            'description' => ['required', 'string']
        ]);

        if ($validateCompanyStatus->fails()) {
            return response()->json(['error' => $validateCompanyStatus->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->companyStatusService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json([
                'message' => 'Company Status Updated Successfully!',
                'data'   =>  view('admin.company_status.company_status_list', [
                    'allCompanyStatusDetails' => $this->companyStatusService->all()
                ])->render()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->companyStatusService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Company Status Deleted Successfully!',
                'data'   =>  view('admin.company_status.company_status_list', [
                    'allCompanyStatusDetails' => $this->companyStatusService->all()
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
        $statusDetails = $this->companyStatusService->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'message' => 'Company Status Updated Successfully!',
                'data'   =>  view('admin.company_status.company_status_list', [
                    'allCompanyStatusDetails' => $this->companyStatusService->all()
                ])->render()
            ]);
        }
    }
}
