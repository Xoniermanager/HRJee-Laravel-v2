<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Rules\UniqueForAdminOnly;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\QualificationService;

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
        return view('admin.qualification.index', [
            'allQualificationDetails' => $this->qualificationService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateCompanyStatus = Validator::make($request->all(), [
                'name' => ['required', 'string', new UniqueForAdminOnly('qualifications')],
                'description' => ['string']
            ]);

            if ($validateCompanyStatus->fails()) {
                return response()->json(['error' => $validateCompanyStatus->messages()], 400);
                // return redirect(route('company-status.index'))->withErrors();
            }
            $data = $request->all();
            if ($this->qualificationService->create($data)) {
                return response()->json([
                    'message' => 'Qualification Created Successfully!',
                    'data' => view('admin.qualification.qualification_list', [
                        'allQualificationDetails' => $this->qualificationService->all()
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
        $validateCompanyStatus = Validator::make($request->all(), [
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
                'message' => 'Qualification Updated Successfully!',
                'data' => view('admin.qualification.qualification_list', [
                    'allQualificationDetails' => $this->qualificationService->all()
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
        $data = $this->qualificationService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Qualification Deleted Successfully! ',
                'data' => view('admin.qualification.qualification_list', [
                    'allQualificationDetails' => $this->qualificationService->all()
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
        $statusDetails = $this->qualificationService->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Qualification Status Updated Successfully! ',
                'data' => view('admin.qualification.qualification_list', [
                    'allQualificationDetails' => $this->qualificationService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error', 'Something Went Wrong! Pleaase try Again']);
        }
    }

    public function search(Request $request)
    {
        $searchedItems = $this->qualificationService->searchInQualification($request->all());
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching...',
                'data' => view('admin.qualification.qualification_list', [
                    'allQualificationDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }


    public function get_all_qualification_ajax_call()
    {

        $data = $this->qualificationService->get_qualification_ajax_call();
        return json_encode($data);
    }
    public function ajax_store_qualification(Request $request)
    {
        try {
            $dataTest = $request->all()['models'];
            $data = collect(json_decode($dataTest, true))->first();
            $data['company_id'] = isset(Auth()->user()->company_id) ? Auth()->user()->company_id : '';
            $validateQualification = Validator::make($data, [
                'name' => ['required', 'string', new UniqueForAdminOnly('qualifications')],
                'description' => ['string']
            ]);

            if ($validateQualification->fails()) {
                return response()->json(['error' => $validateQualification->messages()], 400);
            }

            if ($this->qualificationService->create($data)) {
                return $this->qualificationService->get_qualification_ajax_call();
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()()], 400);
        }
    }

}
