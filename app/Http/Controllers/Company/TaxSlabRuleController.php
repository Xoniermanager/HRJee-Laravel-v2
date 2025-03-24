<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\TaxSlabRuleService;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TaxSlabStoreRequest;
use App\Http\Requests\TaxSlabUpdateRequest;

class TaxSlabRuleController extends Controller
{


    private $taxSlabRuleService;
    public function __construct(TaxSlabRuleService $taxSlabRuleService)
    {

        $this->taxSlabRuleService = $taxSlabRuleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.taxslab.index', [
            'allTaxRateDetails' => $this->taxSlabRuleService->all(Auth()->user()->company_id)->paginate(10),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaxSlabStoreRequest $request)
    {
        try {
            $request['company_id'] = Auth()->user()->company_id;
            $request['created_by'] = Auth()->user()->id;
            if ($this->taxSlabRuleService->create($request->all())) {
                return response()->json([
                    'message' => 'TaxSlab Rule Created Successfully!',
                    'data'   =>  view('company.taxslab.list', [
                        'allTaxRateDetails' => $this->taxSlabRuleService->all(Auth()->user()->company_id)->paginate(10)
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
    public function update(TaxSlabUpdateRequest $request)
    {
        $updateDetails = $this->taxSlabRuleService->updateDetails($request->except(['_token', 'id']), $request->id);
        if ($updateDetails) {
            return response()->json(
                [
                    'message' => 'TaxSlab Rule Updated Successfully!',
                    'data'   =>  view('company.taxslab.list', [
                        'allTaxRateDetails' => $this->taxSlabRuleService->all(Auth()->user()->company_id)->paginate(10)
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
        $data = $this->taxSlabRuleService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'TaxSlab Deleted Successfully',
                'data'   =>  view('company.taxslab.list', [
                    'allTaxRateDetails' => $this->taxSlabRuleService->all(Auth()->user()->company_id)->paginate(10)
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
        $statusDetails = $this->taxSlabRuleService->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'TaxSlab Status Updated Successfully',
                'data'   =>  view('company.taxslab.list', [
                    'allTaxRateDetails' => $this->taxSlabRuleService->all(Auth()->user()->company_id)->paginate(10)
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function serachTaxSlabFilterList(Request $request)
    {
        $searchedItems = $this->taxSlabRuleService->serachTaxSlabFilterList($request);
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching...',
                'data'   =>  view("company.taxslab.list", [
                    'allTaxRateDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
