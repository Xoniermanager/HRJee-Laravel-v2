<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Http\Controllers\Controller;
use App\Http\Services\AnnouncementServices;

class AnnouncementController extends Controller
{
    private $announcementServices;
    public function __construct(AnnouncementServices $announcementServices)
    {
        $this->announcementServices = $announcementServices;
    }

    public function allAssignedAnnouncement()
    {
        try {
            $allAnnouncementDetails = $this->announcementServices->getAllAssignedAnnouncementForEmployee();
            $announcementPayloadDetails = [];
            foreach ($allAnnouncementDetails as $announcementDetails) {
                $announcementPayloadDetails[] =
                    [
                        'title' => $announcementDetails->title,
                        'image' => $announcementDetails->image,
                    ];
            }
            return response()->json([
                'status' => true,
                'message' => 'Retried Announcement List Successfully',
                'data' => $announcementPayloadDetails,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function viewAnnouncementDetails($id)
    {
        try {
            $announcementDetails = $this->announcementServices->findById($id);
            $viewDetails =
                [
                    'title' => $announcementDetails->title,
                    'image' => $announcementDetails->image,
                    'description' => $announcementDetails->description,
                    'file' => $announcementDetails->file
                ];
            return response()->json([
                'status' => true,
                'message' => 'Retried Announcement Details Successfully',
                'data' => $viewDetails,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
