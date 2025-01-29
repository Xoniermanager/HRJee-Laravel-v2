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
        $allNewsCategoryDetails = $this->newsCategoryService->getAllActiveNewsCategoryByCompanyID(Auth()->user()->id);
        $allCompanyBranchesDetails = $this->companyBranchService->getAllCompanyBranchByCompanyId(Auth()->user()->id);
        $allDepartmentsDetails = $this->departmentService->getAllActiveDepartmentsByCompanyId(Auth()->user()->id);
        return view('company.news.index', compact('allNewsDetails', 'allNewsCategoryDetails', 'allCompanyBranchesDetails', 'allDepartmentsDetails'));
    }

    public function add()
    {
        $allCompanyBranchesDetails = $this->companyBranchService->getAllCompanyBranchByCompanyId(Auth()->user()->id);
        $allDepartmentsDetails = $this->departmentService->getAllActiveDepartmentsByCompanyId(Auth()->user()->id);
        $allNewsCategoryDetails = $this->newsCategoryService->getAllActiveNewsCategoryByCompanyID(Auth()->user()->id);
        return view('company.news.add', compact('allCompanyBranchesDetails', 'allDepartmentsDetails', 'allNewsCategoryDetails'));
    }
    public function store(NewsStoreRequest $request)
    {

        try {
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
        $allCompanyBranchesDetails = $this->companyBranchService->getAllCompanyBranchByCompanyId(Auth()->user()->id);
        $allDepartmentsDetails = $this->departmentService->getAllActiveDepartmentsByCompanyId(Auth()->user()->id);
        $allNewsCategoryDetails = $this->newsCategoryService->getAllActiveNewsCategoryByCompanyID(Auth()->user()->id);
        return view('company.news.edit', compact('editNewsDetails', 'allCompanyBranchesDetails', 'allDepartmentsDetails', 'allNewsCategoryDetails'));
    }
    public function view($id)
    {
        $viewNewsDetails = $this->newsService->findByNewsId($id);
        return view('company.news.view', compact('viewNewsDetails'));
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
                'data' => view('company.news.list', [
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
    public function serachNewsFilterList(Request $request)
    {
        $allPolicyDetails = $this->newsService->serachNewsFilterList($request);
        if ($allPolicyDetails) {
            return response()->json([
                'success' => 'Searching',
                'data' => view('company.news.list', [
                    'allNewsDetails' => $allPolicyDetails
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
