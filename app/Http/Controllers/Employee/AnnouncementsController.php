<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Services\AnnouncementServices;

class AnnouncementsController extends Controller
{
    public $announcementService;

    public function __construct(AnnouncementServices $announcementService)
    {
        $this->announcementService = $announcementService;
    }
    public function index()
    {
        $allAssinedAnnouncementDetails = $this->announcementService->getAllAssignedAnnouncementForEmployee();
        return view('employee.announcement.index', compact('allAssinedAnnouncementDetails'));
    }

    public function viewDetails($id)
    {
        $announcementDetails = $this->announcementService->findById($id);
        return view('employee.announcement.details', compact('announcementDetails'));
    }
}
