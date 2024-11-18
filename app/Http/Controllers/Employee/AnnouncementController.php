<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Services\AnnouncementServices;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    protected $announcementServices;
    public function __construct(AnnouncementServices $announcementServices)
    {
        $this->announcementServices = $announcementServices;
    }
    public function index(Request $request)
    {
        $user = auth()->guard('employee')->user();
        $data = $this->announcementServices->getAllAssignedAnnouncement($user);
        return view('employee.announcement.index', compact('data'));
    }

    public function viewDetails(Request $request)
    {
        $announcement = $this->announcementServices->findById($request->id);
        return view('employee.announcement.details',compact('announcement'));
    }
}
