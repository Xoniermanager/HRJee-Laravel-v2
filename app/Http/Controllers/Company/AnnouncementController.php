<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddAnnouncementRequest;
use App\Http\Services\AnnouncementServices;
use App\Http\Services\BranchServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
{
    private $branch_services;
    private $announcementService;
    public function __construct(AnnouncementServices $announcementService, BranchServices $branch_services)
    {
        $this->announcementService = $announcementService;
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
        return view('company.announcements.assign_announcement', [
            'announcement' => $this->announcementService->announcementDetails($request->id),
            'announcements' => $this->announcementService->all(),
            'branches' => $this->branch_services->allActiveBranches(),
            'branch_id' => $request->id
        ]);
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
                            'announcements' => $this->announcementService->all(),
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
}
