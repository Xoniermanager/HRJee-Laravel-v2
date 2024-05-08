<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\CompanySizeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class CompanySizeController extends Controller
{
    private $companySizeService;
    public function __construct(CompanySizeService $companySizeService)
    {
        $this->companySizeService = $companySizeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('super_admin.company_size.index', [
            'allCompanySizesDetails' => $this->companySizeService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateCompanyStatus  = Validator::make($request->all(), [
                'company_size' => ['required', 'numeric', 'unique:company_sizes,company_size'],
                'description' => ['required', 'string']
            ]);

            if ($validateCompanyStatus->fails()) {
                return response()->json(['error' => $validateCompanyStatus->messages()], 400);
            }
            $data = $request->all();
            if ($this->companySizeService->create($data)) {
                return response()->json(['message' => 'Company Size Created Successfully!']);
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
        $validateCompanyStatus  = Validator::make($request->all(), [
            'company_size' => ['required', 'numeric', 'unique:company_sizes,company_size,' . $request->id],
            'description' => ['required', 'string']
        ]);

        if ($validateCompanyStatus->fails()) {
            return response()->json(['error' => $validateCompanyStatus->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->companySizeService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(['message' => 'Company Size Updated Successfully!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->companySizeService->deleteDetails($id);
        if ($data) {
            return back()->with('success', 'Deleted Successfully! ');
        } else {
            return back()->with('error', 'Something Went Wrong! Pleaase try Again');
        }
    }
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->companySizeService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
