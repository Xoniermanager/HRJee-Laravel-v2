<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Services\DispositionCodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use DateTimeZone;

class DispositionCodeController extends Controller
{

    private $dispositionCodeService;
    public function __construct(dispositionCodeService $dispositionCodeService)
    {
        $this->dispositionCodeService = $dispositionCodeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.disposition_code.index', [
            'allDispositionCodeDetails' => $this->dispositionCodeService->all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateCountryData  = Validator::make($request->all(), [
                'name' => 'required|string|unique:disposition_codes,name',
                'description' => 'sometimes|nullable',
            ]);
            if ($validateCountryData->fails()) {
                return response()->json(['error' => $validateCountryData->messages()], 400);
            }
            $data = $request->all();
            if ($this->dispositionCodeService->create($data)) {
                return response()->json([
                    'message' => 'Disposition Code Created Successfully!',
                    'data'   =>  view('company.disposition_code.list', [
                        'allDispositionCodeDetails' => $this->dispositionCodeService->all()
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validateCountryData  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:disposition_codes,name,' . $request->id],
            'description' => 'sometimes|nullable',
        ]);

        if ($validateCountryData->fails()) {
            return response()->json(['error' => $validateCountryData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->dispositionCodeService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(
                [
                    'message' => 'Disposition Code Updated Successfully!',
                    'data'   =>  view('company.disposition_code.list', [
                        'allDispositionCodeDetails' => $this->dispositionCodeService->all()
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
        $id = $request->id;
        $data = $this->dispositionCodeService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Disposition Code Deleted Successfully',
                'data'   =>  view('company.disposition_code.list', [
                    'allDispositionCodeDetails' => $this->dispositionCodeService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->dispositionCodeService->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Disposition Code Status Updated Successfully',
                'data'   =>  view("company.disposition_code.list", [
                    'allDispositionCodeDetails' => $this->dispositionCodeService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function serachFilterList(Request $request)
    {
        $allDispositionCodeDetails = $this->dispositionCodeService->serachFilterList($request->all());
        if ($allDispositionCodeDetails) {
            return response()->json([
                'success' => 'Searching',
                'data'    =>  view('company.disposition_code.list', compact('allDispositionCodeDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
