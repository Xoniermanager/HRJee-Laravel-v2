<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\IncentivePaymentService;

class IncentivePaymentController extends Controller
{
    private $incentivePaymentService;
    public function __construct(IncentivePaymentService $incentivePaymentService)
    {

        $this->incentivePaymentService = $incentivePaymentService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyIDs = getCompanyIDs();

        return view("company.incentive_payments.index", [
            'allConnectorDetails' => $this->incentivePaymentService->getConnector($companyIDs),
            'allIncentivePaymentDetails' => $this->incentivePaymentService->all($companyIDs)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $companyIDs = auth()->user()->company_id;
            $data = $request->all();
            $data['company_id'] = $companyIDs;
            $data['created_by'] = auth()->user()->id;

            $this->incentivePaymentService->create($data);
            return response()->json([
                'success' => 'Incentive added Successfully',
                'data' => view("company.incentive_payments.list", [
                    'allIncentivePaymentDetails' => $this->incentivePaymentService->all($companyIDs)
                ])->render()
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $companyIDs = auth()->user()->company_id;
        $updateData = $request->except(['_token', 'id']);
        $incentiveUpdate = $this->incentivePaymentService->updateDetails($updateData, $request->id);
        if ($incentiveUpdate) {
            return response()->json([
                'success' => 'Incentive updated Successfully',
                'data' => view("company.incentive_payments.list", [
                    'allIncentivePaymentDetails' => $this->incentivePaymentService->all($companyIDs)
                ])->render()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $companyIDs = getCompanyIDs();
        $id = $request->id;
        $data = $this->incentivePaymentService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Incentive Payment Deleted Successfully',
                'data' => view("company.incentive_payments.list", [
                    'allIncentivePaymentDetails' => $this->incentivePaymentService->all($companyIDs)
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
