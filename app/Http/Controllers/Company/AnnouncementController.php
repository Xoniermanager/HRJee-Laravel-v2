<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddAnnouncementRequest;
use App\Http\Requests\AnnouncementAssignRequest;
use App\Http\Services\AnnouncementAssignServices;
use App\Http\Services\AnnouncementServices;
use App\Http\Services\BranchServices;
use App\Http\Services\CompanyUserService;
use App\Http\Services\DepartmentServices;
use App\Http\Services\DesignationServices;
use App\Http\Services\EmployeeServices;
use App\Http\Services\UserDetailServices;
use App\Jobs\AssignAnnouncement;
use App\Models\Announcement;
use App\Models\AnnouncementAssign;
use App\Models\CompanyBranch;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;

class AnnouncementController extends Controller
{
    private $branch_services;
    private $departmentServices;
    private $announcementService;
    private $userDetailServices;
    private $designationServices;
    private $announcementAssignServices;
    private $employeeServices;
    private $branchServices;
    public function __construct(BranchServices $branchServices, EmployeeServices $employeeServices, AnnouncementAssignServices $announcementAssignServices, AnnouncementServices $announcementService, BranchServices $branch_services, DepartmentServices $departmentServices, DesignationServices $designationServices, UserDetailServices $userDetailServices)
    {
        $this->announcementAssignServices = $announcementAssignServices;
        $this->announcementService = $announcementService;
        $this->departmentServices = $departmentServices;
        $this->designationServices = $designationServices;
        $this->userDetailServices = $userDetailServices;
        $this->branch_services = $branch_services;
        $this->employeeServices = $employeeServices;
        $this->branchServices = $branchServices;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('company.announcements.index', [
            'announcements' => $this->announcementService->all('paginate'),
            'branches' => $this->branch_services->allActiveCompanyBranchesByUsingCompanyId(auth()->guard('admin')->user()->company_id)
        ]);
    }


    public function getAnnouncement(Request $request)
    {
        $announcement = $this->announcementService->announcementDetails($request->id);
        // question ? company can add directly a user without select any branch or department or designation 
        $activeBranches = $this->branch_services->allActiveCompanyBranchesByUsingCompanyId(auth()->guard('admin')->user()->company_id);

        if (!empty($announcement->company_branch_id)) {
            $type = 1;
            $branchIds[] = $announcement->company_branch_id;
        } elseif (!empty(auth()->guard('admin')->user()->branch_id)) {
            $branchIds[] = auth()->guard('admin')->user()->branch_id;
            $type = 2;
        } else if (!empty(auth()->guard('admin')->user()->company_id) && empty(auth()->guard('admin')->user()->branch_id)) {
            $users = $this->employeeServices->getAllEmployeeByCompanyId(auth()->guard('admin')->user()->company_id);
            $userIds = $users->pluck('id')->toArray();
            $allUsersByUserId = $this->userDetailServices->getAllUserByUserId($userIds);
            $ids = $allUsersByUserId->pluck('company_branch_id')->toArray();
            $branchIds = $ids;
            $type = 3;
        }

        $branchUsers = $this->userDetailServices->getAllUsersByBranchId($branchIds);
        return view('company.announcement_assign.assign_announcement', [
            'announcement' => $announcement,
            'announcements' => $this->announcementService->all(),
            'departments' =>  $this->departmentServices->getDepartmentsByAdminAndCompany(),
            'branches' => $activeBranches,
            'branchUsers' => $branchUsers,
            'branch_id' => $branchIds,
            'type' => $type
        ]);
    }
    public function getAnnouncementDetails(Request $request)
    {
        $announcement = $this->announcementService->announcementDetails($request->id);
        return response()->json(['status' => true, 'data' => $announcement]);
    }


