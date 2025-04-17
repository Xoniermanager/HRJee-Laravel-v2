<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\SubscriptionPlanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class SubscriptionPlanController extends Controller
{

    private $subscriptionPlanService;
    public function __construct(SubscriptionPlanService $subscriptionPlanService)
    {
        $this->subscriptionPlanService = $subscriptionPlanService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.subscription_plan.index', [
            'allSubscriptionPlanDetails' => $this->subscriptionPlanService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateCountryData  = Validator::make($request->all(), [
                'title' => ['required', 'string'],
                'days' => ['required', 'string'],
            ]);
            if ($validateCountryData->fails()) {
                return response()->json(['error' => $validateCountryData->messages()], 400);
            }
            $data = $request->except('_token');
            if ($this->subscriptionPlanService->create($data)) {
                return response()->json([
                    'message' => 'Subscription Plan Created Successfully!',
                    'data'   =>  view('admin.subscription_plan.list', [
                        'allSubscriptionPlanDetails' => $this->subscriptionPlanService->all()
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
            'title' => ['required', 'string'],
            'days' => ['required', 'string'],
        ]);
        if ($validateCountryData->fails()) {
            return response()->json(['error' => $validateCountryData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->subscriptionPlanService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(
                [
                    'message' => 'Subscription Plan Updated Successfully!',
                    'data'   =>  view('admin.subscription_plan.list', [
                        'allSubscriptionPlanDetails' => $this->subscriptionPlanService->all()
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
        $data = $this->subscriptionPlanService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Country Deleted Successfully',
                'data'   =>  view('admin.subscription_plan.list', [
                    'allSubscriptionPlanDetails' => $this->subscriptionPlanService->all()
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
        $statusDetails = $this->subscriptionPlanService->updateDetails($data, $id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Subscription Plan Status Updated Successfully',
                'data'   =>  view("admin.subscription_plan.list", [
                    'allSubscriptionPlanDetails' => $this->subscriptionPlanService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function search(Request $request)
    {
        $searchedItems = $this->subscriptionPlanService->serachFilterList($request);
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching...',
                'data'   =>  view("admin.subscription_plan.list", [
                    'allSubscriptionPlanDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
