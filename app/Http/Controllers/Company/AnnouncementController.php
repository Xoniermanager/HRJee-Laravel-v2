<?php

namespace App\Http\Controllers\Company;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\BranchServices;
use App\Http\Services\DepartmentServices;
use App\Http\Services\AnnouncementServices;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\AnnouncementStoreRequest;
use App\Http\Services\EmployeeServices;

class AnnouncementController extends Controller
{
    private $companyBranchService;
    private $departmentServices;
    private $announcementService;
    private $employeeServices;
    public function __construct(BranchServices $companyBranchService, DepartmentServices $departmentServices, AnnouncementServices $announcementService, EmployeeServices $employeeServices)
    {
        $this->departmentServices = $departmentServices;
        $this->companyBranchService = $companyBranchService;
        $this->announcementService = $announcementService;
        $this->employeeServices = $employeeServices;
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {
        $allAnnouncementDetails = $this->announcementService->all();
        $allCompanyBranchesDetails = $this->companyBranchService->getAllCompanyBranchByCompanyId(Auth()->user()->id);
        $allDepartmentsDetails = $this->departmentServices->getAllActiveDepartmentsByCompanyId(Auth()->user()->id);
        return view('company.announcements.index', compact('allAnnouncementDetails', 'allCompanyBranchesDetails', 'allDepartmentsDetails'));
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function getAllUserByBranchIds(Request $request)
    {
        $companyBranchIds = $request->company_branch_id;
        $departmentIds = $request->department_ids;
        $designationIds = $request->designation_ids;
        $allCompanyBranches = $request->all_company_branch;
        $allDepartment = $request->all_department;
        $allDesignation = $request->all_designation;
        $allUserDetails = $this->employeeServices->getAllUserByCompanyBranchIdsAndDepartmentIdsAndDesignationIds($companyBranchIds, $departmentIds, $designationIds, $allCompanyBranches, $allDepartment, $allDesignation);
        return response()->json(['status' => true, 'allUserDetails' => $allUserDetails]);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function add()
    {
        $allCompanyBranchesDetails = $this->companyBranchService->getAllCompanyBranchByCompanyId(Auth()->user()->id);
        $allDepartmentsDetails = $this->departmentServices->getAllActiveDepartmentsByCompanyId(Auth()->user()->id);
        return view('company.announcements.create', compact('allCompanyBranchesDetails', 'allDepartmentsDetails'));
    }

    /**
     * Undocumented function
     *
     * @param AnnouncementStoreRequest $request
     * @return void
     */
    public function store(AnnouncementStoreRequest $request)
    {
        try {
            $data = $request->all();
            if ($this->announcementService->create($data)) {
                return redirect(route('announcement.index'))->with('success', 'Added successfully');
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function edit($id)
    {
        $allCompanyBranchesDetails = $this->companyBranchService->getAllCompanyBranchByCompanyId(Auth()->user()->id);
        $allDepartmentsDetails = $this->departmentServices->getAllActiveDepartmentsByCompanyId(Auth()->user()->id);
        $editAnnouncementDetails = $this->announcementService->findById($id);
        return view('company.announcements.edit', compact('allCompanyBranchesDetails', 'allDepartmentsDetails', 'editAnnouncementDetails'));
    }

    /**
     * Undocumented function
     *
     * @param AnnouncementStoreRequest $request
     * @param [type] $id
     * @return void
     */
    public function update(AnnouncementStoreRequest $request, $id)
    {
        try {
            $data = $request->all();
            if ($this->announcementService->updateDetails($data, $id)) {
                return redirect(route('announcement.index'))->with('success', 'Updated successfully');
            }
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function view($id)
    {
        $viewAnnouncementDetails = $this->announcementService->findById($id);
        return view('company.announcements.view', compact('viewAnnouncementDetails'));
    }
    
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id)
    {
        $data = $this->announcementService->deleteDetails($id);
        if ($data) {
            return response()->json([
                'success' => 'Annoucement Deleted Successfully',
                'data' => view('company.announcements.list', [
                    'allAnnouncementDetails' => $this->announcementService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $statusDetails = $this->announcementService->updateStatus($id, $request->status);
        if ($statusDetails) {
            return response()->json([
                'success' => 'Annoucement Updated Successfully',
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function serachAnnouncementFilterList(Request $request)
    {
        $allAnnouncementDetails = $this->announcementService->serachAnnouncementFilterList($request);
        if ($allAnnouncementDetails) {
            return response()->json([
                'success' => 'Searching',
                'data' => view('company.announcements.list', compact('allAnnouncementDetails'))->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function updateAssignAnnounce(Request $request)
    {
        $data = $request->except('id');
        $allAnnouncementDetails = $this->announcementService->updateDetails($data, $request->id);
        if ($allAnnouncementDetails) {
            return response()->json([
                'message' => 'Assigned Announcement Updated Successfully',
                'data' => view('company.announcements.list', [
                    'allAnnouncementDetails' => $this->announcementService->all()
                ])->render()
            ]);
        } else {
            return response()->json(['error' => 'Something Went Wrong!! Please try again']);
        }
    }
}