    public function getAllUsersByBranchId(Request $request)
    {

        if (empty($request->ids)) {
            $branchIds =  [];
        } else if (!empty($request->ids) && in_array('all', $request->ids)) {
            if (!empty(auth()->guard('admin')->user()->branch_id)) {
                $branchIds[] = auth()->guard('admin')->user()->branch_id;
            } else if (!empty(auth()->guard('admin')->user()->company_id) && empty(auth()->guard('admin')->user()->branch_id)) {
                $branches = $this->branch_services->allActiveCompanyBranchesByUsingCompanyId(auth()->guard('admin')->user()->company_id);
                $branchIds = $branches->pluck('id')->toArray();
            }
        } else {
            $branchIds =  $request->ids;
        }




        $branchUsers = $this->userDetailServices->getAllUsersByBranchId($branchIds);
        $data['branchUsers'] = $branchUsers;
        $data['branchDepartments'] = $this->departmentServices->getDepartmentsByAdminAndCompany();
        return response()->json(['status' => true, 'data' => $data]);
    }
    public function getAllUsersByBranchAndDepartmentId(Request $request)
    {



        if (empty($request->branchIds)) {
            $branchIds =  [];
        } else if (!empty($request->branchIds) && in_array('all', $request->branchIds)) {
            if (!empty(auth()->guard('admin')->user()->branch_id)) {
                $branchIds[] = auth()->guard('admin')->user()->branch_id;
            } else if (!empty(auth()->guard('admin')->user()->company_id) && empty(auth()->guard('admin')->user()->branch_id)) {
                $branches = $this->branch_services->allActiveCompanyBranchesByUsingCompanyId(auth()->guard('admin')->user()->company_id);
                $branchIds = $branches->pluck('id')->toArray();
            }
        } else {
            $branchIds =  $request->branchIds;
        }


        if (empty($request->departmentIds)) {
            $departmentIds =  [];
        } else if (!empty($request->departmentIds) && in_array('all', $request->departmentIds)) {
            $departments = $this->departmentServices->getDepartmentsByAdminAndCompany();
            $departmentIds = $departments->pluck('id')->toArray();
        } else {
            $departmentIds =  $request->departmentIds;
        }

        $branchUsers = $this->userDetailServices->getAllUsersByBranchAndDepartmentId($branchIds, $departmentIds);
        $data['branchDepartmentUsers'] = $branchUsers;
        $data['branchDepartmentDesignations'] = $this->designationServices->getAllDesignationUsingDepartmentID($departmentIds);
        return response()->json(['status' => true, 'data' => $data]);
    }
    public function getAllUsersByBranchDepartmentAndDesignationId(Request $request)
    {

        if (empty($request->branchIds)) {
            $branchIds =  [];
        } else if (!empty($request->branchIds) && in_array('all', $request->branchIds)) {
            if (!empty(auth()->guard('admin')->user()->branch_id)) {
                $branchIds[] = auth()->guard('admin')->user()->branch_id;
            } else if (!empty(auth()->guard('admin')->user()->company_id) && empty(auth()->guard('admin')->user()->branch_id)) {
                $branches = $this->branch_services->allActiveCompanyBranchesByUsingCompanyId(auth()->guard('admin')->user()->company_id);
                $branchIds = $branches->pluck('id')->toArray();
            }
        } else {
            $branchIds =  $request->branchIds;
        }


        if (empty($request->departmentIds)) {
            $departmentIds =  [];
        } else if (!empty($request->departmentIds) && in_array('all', $request->departmentIds)) {
            $departments = $this->departmentServices->getDepartmentsByAdminAndCompany();
            $departmentIds = $departments->pluck('id')->toArray();
        } else {
            $departmentIds =  $request->departmentIds;
        }


        // get designation ids
        if (empty($request->designationIds)) {
            $designationIds =  [];
        } else if (!empty($request->designationIds) && in_array('all', $request->designationIds)) {
            $designations = $this->designationServices->getAllDesignationUsingDepartmentID($departmentIds);
            $designationIds = $designations->pluck('id')->toArray();
        } else {
            $designationIds =  $request->designationIds;
        }



        $branchUsers = $this->userDetailServices->getAllUsersByBranchDepartmentAndDesignationId($branchIds, $departmentIds, $designationIds);
        return response()->json(['status' => true, 'data' => $branchUsers]);
    }


