<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Menu;
use App\Models\User;
use App\Models\MenuRole;
use App\Models\UserDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\DB;
use App\Http\Services\LeaveService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SendOtpRequest;
use App\Http\Services\Api\AuthService;
use App\Http\Requests\UserLoginRequest;
use App\Http\Services\UserShiftService;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\DocumentTypeService;
use App\Http\Resources\TodaysShiftResource;
use App\Http\Requests\UserLoginByEmpIdRequest;
use App\Http\Services\EmployeeAttendanceService;

class AuthController extends Controller
{
    private $userAuthService;
    private $leaveService;
    private $attendanceService;
    private $documentTypeService;
    private $userService;
    private $userShiftService;
    public function __construct(AuthService $userAuthService, LeaveService $leaveService, EmployeeAttendanceService $attendanceService, DocumentTypeService $documentTypeService, UserService $userService, UserShiftService $userShiftService)
    {
        $this->userAuthService = $userAuthService;
        $this->leaveService = $leaveService;
        $this->attendanceService = $attendanceService;
        $this->documentTypeService = $documentTypeService;
        $this->userService = $userService;
        $this->userShiftService = $userShiftService;
    }
    public function login(UserLoginRequest $request)
    {
        return $this->userAuthService->login($request);
    }

    public function loginByEmpId(UserLoginByEmpIdRequest $request)
    {
        return $this->userAuthService->loginByEmpId($request);
    }

