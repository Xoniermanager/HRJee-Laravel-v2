<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Menu;
use App\Models\User;
use App\Models\MenuRole;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SendOtpRequest;
use App\Http\Services\Api\AuthService;
use App\Http\Requests\UserLoginRequest;
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
    public function profileDetails()
    {
        $user = Auth()->guard('employee_api')->user();
        try {
            $employeeDetails = $user->load('details', 'addressDetails', 'bankDetails', 'advanceDetails', 'pastWorkDetails', 'documentDetails', 'qualificationDetails', 'familyDetails', 'skill', 'language', 'assetDetails', 'documentDetails.documentTypes');
            return response()->json([
                'status' => true,
                'message' => 'Employee details',
                'data' => $employeeDetails,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
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
            'password' => ['required', 'string', 'min:8'],
            'old_password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'same:password']
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
        $details = Auth()->guard('employee_api')->user()->userCompanyDetails;
        return response()->json([
            'status' => true,
            'message' => "User Company Details",
            'data' => $details,
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
    public function userKycRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'face_kyc' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 400);
        }
        $updateDetails = UserDetail::where('user_id',Auth()->user()->id)->update(['face_kyc' => $request['face_kyc']]);
        if ($updateDetails) {
            return response()->json([
                'status' => true,
                'message' => 'Kyc updated successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unable to updated Kyc Registration',
            ], 400);
        }

    }
    public function userPunchInImage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'face_punchin_kyc' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 400);
        }
        $updateDetails = UserDetail::where('user_id',Auth()->user()->id)->update(['face_punchin_kyc' => $request['face_kyc']]);
        if ($updateDetails) {
            return response()->json([
                'status' => true,
                'message' => 'Punch In Image updated successfully',
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unable to updated Punch In Image',
            ], 400);
        }

    }
}
