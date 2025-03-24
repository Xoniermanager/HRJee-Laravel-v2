<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\NewsCategoryService;

class NewsCategoryController extends Controller
{
    private $newsCategoryService;
    public function __construct(NewsCategoryService $newsCategoryService)
    {
        $this->newsCategoryService = $newsCategoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.news_category.index', [
            'allNewsCategoryDetails' => $this->newsCategoryService->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateData  = Validator::make($request->all(), [
                'name' => ['required', 'string', 'unique:news_categories,name,NULL,id,company_id,' . auth()->user()->company_id],
            ]);

            if ($validateData->fails()) {
                return response()->json(['error' => $validateData->messages()], 400);
            }
            $data = $request->all();
            $payload = $request->except(['_token']);
            if ($this->newsCategoryService->create($payload)) {
                return response()->json([
                    'message' => 'News Category Created Successfully!',
                    'data'   =>  view('company.news_category.news_category_list', [
                        'allNewsCategoryDetails' => $this->newsCategoryService->all()
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
        $validateData  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:news_categories,name,' . $request->id . ',id,company_id,' . auth()->user()->company_id]
        ]);

        if ($validateData->fails()) {
            return response()->json(['error' => $validateData->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->newsCategoryService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json([
                'message' => 'News Category Updated Successfully!',
                'data'   =>  view('company.news_category.news_category_list', [
                    'allNewsCategoryDetails' => $this->newsCategoryService->all()
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
        $data = $this->newsCategoryService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'News Category Deleted Successfully!',
                'data'   =>  view('company.news_category.news_category_list', [
                    'allNewsCategoryDetails' => $this->newsCategoryService->all()
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
        $statusDetails = $this->newsCategoryService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function serachNewsCategoryFilterList(Request $request)
    {
        $allNewsCategoryDetails = $this->newsCategoryService->serachNewsCategoryFilterList($request);
        if ($allNewsCategoryDetails) {
            return response()->json([
                'success' => 'Searching',
                'data'   =>  view("company.news_category.news_category_list", compact('allNewsCategoryDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