    public function create()
    {
        if (!empty(auth()->guard('admin')->user()->branch_id)) {
            $branchIds[] = auth()->guard('admin')->user()->branch_id;
        } else if (!empty(auth()->guard('admin')->user()->company_id) && empty(auth()->guard('admin')->user()->branch_id)) {
            $users = $this->employeeServices->getAllEmployeeByCompanyId(auth()->guard('admin')->user()->company_id);
            $userIds = $users->pluck('id')->toArray();
            $allUsersByUserId = $this->userDetailServices->getAllUserByUserId($userIds);
            $ids = $allUsersByUserId->pluck('company_branch_id')->toArray();
            $branchIds = $ids;
        }
        $branchUsers = $this->userDetailServices->getAllUsersByBranchId($branchIds);

        $activeBranches = $this->branch_services->allActiveCompanyBranchesByUsingCompanyId(auth()->guard('admin')->user()->company_id);
        $departments =  $this->departmentServices->getDepartmentsByAdminAndCompany();
        $branches = $this->branch_services->allActiveCompanyBranchesByUsingCompanyId(auth()->guard('admin')->user()->company_id);
        return view('company.announcements.create', compact('branches', 'branchUsers', 'departments', 'activeBranches'));
    }
    public function edit(Request $request)
    {

        return view('company.announcements.edit', [
            'announcement' => $this->announcementService->announcementDetails($request->id),
            'branches' => $this->branch_services->allActiveCompanyBranchesByUsingCompanyId(auth()->guard('admin')->user()->company_id),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddAnnouncementRequest $request)
    {
        try {
            $data = $request->except(['_token', 'department_id', 'designation_id', 'branch_id',  'assign_announcement']);

            $data['all_branch'] = in_array('all', $request->branch_id) ? 1 : 0;
            $data['all_department'] = in_array('all', $request->department_id) ? 1 : 0;
            $data['all_designation'] = in_array('all', $request->designation_id) ? 1 : 0;
            $data['notification_schedule_time'] = $request->assign_announcement == 0 ? $request->notification_schedule_time : null;
            if ($request->has('image')) {
                $data['image'] = uploadFile('image', 'image', 'originalAnnouncementImagePath');
            }

            $loginUser = auth()->guard('admin')->user();
            $data['company_branch_id'] = !empty($loginUser->company_id) && !empty($loginUser->branch_id) ? $loginUser->branch_id : $loginUser->company_id;
            $createdId =  $this->announcementService->create($data);
            if ($createdId) {
                $announcement = Announcement::find($createdId);
                if ($data['all_branch'] != 1)
                    $announcement->branches()->sync($request->company_branch_id);
                if ($data['all_department'] != 1)
                    $announcement->departments()->sync($request->department_id);

                if ($data['all_designation'] != 1)
                    $announcement->designations()->sync($request->designation_id);

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

    public function getView(Request $request)
    {
        try {
            $id = $request->id;


            $announcement = $this->announcementService->announcementDetails($id);
            // get all branches which is associatted with announcement
            $allAssignedBranchIds = $announcement->branches()->pluck('branch_id')->toArray();
            $branches = $this->branchServices->getAllBranchByBranchId($allAssignedBranchIds);

            // get all departments which is associatted with announcement
            $allAssignedDepartmentIds = $announcement->departments()->pluck('department_id')->toArray();
            $departments = $this->departmentServices->getAllDepartmentByDepartmentId($allAssignedDepartmentIds);


            // get all departments which is associatted with announcement
            $allAssignedDesignationIds = $announcement->designations()->pluck('designation_id')->toArray();
            $designations = $this->designationServices->getAllDesignationByDesignationId($allAssignedDesignationIds);

            return view('company.announcement_assign.view', compact('branches', 'departments', 'designations', 'announcement'));
        } catch (Throwable $th) {
            Log::error($th);
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
        $loginUser = auth()->guard('admin')->user();
        $updateData['company_branch_id'] = !empty($loginUser->company_id) && !empty($loginUser->branch_id) ? $loginUser->branch_id : $request->company_branch_id;
        $companyStatus = $this->announcementService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            $html =   view('company.announcements.announcement_list', [
                'announcements' => $this->announcementService->all('paginate'),
                'branches' => $this->branch_services->allActiveCompanyBranchesByUsingCompanyId(auth()->guard('admin')->user()->company_id),
            ])->render();
            return response()->json([
                'message' => 'Announcement Updated Successfully!',
                'status' => true,
                'data'   => $html
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
        $announcements = $this->announcementService->all('paginate');
        $branches = $this->branch_services->allActiveCompanyBranchesByUsingCompanyId(auth()->guard('admin')->user()->company_id);
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


    // announcement assign module





    public function announcementAssignStore(Request $request)
    {
        try {

            $request['all_branch'] = in_array('all', $request->company_branch_id) ? 1 : 0;
            $request['all_department'] = in_array('all', $request->department_id) ? 1 : 0;
            $request['all_designation'] = in_array('all', $request->designation_id) ? 1 : 0;
            $request['notification_schedule_time'] = $request->assign_announcement == 0 ? $request->notification_schedule_time : null;
            $data = $request->except('department_id', 'designation_id', 'company_branch_id', 'assign_announcement');
            $dataCheck =  $this->announcementService->announcementAssignStore($data);
            if ($dataCheck) {

                $announcement = Announcement::find($request->announcement_id);
                if ($data['all_branch'] != 1)
                    $announcement->branches()->sync($request->company_branch_id);
                if ($data['all_department'] != 1)
                    $announcement->departments()->sync($request->department_id);

                if ($data['all_designation'] != 1)
                    $announcement->designations()->sync($request->designation_id);



                return apiResponse('announcement_assigned');
            } else
                return errorMessage('announcement_not_assigned');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }






    // public function editAnnouncementAssign(Request $request)
    // {
    //     $announcementAssign = $this->announcementAssignServices->announcementAssignDetails($request->id);
    //     if (empty($announcementAssign))
    //         return redirect()->route('announcement.assign.index')->with('error', 'invalid id provided');



    //     $announcement = $this->announcementService->announcementDetails($announcementAssign->announcement_id);
    //     $assignBrancheIds = $announcement->branches()->pluck('branch_id')->toArray();
    //     $assignDepartmentIds = $announcement->departments()->pluck('department_id')->toArray();
    //     $assignDesignationIds = $announcement->designations()->pluck('designation_id')->toArray();

    //     $activeBranches = $this->branch_services->allActiveCompanyBranchesByUsingCompanyId(auth()->guard('admin')->user()->company_id);
    //     // $ids = $activeBranches->pluck('id')->toArray();

    //     // if (!empty($announcement->company_branch_id))
    //     //     $branchIds[] = $announcement->company_branch_id;
    //     // else
    //     //     $branchIds = $ids;


    //     $allUsers = $this->userDetailServices->getAllUsersByBranchDepartmentAndDesignationId($assignBrancheIds, $assignDepartmentIds, $assignDesignationIds);
    //     $designations = $this->designationServices->getAllDesignationUsingDepartmentID($assignDepartmentIds);
    //     return view('company.announcement_assign.assign_announcement_edit', [
    //         'announcement' => $announcement,
    //         'assignDepartmentIds' => $assignDepartmentIds,
    //         'assignBrancheIds' => $assignBrancheIds,
    //         'assignDesignationIds' => $assignDesignationIds,
    //         'announcementAssign' => $announcementAssign,
    //         'announcements' => $this->announcementService->all(),
    //         'departments' =>  $this->departmentServices->getDepartmentsByAdminAndCompany(),
    //         'designations' => $designations,
    //         'branches' => $activeBranches,
    //         'users' => $allUsers,
    //         // 'branch_id' => $branchIds
    //     ]);
    // }


    // public function updateAnnouncementAssign(AnnouncementAssignRequest $request)
    // {
    //     try {
    //         $data =  $this->announcementService->announcementAssignStore($request);
    //         if ($data) {
    //             $announcement = Announcement::find($request->announcement_id);
    //             $announcement->branches()->sync($request->company_branch_id);
    //             $announcement->departments()->sync($request->department_id);
    //             $announcement->designations()->sync($request->designation_id);
    //             // if ($request->assign_announcement == 1)
    //             //     AssignAnnouncement::dispatch(['name'=>'ejhsdjfg']);

    //             return apiResponse('announcement_assign_updated');
    //         } else
    //             return errorMessage('announcement_not_assigned');
    //     } catch (Throwable $th) {
    //         return exceptionErrorMessage($th);
    //     }
    // }




    // public function destroyAnnouncementAssign(Request $request)
    // {

    //     $id = $request->id;
    //     $announcementAssign = $this->announcementAssignServices->announcementAssignDetails($id);

    //     $data = $this->announcementAssignServices->deleteDetails($id);
    //     if ($data) {
    //         $announcement = $this->announcementService->announcementDetails($announcementAssign->announcement_id);
    //         $announcement->branches()->detach();
    //         $announcement->departments()->detach();
    //         $announcement->designations()->detach();
    //     }
    //     $announcements = $this->announcementAssignServices->all('paginate');

    //     if ($data) {
    //         return response()->json([
    //             'success', 'Deleted Successfully!',
    //             'data'   =>  view('company.announcement_assign.announcement_assign_list', [
    //                 'announcement_assigns' => $announcements,
    //             ])->render()
    //         ]);
    //     } else {
    //         return response()->json([
    //             'error', 'Something Went Wrong! Pleaase try Again',
    //             'data'   =>  view('company.announcements.announcement_list', [
    //                 'announcement_assigns' => $announcements,
    //             ])->render()
    //         ]);
    //     }
    // }


    // public function announcementAssignStatusUpdate(Request $request)
    // {
    //     $id = $request->id;
    //     $data['status'] = $request->status;
    //     $statusDetails = $this->announcementAssignServices->updateDetails($data, $id);
    //     if ($statusDetails) {
    //         echo 1;
    //     } else {
    //         echo 0;
    //     }
    // }
}
