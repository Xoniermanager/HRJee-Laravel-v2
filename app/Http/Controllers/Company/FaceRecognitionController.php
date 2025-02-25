<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Services\UserService;
use App\Http\Controllers\Controller;

class FaceRecognitionController extends Controller
{
   
    private $userService;
    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $allUserDetails = $this->userService->getFaceRecognitionUsers(Auth()->user()->id)->paginate(10);
    
        return view('company.face_recognition.index', compact('allUserDetails'));
    }
}
