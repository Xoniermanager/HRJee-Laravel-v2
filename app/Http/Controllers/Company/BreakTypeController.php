<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\BreakTypeService;
use Illuminate\Support\Facades\Validator;

class BreakTypeController extends Controller
{
    private $breakTypeService;
    public function __construct(BreakTypeService $breakTypeService)
    {
        $this->breakTypeService = $breakTypeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.break_type.index', [
            'allBreakTypeDetails' => $this->breakTypeService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateCompanyStatus  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:break_types,name'],
                'description' => ['required', 'string']
            ]);

            if ($validateCompanyStatus->fails()) {
                return response()->json(['error' => $validateCompanyStatus->messages()], 400);
            }
            $data = $request->all();
            if ($this->breakTypeService->create($data)) {
                return response()->json([
                    'message' => 'Break Type Created Successfully!',
                    'data'   =>  view('company.break_type.break_type_list', [
                        'allBreakTypeDetails' => $this->breakTypeService->all()
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
            'name' => ['required', 'string', 'unique:break_types,name,' . $request->id],
            'description' => ['required', 'string']
        ]);

        if ($validateCompanyStatus->fails()) {
            return response()->json(['error' => $validateCompanyStatus->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->breakTypeService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json([
                'message' => 'Break Type Updated Successfully!',
                'data'   =>  view('company.break_type.break_type_list', [
                    'allBreakTypeDetails' => $this->breakTypeService->all()
                ])->render()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = $this->breakTypeService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Break Type Deleted Successfully!',
                'data'   =>  view('company.break_type.break_type_list', [
                    'allBreakTypeDetails' => $this->breakTypeService->all()
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
        $statusDetails = $this->breakTypeService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function serachBreakTypeFilterList(Request $request)
    {
        $allBreakTypeDetails = $this->breakTypeService->serachBreakTypeStatusFilterList($request);
        if ($allBreakTypeDetails) {
            return response()->json([
                'success' => 'Searching',
                'data'   =>  view("company.break_type.break_type_list", compact('allBreakTypeDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
