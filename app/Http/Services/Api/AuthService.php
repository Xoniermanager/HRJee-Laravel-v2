<?php

namespace App\Http\Services\Api;

use App\Http\Services\SendOtpService;
use App\Mail\LoginVerification;
use App\Models\User;
use App\Models\UserCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Throwable;

class AuthService
{
    private  $authService, $sendOtpService;

    public function __construct(SendOtpService $sendOtpService)
    {
        $this->sendOtpService = $sendOtpService;
    }
    public function login($request)
    {
        try {

            if (!Auth::attempt($request->only(['email', 'password'])))
                return errorMessage('null', 'invalid_credentials');

            $otpResponse = $this->sendOtpService->generateOTP($request->email, 'employee');
            if ($otpResponse['status'] == false) {
                return errorMessage('null', $otpResponse['message'],);
            } else {
                $user = Auth::guard('employee_api')->user();
                $user->access_token = $user->createToken("HrJee TOKEN")->plainTextToken;
                return apiResponse($otpResponse['message'], $user);
            }
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
    public function profile()
    {
        try {
            $user = Auth::guard('employee_api')->user();
            return apiResponse('user_profile', $user);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
    public function userAllDetails()
    {
        try {
            $user = auth()->guard('employee_api')->user();
            $singleUserDetails = $user->load('assetDetails', 'familyDetails', 'qualificationDetails', 'advanceDetails', 'bankDetails', 'addressDetails', 'pastWorkDetails', 'documentDetails', 'userDetails');
            return apiResponse('user_details', $singleUserDetails);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
    public function logout($request)
    {
        auth()->guard('employee_api')->user()->tokens()->delete();
        return apiResponse('logut');
    }
    public function sendOtp($request, $type)
    {
        try {
            $otpResponse = $this->sendOtpService->generateOTP($request->email, $type);
            if ($otpResponse['status'] == false)
                return errorMessage('null', $otpResponse['message']);
            else
                return apiResponse($otpResponse['message']);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
    public function verifyOtp($request)
    {
        try {
            $data = $request;
            $data['type'] = 'employee';
            $verifyOtpResponse = $this->sendOtpService->verifyOTP($data, 'employee_api');
            if ($verifyOtpResponse) {
                $user = auth()->guard('employee_api')->user();
                // $user->tokens()->delete();
                $user->access_token = $user->createToken("HrJee TOKEN")->plainTextToken;
                return apiResponse('otp_verified', $user);
            } else {
                return errorMessage('null', 'invalid_or_expired_otp');
            }
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }


    public function changePassword($request)
    {
        try {
            #Match The Old Password
            if (!Hash::check($request->old_password, auth()->user()->password))
                return errorMessage('null', 'old_password-not_matched');

            #Update the new Password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            return apiResponse('password_changed');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
    public function updateProfile($request)
    {
        try {

            $data = $request->validated();
            $date = date_create($request->date_of_birth);
            $data['date_of_birth'] = date_format($date, "Y/m/d");
            #Update the new Password
            User::whereId(auth()->user()->id)->update($data);
            return apiResponse('profile_updated');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
