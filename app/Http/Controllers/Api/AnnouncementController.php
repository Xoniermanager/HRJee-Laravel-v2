<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\AnnouncementAssignServices;
use App\Http\Services\AnnouncementServices;
use App\Http\Services\UserDetailServices;
use App\Models\AnnouncementDesignation;
use Illuminate\Http\Request;
use Throwable;

class AnnouncementController extends Controller
{
    private $announcementServices;
    public function __construct(AnnouncementServices $announcementServices)
    {
        $this->announcementServices = $announcementServices;
    }

    public function getAllAssignedAnnouncement(Request $request)
    {
        try {
            $user = auth()->guard('employee_api')->user();
            $data = $this->announcementServices->getAllAssignedAnnouncement($user);
            return apiResponse('announcement', $data);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
