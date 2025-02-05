<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\SalaryService;
use App\Http\Requests\SalaryStoreRequest;
use Illuminate\Support\Facades\Validator;

class SalaryController extends Controller
{
    private $salaryService;

    public function __construct(SalaryService $salaryService)
    {
        $this->salaryService = $salaryService;
    }

    /**
     * Lists all salaries
     */
    public function index()
    {
        $allSalaryDetails = $this->salaryService->getAllSalariesByCompanyId(Auth()->user()->company_id)->paginate(10);
        return view('company.salary.index', compact('allSalaryDetails'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(SalaryStoreRequest $request)
    {
        try {
            $data = $request->all();
            $data['company_id'] = auth()->user()->company_id;
            $data['created_by'] = auth()->user()->id;
            if ($this->salaryService->create($data)) {
                $allSalaryDetails = $this->salaryService->getAllSalariesByCompanyId(Auth()->user()->company_id)->paginate(10);
                return response()->json([
                    'message' => 'Salary Created Successfully!',
                    'data' => view("company.salary.list", compact('allSalaryDetails'))->render()
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
        $validateDepartments = Validator::make($request->all(), [
            'name' => ['required', 'string','unique:salaries,name,' . $request->id . ',id,company_id,' . auth()->user()->company_id],
            'description' => 'nullable|sometimes|max:255'
        ]);

        if ($validateDepartments->fails()) {
            return response()->json(['error' => $validateDepartments->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->salaryService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            $allSalaryDetails = $this->salaryService->getAllSalariesByCompanyId(Auth()->user()->company_id)->paginate(10);
            return response()->json([
                'message' => 'Salary Updated Successfully!',
                'data' => view("company.salary.list", compact('allSalaryDetails'))->render()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = $this->salaryService->deleteDetails($id);
        if ($data) {
            $allSalaryDetails = $this->salaryService->getAllSalariesByCompanyId(Auth()->user()->company_id)->paginate(10);
            return response()->json([
                'message' => 'Salary Deleted Successfully!',
                'data' => view("company.salary.list", compact('allSalaryDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->salaryService->updateDetails($data, $id);
        if ($statusDetails) {
            $allSalaryDetails = $this->salaryService->getAllSalariesByCompanyId(Auth()->user()->company_id)->paginate(10);
            return response()->json([
                'message' => 'Salary Created Successfully!',
                'data' => view("company.salary.list", compact('allSalaryDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    public function serachSalaryFilterList(Request $request)
    {
        $searchedItems = $this->salaryService->serachSalaryFilterList($request, auth()->user()->company_id);
        if ($searchedItems) {
            return response()->json([
                'success' => 'Searching',
                'data' => view("company.salary.list", [
                    'allSalaryDetails' => $searchedItems
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
