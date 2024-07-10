<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\AnnouncementAssignServices;
use App\Http\Services\AnnouncementServices;
use App\Http\Services\UserDetailServices;
use App\Models\AnnouncementDesignation;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    private $announcementServices;
    public function __construct(AnnouncementServices $announcementServices)
    {
        $this->announcementServices = $announcementServices;
    }

    public function getAllAssignedAnnouncement(Request $request)
    {
        $data = $this->announcementServices->getAllAssignedAnnouncement($request);
        return apiResponse('announcement', $data);
    }
}