    public function profileDetails()
    {
        $user = Auth()->guard('employee_api')->user();
        try {
            $employeeDetails = $user->load('details', 'addressDetails', 'bankDetails', 'advanceDetails', 'pastWorkDetails', 'documentDetails', 'qualificationDetails', 'familyDetails', 'skill', 'language', 'assetDetails', 'documentDetails.documentTypes:name,id', 'userActiveLocation', 'userReward', 'userReward.rewardCategory:name,id', 'managerEmployees.user.details', 'role:name,id');
            $companyAssignedMenuIds = MenuRole::where('role_id', $user->parent->role_id)->pluck('menu_id')->toArray();
            $employeeDetails['menu_access'] = Menu::where(['status' => 1, 'role' => 'employee'])
                ->where(function ($query) use ($companyAssignedMenuIds) {
                    $query->whereIn('parent_id', $companyAssignedMenuIds)
                        ->orWhereNull('parent_id');
                })
                ->get(['title', 'id']);
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
            'password' => ['required', 'string'],
            'old_password' => ['required', 'string'],
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
            'password' => Hash::make($request->password),
            'reset_password' => false
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

        $companyAssignedMenuIds = MenuRole::where('role_id', auth()->guard('employee_api')->user()->parent->role_id)->pluck('menu_id')->toArray();
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
        $updateDetails = UserDetail::where('user_id', Auth()->user()->id)->update(['face_kyc' => $request['face_kyc']]);
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
        $updateDetails = UserDetail::where('user_id', Auth()->user()->id)->update(['face_punchin_kyc' => $request['face_kyc']]);
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

    public function faceLogin(Request $request)
    {
        $updateDetails = User::whereHas('details', function ($query) use ($request) {
            $query->whereNull('exit_date')->where('emp_id', $request->key);
        })->orWhere('email', $request->key)->first();
        if ($updateDetails) {
            $updateDetails->access_token = $updateDetails->createToken("HrJee TOKEN")->plainTextToken;
            $updateDetails->details = $updateDetails->details;
        }
        if ($updateDetails) {
            return response()->json([
                'status' => true,
                'message' => 'User Details',
                'data' => $updateDetails
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Provided credentials are invalid.',
            ], 200);
        }
    }

    public function getTeamDetailsByUserId($userId)
    {
        $data['leave'] = $this->leaveService->getConfirmedLeaveByUserID($userId)->paginate(10);
        $data['attendance'] = $this->attendanceService->getAllAttendanceByUserId($userId)->paginate(10);
        if ($data) {
            return response()->json([
                'status' => true,
                'message' => 'User Details Leave and Attendance',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Unable to get information regarding this',
            ], 200);
        }
    }

    public function refreshToken(Request $request)
    {
        $request->validate([
            'refresh_token' => 'required|string',
        ]);

        $hashedRefreshToken = hash('sha256', $request->refresh_token);

        $token = DB::table('personal_access_tokens')
            ->where('refresh_token', $hashedRefreshToken)
            // ->where('expires_at', '>', now())
            ->first();
        if (!$token) {
            return response()->json(['message' => 'Invalid or expired refresh token'], 401);
        }

        $user = User::find($token->tokenable_id);

        // Revoke the old token
        DB::table('personal_access_tokens')->where('id', $token->id)->delete();

        // Create new tokens
        $newAccessToken = $user->createToken('token');
        $newRefreshToken = Str::random(64);
        $newExpiresAt = now()->addDays(30);

        $newAccessToken->accessToken->refresh_token = hash('sha256', $newRefreshToken);
        $newAccessToken->accessToken->expires_at = $newExpiresAt;
        $newAccessToken->accessToken->save();

        return response()->json([
            'access_token' => $newAccessToken->plainTextToken,
            'refresh_token' => $newRefreshToken,
            'expires_at' => $newExpiresAt->toDateTimeString(),
            'data' => $user,
        ]);
    }

    public function updateDocuments(Request $request)
    {
        $allDocuments = $this->documentTypeService->getAllActiveDocuments();

        $rules = [];
        $messages = [];
        foreach ($allDocuments as $doc) {
            $field = "documents.{$doc->id}";

            $rules[$field] = [
                $doc->is_mandatory ? 'required' : 'nullable',
                'file',
                'max:1024',
                'mimes:jpg,jpeg,png,webp,pdf',
            ];

            $messages["{$field}.required"] = "{$doc->name} is required.";
            $messages["{$field}.file"] = "{$doc->name} must be a valid file.";
            $messages["{$field}.max"] = "{$doc->name} size must be less than 1MB.";
            $messages["{$field}.mimes"] = "{$doc->name} must be an image or PDF file.";
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                "error" => 'validation_error',
                "message" => $validator->errors(),
            ], 400);
        }

        $this->userAuthService->updateDocuments($request->all(), $allDocuments);

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully',
            'data' => [],
        ], 200);
    }

    public function toggleUserLocationTracking()
    {
        try {
            $status = $this->userService->toggleUserLocationTracking(Auth()->guard('employee_api')->user()->id);

            return response()->json([
                'status' => true,
                'message' => "Location tracking switched to " . ($status ? 'active' : 'inactive'),
                'data' => [],
            ], 200);
        } catch (\Throwable $th) {
            $msg = null;

            if ($th->getCode() == 400)
                $msg = $th->getMessage();

            return response()->json([
                'status' => false,
                'message' => $msg ?? 'Failed to toggle location tracking',
                'data' => [],
            ], 200);
        }
    }

    public function getTodaysShift()
    {
        try {
            $user = Auth()->guard('employee_api')->user();
            $shiftType = $user->details->shift_type;
            $shifts = $this->userShiftService->getTodaysShifts($user->id, $shiftType)
                ->with('shift.officeTimingConfigs')->get();

            return response()->json([
                'status' => true,
                'message' => 'Successfully fetched',
                'data' => TodaysShiftResource::collection($shifts),
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function saveDeviceToken(Request $request)
    {
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'fcm_token' => 'required', // add min length to avoid empty or short invalid tokens
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validation failed.',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            // Get authenticated user from employee_api guard
            $user = Auth()->guard('employee_api')->user();

            if (!$user) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Unauthorized.',
                ], 401);
            }

            // Update FCM token
            $user->fcm_token = $request->fcm_token;
            $updated = $user->save();

            if ($updated) {
                return response()->json([
                    'status'  => true,
                    'message' => 'Device token updated successfully!',
                ], 200);
            } else {
                return response()->json([
                    'status'  => false,
                    'message' => 'Could not update device token.',
                ], 500);
            }
        } catch (Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'An error occurred while updating device token.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

}
