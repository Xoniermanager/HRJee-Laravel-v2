<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\PerformanceCycleService;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\UserService;
use Illuminate\Validation\Rule;


class PerformanceReviewCycleController extends Controller
{

    private $performanceCycleService;
    public $userService;

    public function __construct(UserService $userService, PerformanceCycleService $performanceCycleService)
    {
        $this->performanceCycleService = $performanceCycleService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyIDs = getCompanyIDs();
        
        return view('company.performance_cycle.index', [
            'performanceCategories' => $this->performanceCycleService->all($companyIDs),
            'allEmployeeDetails' => $this->userService->getActiveEmployees($companyIDs)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'title' => [
                    'required',
                    'string',
                    Rule::unique('performance_review_cycles')->where(function ($query) use ($request) {
                        return $query->where('company_id', auth()->user()->company_id);
                    }),
                ],
            ]);

            if ($validateData->fails()) {

                return response()->json(['error' => $validateData->messages()], 400);
            }
            $data = $request->all();
            $dates = explode(' - ', $data['daterange']);

            $data['company_id'] = auth()->user()->id;
            $data['start_date'] = $dates[0];
            $data['end_date'] = $dates[1];
            if ($this->performanceCycleService->create($data)) {

                return response()->json([
                    'message' => 'Cycle Created Successfully!',
                    'data'   =>  view('company.performance_cycle.list', [
                        'performanceCategories' => $this->performanceCycleService->all([auth()->user()->id])
                    ])->render()
                ]);
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }

    public function edit($id)
    {
        try {
            $cycle = $this->performanceCycleService->getCycle($id); 

            $cycle->employee_ids = $cycle->userList();

            return response()->json([
                'status' => true,
                'data' => $cycle
            ]);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'error' => $e->getMessage()], 400);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'title' => [
                'required',
                'string',
                Rule::unique('performance_review_cycles')->where(function ($query) use ($request) {
                    return $query->where('company_id', auth()->user()->company_id);
                }),
            ],
        ]);

        if ($validateData->fails()) {

            return response()->json(['error' => $validateData->messages()], 400);
        }

        $updateData = $request->except(['_token', 'id']);
        $dates = explode(' - ', $updateData['daterange']);

           
        $updateData['start_date'] = $dates[0];
        $updateData['end_date'] = $dates[1];
        $companyStatus = $this->performanceCycleService->updateDetails($updateData, $request->id);

        if ($companyStatus) {

            return response()->json(
                [
                    'message' => 'Cycle Updated Successfully!',
                    'data'   =>  view('company.performance_cycle.list', [
                        'performanceCategories' => $this->performanceCycleService->all([auth()->user()->id])
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
        $data = $this->performanceCycleService->deleteDetails($id);
        if ($data) {

            return response()->json([
                'success' => 'Cycle Deleted Successfully',
                'data'   =>  view('company.performance_cycle.list', [
                    'performanceCategories' => $this->performanceCycleService->all([auth()->user()->id])
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
        $statusDetails = $this->performanceCycleService->updateDetails($data, $id);
        if ($statusDetails) {

            return response()->json([
                'success' => 'Status Updated Successfully',
                'data'   =>  view("company.performance_cycle.list", [
                    'performanceCategories' => $this->performanceCycleService->all([auth()->user()->id])
                ])->render()
            ]);
        } else {

            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function search(Request $request)
    {
        $searchedItems = $this->performanceCycleService->serachFilterList($request);
        if ($searchedItems) {

            return response()->json([
                'success' => 'Searching...',
                'data'   =>  view("company.performance_cycle.list", [
                    'performanceCategories' => $searchedItems
                ])->render()
            ]);
        } else {

            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
