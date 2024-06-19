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
            'announcements' => $this->announcementService->all(),
        ]);
    }
    public function create()
    {
        $branches = $this->branch_services->get_branches();
        return view('company.announcements.create', compact('branches'));
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
                        'data'   =>  view('company.announcements.index', [
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
    public function update(Request $request)
    {
        $validateDesignation  = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:designations,name,' . $request->id],
        ]);

        if ($validateDesignation->fails()) {
            return response()->json(['error' => $validateDesignation->messages()], 400);
        }
        $updateData = $request->except(['_token', 'id']);
        $companyStatus = $this->announcementService->updateDetails($updateData, $request->id);
        if ($companyStatus) {
            return response()->json([
                'message' => 'Designation Updated Successfully!',
                'data'   =>  view('company.designation.designation_list', [
                    'allDesignationDetails' => $this->announcementService->all()
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
        if ($data) {
            return response()->json([
                'success', 'Deleted Successfully!',
                'data'   =>  view('company.designation.designation_list', [
                    'allDesignationDetails' => $this->announcementService->all()
                ])->render()
            ]);
        } else {
            return response()->json([
                'error', 'Something Went Wrong! Pleaase try Again',
                'data'   =>  view('company.designation.designation_list', [
                    'allDesignationDetails' => $this->announcementService->all()
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
