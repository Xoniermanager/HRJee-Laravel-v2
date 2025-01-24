<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\BranchServices;
use App\Http\Services\HolidayServices;
use Illuminate\Support\Facades\Validator;

class HolidayController extends Controller
{
    private $holidayService;
    private $branchService;
    public function __construct(HolidayServices $holidayService, BranchServices $branchService)
    {
        $this->holidayService = $holidayService;
        $this->branchService = $branchService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.holiday.index', [
            'allHolidaysDetails' => $this->holidayService->all(),
            'allCompanyBranchesDetails' => $this->branchService->getAllCompanyBranchByCompanyId(Auth()->guard('company')->user()->company_id)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateHolidayData  = Validator::make($request->all(), [
                'name' => 'required|string|unique:holidays,name,',
                'date' => 'required|date',
                'year' => 'required',
                'company_branch_id'    =>   'required|array',
                'company_branch_id.*'  =>   'required',
            ]);
            if ($validateHolidayData->fails()) {
                return response()->json(['error' => $validateHolidayData->messages()], 400);
            }
            $data = $request->all();
            if ($this->holidayService->create($data)) {
                return response()->json([
                    'message' => 'Holiday Created Successfully!',
                    'data'   =>  view('company.holiday.holiday_list', [
                        'allHolidaysDetails' => $this->holidayService->all()
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
        $validateHolidayData  = Validator::make($request->all(), [
            'name' => 'required|string|unique:holidays,name,' . $request->id,
            'date' => 'required|date',
            'year' => 'required',
            'company_branch_id'    =>   'required|array',
            'company_branch_id.*'  =>   'required',
        ]);

        if ($validateHolidayData->fails()) {
            return response()->json(['error' => $validateHolidayData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->holidayService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(
                [
                    'message' => 'Holiday Updated Successfully!',
                    'data'   =>  view('company.holiday.holiday_list', [
                        'allHolidaysDetails' => $this->holidayService->all()
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
        $data = $this->holidayService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Holiday Deleted Successfully',
                'data'   =>  view('company.holiday.holiday_list', [
                    'allHolidaysDetails' => $this->holidayService->all()
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
        $statusDetails = $this->holidayService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function searchFilterData(Request $request)
    {
        $allHolidaysDetails = $this->holidayService->searchFilterData(Auth::guard('company')->user()->company_id, $request->all());
        return response()->json([
            'success' => true,
            'data'   =>  view('company.holiday.holiday_list', compact('allHolidaysDetails'))->render()
        ]);
    }
}
