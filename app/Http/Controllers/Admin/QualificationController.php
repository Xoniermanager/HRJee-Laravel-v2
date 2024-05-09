<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\QualificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Rules\UniqueForAdminOnly;

class QualificationController extends Controller
{
    private $qualificationService;
    public function __construct(QualificationService $qualificationService)
    {
        $this->qualificationService = $qualificationService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('super_admin.qualification.index', [
            'allQualificationDetails' => $this->qualificationService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateCompanyStatus  = Validator::make($request->all(), [
                'name' => ['required', 'string', new UniqueForAdminOnly('qualifications')],
                'description' => ['string']
            ]);

            if ($validateCompanyStatus->fails()) {
                return response()->json(['error' => $validateCompanyStatus->messages()], 400);
                // return redirect(route('company-status.index'))->withErrors();
            }
            $data = $request->all();
            if ($this->qualificationService->create($data)) {
                return response()->json(['message' => 'Company Qualification Created Successfully!']);
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
            'name' => ['required', 'string', 'unique:qualifications,name,' . $request->id],
            'description' => ['string']
        ]);

        if ($validateCompanyStatus->fails()) {
            return response()->json(['error' => $validateCompanyStatus->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->qualificationService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json([
                'message'   => 'Company Qualification Updated Successfully!',
                'data'      =>  view('super_admin.qualification.qualification-list',['allQualificationDetails' => $this->qualificationService->all()])->render()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = $this->qualificationService->deleteDetails($id);
        if ($data) {
            return back()->with('success', 'Deleted Successfully! ');
        } else {
            return back()->with('error', 'Something Went Wrong! Pleaase try Again');
        }
    }

    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status == 1 ? 0 : 1;
        $statusDetails = $this->qualificationService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
