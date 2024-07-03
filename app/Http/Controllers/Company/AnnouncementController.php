<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddAnnouncementRequest;
use App\Http\Requests\AnnouncementAssignRequest;
use App\Http\Services\AnnouncementServices;
use App\Http\Services\BranchServices;
use App\Http\Services\CompanyUserService;
use App\Http\Services\DepartmentServices;
use App\Http\Services\DesignationServices;
use App\Http\Services\UserDetailServices;
use App\Jobs\AssignAnnouncement;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class AnnouncementController extends Controller
{
    private $branch_services;
    private $departmentServices;
    private $announcementService;
    private $userDetailServices;
    private $designationServices;
    private $companyUserService;
    public function __construct(AnnouncementServices $announcementService, BranchServices $branch_services, DepartmentServices $departmentServices, DesignationServices $designationServices, UserDetailServices $userDetailServices)
    {
        $this->announcementService = $announcementService;
        $this->departmentServices = $departmentServices;
        $this->designationServices = $designationServices;
        $this->userDetailServices = $userDetailServices;
        $this->branch_services = $branch_services;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.announcements.index', [
            'announcements' => $this->announcementService->all('paginate'),
            'branches' => $this->branch_services->allActiveBranches()
        ]);
    }

    public function getAnnouncement(Request $request)
    {
        $announcement = $this->announcementService->announcementDetails($request->id);
        $activeBranches = $this->branch_services->allActiveBranches();
        $ids = $activeBranches->pluck('id')->toArray();
        if (!empty($announcement->company_branch_id))
            $branchIds[] = $announcement->company_branch_id;
        else
            $branchIds = $ids;

        $branchUsers = $this->userDetailServices->getAllUsersByBranchId($branchIds);
        return view('company.announcements.assign_announcement', [
            'announcement' => $announcement,
            'announcements' => $this->announcementService->all(),
            'designations' =>  $this->designationServices->getDesignationsAdminOrCompany(),
            'departments' =>  $this->departmentServices->getDepartmentsByAdminAndCompany(),
            'branches' => $activeBranches,
            'branchUsers' => $branchUsers,
            'branch_id' => $branchIds
        ]);
    }
    public function getAnnouncementDetails(Request $request)
    {
        $announcement = $this->announcementService->announcementDetails($request->id);
        return response()->json(['status' => true, 'data' => $announcement]);
    }


    public function getAllUsersByBranchId(Request $request)
    {
        if (empty($request->ids))
            $ids =  [];
        else
            $ids =  $request->ids;
        $branchUsers = $this->userDetailServices->getAllUsersByBranchId($ids);
        $data['branchUsers'] = $branchUsers;
        $data['branchDepartments'] = $this->departmentServices->getDepartmentsByAdminAndCompany();
        return response()->json(['status' => true, 'data' => $data]);
    }
    public function getAllUsersByBranchAndDepartmentId(Request $request)
    {
        $branchIds = $request->branchIds;
        if (empty($request->departmentIds))
            $departmentIds = [];
        else
            $departmentIds = $request->departmentIds;

        $branchUsers = $this->userDetailServices->getAllUsersByBranchAndDepartmentId($branchIds, $departmentIds);
        $data['branchDepartmentUsers'] = $branchUsers;
        $data['branchDepartmentDesignations'] = $this->designationServices->getAllDesignationUsingDepartmentID($departmentIds);
        return response()->json(['status' => true, 'data' => $data]);
    }
    public function getAllUsersByBranchDepartmentAndDesignationId(Request $request)
    {

        $branchUsers = $this->userDetailServices->getAllUsersByBranchDepartmentAndDesignationId($request->branchIds, $request->departmentIds, $request->designationIds);
        return response()->json(['status' => true, 'data' => $branchUsers]);
    }


    public function create()
    {
        $branches = $this->branch_services->allActiveBranches();
        return view('company.announcements.create', compact('branches'));
    }
    public function edit(Request $request)
    {
        $branches = $this->branch_services->allActiveBranches();
        return view('company.announcements.edit', [
            'announcement' => $this->announcementService->announcementDetails($request->id),
            'branches' => $this->branch_services->allActiveBranches(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddAnnouncementRequest $request)
    {
        try {

            $data = $request->except(['_token']);
            if ($request->has('image')) {
                $data['image'] = uploadFile('image', 'image', 'originalAnnouncementImagePath');
            }
            // $data['start_date_time'] =   date('Y-m-d h:i:s a ', strtotime($request->start_date_time));
            // $data['expire_at'] =   date('Y-m-d h:i:s a ', strtotime($request->expire_at));
            if ($this->announcementService->create($data)) {
                return response()->json(
                    [
                        'message' => 'Announcement Created Successfully!',
                        'data'   =>  view('company.announcements.announcement_list', [
                            'announcements' => $this->announcementService->all('paginate'),
                        ])->render()
                    ]
                );
            }
        } catch (Exception $e) {
            return response()->json(['error' =>  $e->getMessage()], 400);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddAnnouncementRequest $request)
    {
        $updateData = $request->except(['_token', 'id']);
        if ($request->has('image')) {
            $updateData['image'] = uploadFile('image', 'image', 'originalAnnouncementImagePath');
        }
        $companyStatus = $this->announcementService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json([
                'message' => 'Announcement Updated Successfully!',
                'data'   =>  view('company.announcements.announcement_list', [
                    'announcements' => $this->announcementService->all(),
                    'branches' => $this->branch_services->allActiveBranches(),
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
        $data = $this->announcementService->deleteDetails($id);
        $announcements = $this->announcementService->all();
        $branches = $this->branch_services->allActiveBranches();
        if ($data) {
            return response()->json([
                'success', 'Deleted Successfully!',
                'data'   =>  view('company.announcements.announcement_list', [
                    'announcements' => $announcements,
                    'branches' => $branches
                ])->render()
            ]);
        } else {
            return response()->json([
                'error', 'Something Went Wrong! Pleaase try Again',
                'data'   =>  view('company.announcements.announcement_list', [
                    'announcements' => $announcements,
                    'branches' => $branches
                ])->render()
            ]);
        }
    }
    public function statusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->announcementService->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function announcementAssign(AnnouncementAssignRequest $request)
    {
        try {
            // $datas['company_branch_id']=$request['company_branch_id'];
            // $datas['announcement_id']=$request['announcement_id'];
            // $datas['department_id']=$request['department_id'];
            // $datas['designation_id']=$request['designation_id'];
            $data =  $this->announcementService->announcementAssignStore($request);
            if ($data) {
                // if ($request->assign_announcement == 1)
                //     AssignAnnouncement::dispatch(['name'=>'ejhsdjfg']);

                return apiResponse('announcement_assigned');
            } else
                return errorMessage('announcement_not_assigned');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
