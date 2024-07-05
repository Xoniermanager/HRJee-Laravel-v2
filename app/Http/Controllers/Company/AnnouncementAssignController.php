<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnnouncementAssignRequest;
use App\Http\Services\AnnouncementAssignServices;
use App\Http\Services\AnnouncementServices;
use App\Http\Services\BranchServices;
use App\Http\Services\DepartmentServices;
use App\Http\Services\DesignationServices;
use App\Http\Services\UserDetailServices;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class AnnouncementAssignController extends Controller
{

    private $announcementAssignServices;
    private $branchServices;
    private $announcementService;
    private $userDetailServices;
    private $designationServices;
    private $departmentServices;
    public function __construct(DepartmentServices $departmentServices, DesignationServices $designationServices, UserDetailServices $userDetailServices, AnnouncementAssignServices $announcementAssignServices, BranchServices $branchServices, AnnouncementServices $announcementServices)
    {
        $this->announcementAssignServices = $announcementAssignServices;
        $this->announcementService = $announcementServices;
        $this->designationServices = $designationServices;
        $this->userDetailServices = $userDetailServices;
        $this->departmentServices = $departmentServices;
        $this->branchServices = $branchServices;
    }
    // announcement assign module


    public function getIndex()
    {
        $announcementAssign = $this->announcementAssignServices->all('paginate');

        $branches = $this->branchServices->allActiveCompanyBranchesByUsingCompanyId(auth()->guard('admin')->user()->company_id);
        return view('company.announcement_assign.index', [
            'announcement_assigns' => $announcementAssign,
            'branches' => $branches
        ]);
    }


    public function announcementAssignStore(AnnouncementAssignRequest $request)
    {
        try {
            $data =  $this->announcementService->announcementAssignStore($request);
            if ($data) {
                $announcement = Announcement::find($request->announcement_id);
                $announcement->branches()->sync($request->company_branch_id);
                $announcement->departments()->sync($request->department_id);
                $announcement->designations()->sync($request->designation_id);
                // if ($request->assign_announcement == 1)
                //     AssignAnnouncement::dispatch(['name'=>'ejhsdjfg']);

                return apiResponse('announcement_assigned');
            } else
                return errorMessage('announcement_not_assigned');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }






    public function editAnnouncementAssign(Request $request)
    {
        $announcementAssign = $this->announcementAssignServices->announcementAssignDetails($request->id);
        if (empty($announcementAssign))
            return redirect()->route('announcement.assign.index')->with('error', 'invalid id provided');


        $announcement = $this->announcementService->announcementDetails($announcementAssign->announcement_id);
        $assignBrancheIds = $announcement->branches()->pluck('branch_id')->toArray();
        $assignDepartmentIds = $announcement->departments()->pluck('department_id')->toArray();
        $assignDesignationIds = $announcement->designations()->pluck('designation_id')->toArray();
       
        $activeBranches = $this->branchServices->allActiveCompanyBranchesByUsingCompanyId(auth()->guard('admin')->user()->company_id);
   

        // if (!empty($announcement->company_branch_id))
        //     $branchIds[] = $announcement->company_branch_id;
        // else
        //     $branchIds = $ids;


        $allUsers = $this->userDetailServices->getAllUsersByBranchDepartmentAndDesignationId($assignBrancheIds, $assignDepartmentIds, $assignDesignationIds);
        $designations = $this->designationServices->getAllDesignationUsingDepartmentID($assignDepartmentIds);
        return view('company.announcement_assign.assign_announcement_edit', [
            'announcement' => $announcement,
            'assignDepartmentIds' => $assignDepartmentIds,
            'assignBrancheIds' => $assignBrancheIds,
            'assignDesignationIds' => $assignDesignationIds,
            'announcementAssign' => $announcementAssign,
            'announcements' => $this->announcementService->all(),
            'departments' =>  $this->departmentServices->getDepartmentsByAdminAndCompany(),
            'designations' => $designations,
            'branches' => $activeBranches,
            'users' => $allUsers,
            // 'branch_id' => $branchIds
        ]);
    }


    public function updateAnnouncementAssign(AnnouncementAssignRequest $request)
    {
        try {
            $data =  $this->announcementService->announcementAssignStore($request);
            if ($data) {
                $announcement = Announcement::find($request->announcement_id);
                $announcement->branches()->sync($request->company_branch_id);
                $announcement->departments()->sync($request->department_id);
                $announcement->designations()->sync($request->designation_id);
                // if ($request->assign_announcement == 1)
                //     AssignAnnouncement::dispatch(['name'=>'ejhsdjfg']);

                return apiResponse('announcement_assign_updated');
            } else
                return errorMessage('announcement_not_assigned');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }




    public function destroyAnnouncementAssign(Request $request)
    {

        $id = $request->id;
        $announcementAssign = $this->announcementAssignServices->announcementAssignDetails($id);

        $data = $this->announcementAssignServices->deleteDetails($id);
        if ($data) {
            $announcement = $this->announcementService->announcementDetails($announcementAssign->announcement_id);
            $announcement->branches()->detach();
            $announcement->departments()->detach();
            $announcement->designations()->detach();
        }
        $announcements = $this->announcementAssignServices->all('paginate');

        if ($data) {
            return response()->json([
                'success', 'Deleted Successfully!',
                'data'   =>  view('company.announcement_assign.announcement_assign_list', [
                    'announcement_assigns' => $announcements,
                ])->render()
            ]);
        } else {
            return response()->json([
                'error', 'Something Went Wrong! Pleaase try Again',
                'data'   =>  view('company.announcements.announcement_list', [
                    'announcement_assigns' => $announcements,
                ])->render()
            ]);
        }
    }


    public function announcementAssignStatusUpdate(Request $request)
    {
        $id = $request->id;
        $data['status'] = $request->status;
        $statusDetails = $this->announcementAssignServices->updateDetails($data, $id);
        if ($statusDetails) {
            echo 1;
        } else {
            echo 0;
        }
    }
    public function getView(Request $request)
    {
        try {

            $id = $request->id;
            $announcementAssign = $this->announcementAssignServices->announcementAssignDetails($id);

            $announcement = $this->announcementService->announcementDetails($announcementAssign->announcement_id);
            // get all branches which is associatted with announcement
            $allAssignedBranchIds = $announcement->branches()->pluck('branch_id')->toArray();
            $branches = $this->branchServices->getAllBranchByBranchId($allAssignedBranchIds);

             // get all departments which is associatted with announcement
             $allAssignedDepartmentIds = $announcement->departments()->pluck('department_id')->toArray();
             $departments = $this->departmentServices->getAllDepartmentByDepartmentId($allAssignedDepartmentIds);
           
           
             // get all departments which is associatted with announcement
             $allAssignedDesignationIds = $announcement->designations()->pluck('designation_id')->toArray();
             $designations = $this->designationServices->getAllDesignationByDesignationId($allAssignedDesignationIds);
   

            return view('company.announcements.view', compact('branches', 'departments', 'designations','announcement'));
        } catch (Throwable $th) {
            Log::error($th);
        }
    }
}
