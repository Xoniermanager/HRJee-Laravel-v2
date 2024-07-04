<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsStoreRequest;
use App\Http\Services\BranchServices;
use App\Http\Services\DepartmentServices;
use App\Http\Services\DesignationServices;
use App\Http\Services\NewsCategoryService;
use App\Http\Services\NewsService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NewsController extends Controller
{
    public $companyBranchService;
    public $designationService;
    public $departmentService;
    public $newsCategoryService;
    public $newsService;
    public function __construct(BranchServices $companyBranchService, DesignationServices $designationService, DepartmentServices $departmentService, NewsCategoryService $newsCategoryService, NewsService $newsService)
    {
        $this->companyBranchService = $companyBranchService;
        $this->designationService = $designationService;
        $this->departmentService = $departmentService;
        $this->newsCategoryService = $newsCategoryService;
        $this->newsService = $newsService;
    }
    public function index()
    {
        $allNewsDetails = $this->newsService->all();
        return view('company.news.index', compact('allNewsDetails'));
    }

    public function add()
    {
        $allCompanyBranchesDetails = $this->companyBranchService->allActiveCompanyBranchesByUsingCompanyId(Auth()->guard('admin')->user()->company_id);
        $allDepartmentsDetails = $this->departmentService->getAllActiveDepartmentsUsingByCompanyID(Auth()->guard('admin')->user()->company_id);
        $allNewsCategoryDetails = $this->newsCategoryService->getAllActiveNewsCategoryUsingByCompanyID(Auth()->guard('admin')->user()->company_id);
        return view('company.news.add', compact('allCompanyBranchesDetails', 'allDepartmentsDetails', 'allNewsCategoryDetails'));
    }
    public function store(NewsStoreRequest $request)
    {
        try {
            $request->validate([
                'title'                => ['required'],
                'news_category_id'      => ['required', 'exists:news_categories,id'],
                'start_date'           => ['required', 'date'],
                'end_date'             => ['required', 'date'],
                'image'                => ['mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
                'company_branch_id'    => 'required|array', 'exists:company_branches,id',
                'department_id'        => 'required|array', 'exists:departments,id',
                'designation_id'       => 'required|array', 'exists:designations,id',
                'file'                 => 'nullable|mimes:pdf',
                'description'          => 'nullable',
            ]);
            $data = $request->all();
            if ($this->newsService->create($data)) {
                return redirect(route('news.index'))->with('success', 'Added successfully');
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function edit($id)
    {
        $editNewsDetails = $this->newsService->findByNewsId($id);
        $allCompanyBranchesDetails = $this->companyBranchService->allActiveCompanyBranchesByUsingCompanyId(Auth()->guard('admin')->user()->company_id);
        $allDepartmentsDetails = $this->departmentService->getAllActiveDepartmentsUsingByCompanyID(Auth()->guard('admin')->user()->company_id);
        $allNewsCategoryDetails = $this->newsCategoryService->getAllActiveNewsCategoryUsingByCompanyID(Auth()->guard('admin')->user()->company_id);
        return view('company.news.edit', compact('editNewsDetails', 'allCompanyBranchesDetails', 'allDepartmentsDetails', 'allNewsCategoryDetails'));
    }
    public function update(NewsStoreRequest $request, $id)
    {
        try {
            if ($this->newsService->updateDetails($request->all(), $id)) {
                return redirect(route('news.index'))->with('success', 'Updated successfully');
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = $this->newsService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'News Deleted Successfully',
                'data'   =>  view('company.news.list', [
                    'allNewsDetails' => $this->newsService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $statusDetails = $this->newsService->updateStatus($id, $request->status);
        if ($statusDetails) {
            return response()->json([
                'success' => 'News Updated Successfully',
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
