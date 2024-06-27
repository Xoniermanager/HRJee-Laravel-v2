<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserForgetPasswordRequest;
use App\Http\Requests\UserResetPasswordRequest;
use App\Http\Services\SendOtpService;
use App\Mail\ResetPassword;
use App\Models\User;
use App\Models\UserCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ForgotPasswordController extends Controller
{
    private $sendOtpService;
    public function __construct(SendOtpService $sendOtpService)
    {
        $this->sendOtpService = $sendOtpService;
    }

    public function forgotPassword(UserForgetPasswordRequest $request)
    {

        try {
            $code = generateOtp();
            $email = $request->email;
            $user = User::where('email', $email)->first();
            if (empty($user))
                return errorMessage('null', 'email is invalid');

            $mailData = $this->sendOtpService->update($email, 'user', $code);
            if ($mailData)
                return apiResponse('otp_sent_on_mail', ['status' => true, 'email' => $request->email, 'otp' => $code]);
            else
                return apiResponse('invalid_mail',  ['status' => false, 'email' => $request->email, 'otp' => $code]);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }


    public function resetPassword(UserResetPasswordRequest $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if (empty($user))
                return errorMessage('null', 'invalid email');

            $user->update(['password' => Hash::make($request->password)]);
            $user->tokens()->delete();
            return apiResponse('password_reset');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
