<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendOtpRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserPasswordChangeRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateProfileRequest;
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
    public function login(UserLoginRequest $request)
    {
        return $this->userAuthService->login($request);
    }
    public function profile(Request $request)
    {
        return $this->userAuthService->profile();
    }
    public function userAllDetails()
    {

      return $this->userAuthService->userAllDetails();
    }
    public function logout(Request $request)
    {
        return $this->userAuthService->logout($request);
    }
    public function sendOtp(SendOtpRequest $request)
    {
        return $this->userAuthService->sendOtp($request, 'employee');
    }
    public function verifyOtp(UserRequest $request)
    {
        return $this->userAuthService->verifyOtp($request);
    }
    public function changePassword(UserPasswordChangeRequest $request)
    {
        return $this->userAuthService->changePassword($request);
    }
    public function updateProfile(UserUpdateProfileRequest $request)
    {
        return $this->userAuthService->updateProfile($request);
    }
}
