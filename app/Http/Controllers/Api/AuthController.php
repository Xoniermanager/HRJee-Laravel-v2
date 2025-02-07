<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendOtpRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRequest;
use App\Http\Services\Api\AuthService;
use App\Models\User;
use App\Models\MenuRole;
use App\Models\Menu;
use Illuminate\Http\Request;
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
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required','string','min:8'],
            'old_password' => ['required','string','min:8'],
            'confirm_password' => ['required','same:password']
        ]);

        if ($validator->fails()) {

            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 400);
        }

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid password',
                'data' => [],
            ], 200);
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Password changed successfully',
            'data' => [],
        ], 200);
    }
    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'father_name' => 'required|string|max:100',
            'mother_name' => 'required|string|max:100',
            'blood_group' => 'required|in:A+, A-, B+, B-, O-, O+',
            'gender' => 'required|in:M,F,O',
            'marital_status' => 'required|in:M,S',
            'phone' => 'required|min:5|max:20',
            'profile_image' => 'nullable|mimes:jpeg,png,jpg',
            'date_of_birth' => 'required|date|before:' . now()->subYears(18)->toDateString(),
        ]);

        if ($validator->fails()) {

            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 400);
        }

        $this->userAuthService->updateProfile($request);

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully',
            'data' => [],
        ], 200);
    }

    public function getCompanyDetails()
    {
        $companyDetails = auth()->user()->parent;
        $companyDetails->details = auth()->user()->parent->companyDetails;

        return response()->json([
            'status' => true,
            'message' => NULL,
            'data' => $companyDetails,
        ], 200);
    }

    public function getMenuAccess()
    {

        $companyAssignedMenuIds = MenuRole::where('role_id', auth()->user()->parent->role_id)->pluck('menu_id')->toArray();
        $childMenus = Menu::where(['status' => 1, 'role' => 'employee'])->where(function ($query) use ($companyAssignedMenuIds) {
            $query->whereIn('parent_id', $companyAssignedMenuIds)
                ->orWhere('parent_id', NULL);
        })->get();

        return response()->json([
            'status' => true,
            'message' => NULL,
            'data' => $childMenus,
        ], 200);
    }



}
