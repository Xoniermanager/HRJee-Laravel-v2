<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\AnnouncementAssignServices;
use App\Http\Services\UserDetailServices;
use App\Models\AnnouncementDesignation;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    private $announcementAssignServices;
    private $userDetailServices;
    public function __construct(UserDetailServices $userDetailServices, AnnouncementAssignServices $announcementAssignServices)
    {
        $this->userDetailServices = $userDetailServices;
        $this->announcementAssignServices = $announcementAssignServices;
    }

    public function announcement(Request $request)
    {
        $userDetails = $this->userDetailServices->getDetailsByUserId(auth()->guard('employee_api')->user()->id);
        $branchId = $userDetails->company_branch_id;
        $companyId = $userDetails->user->company_id;
        $assignAnnouncement = $this->announcementAssignServices->getAllAssignAnnouncement($companyId, $branchId);

        return $assignAnnouncement;

        // $announcement =  AnnouncementDesignation::where('designation_id', $userDetails->designation_id)->pluck('announcement_id')->toArray();
        // dd($announcement);
        // return $userDetails;
    }
}
