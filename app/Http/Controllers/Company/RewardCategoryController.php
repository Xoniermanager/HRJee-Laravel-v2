<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\RewardCategoryService;
use Illuminate\Support\Facades\Validator;

class RewardCategoryController extends Controller
{
    private $rewardCategoryService;

    public function __construct(RewardCategoryService $rewardCategoryService)
    {
        $this->rewardCategoryService = $rewardCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("company.reward_category.index", [
            'allRewardCategoryDetails' => $this->rewardCategoryService->getRewardCategoryByCompanyId(Auth()->user()->company_id)->orderBy('id','DESC')->paginate(10)
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'name' => 'required',
                'description' => 'required'
            ]);
            if ($validateData->fails()) {
                return response()->json(['error' => $validateData->messages()], 400);
            }
            $data = $request->all();
            $data['company_id'] = auth()->user()->company_id;
            $data['created_by'] = auth()->user()->id;
            if ($this->rewardCategoryService->create($data)) {
                return response()->json([
                    'message' => 'Reward Category Created Successfully!',
                    'data' => view("company.reward_category.list", [
                        'allRewardCategoryDetails' => $this->rewardCategoryService->getRewardCategoryByCompanyId(Auth()->user()->company_id)->orderBy('id','DESC')->paginate(10)
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'name' => 'required','string',
            'description' => 'required'
        ]);

        if ($validateData->fails()) {
            return response()->json(['error' => $validateData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->rewardCategoryService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json(
                [
                    'message' => 'Reward Category Updated Successfully!',
                    'data' => view('company.reward_category.list', [
                        'allRewardCategoryDetails' => $this->rewardCategoryService->getRewardCategoryByCompanyId(Auth()->user()->company_id)->paginate(10)
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
        $data = $this->rewardCategoryService->deleteDetails($request->id);
        if ($data) {
            return response()->json([
                'success' => 'Reward Category Deleted Successfully',
                'data' => view("company.reward_category.list", [
                    'allRewardCategoryDetails' => $this->rewardCategoryService->getRewardCategoryByCompanyId(Auth()->user()->company_id)->orderBy('id','DESC')->paginate(10)
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function statusUpdate(Request $request)
    {
        $data['status'] = $request->status;
        $statusDetails = $this->rewardCategoryService->updateDetails($data, $request->id);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Reward Category Status Updated Successfully',
                'data' => view("company.reward_category.list", [
                    'allRewardCategoryDetails' => $this->rewardCategoryService->getRewardCategoryByCompanyId(Auth()->user()->company_id)->orderBy('id','DESC')->paginate(10)
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function serachFilterList(Request $request)
    {
        $searchedItems = $this->rewardCategoryService->serachFilterList($request->all(), auth()->user()->company_id);
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data' => view("company.reward_category.list", [
                    'allRewardCategoryDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
