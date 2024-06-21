<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\AuthService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private $userAuthService;
    public function __construct(AuthService $userAuthService)
    {
        $this->userAuthService = $userAuthService;
    }
    public function login(Request $request)
    {
        return $this->userAuthService->login($request);
    }
    public function profile(Request $request)
    {
        return $this->userAuthService->profile($request);
    }
    public function logout(Request $request)
    {
        return $this->userAuthService->logout($request);
    }
    public function changePassword(Request $request)
    {
        return $this->userAuthService->changePassword($request);
    }
    public function updateProfile(Request $request)
    {
        return $this->userAuthService->updateProfile($request);
    }
 
}
