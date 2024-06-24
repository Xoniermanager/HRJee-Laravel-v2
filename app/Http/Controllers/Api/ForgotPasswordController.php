<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserForgetPasswordRequest;
use App\Http\Requests\UserResetPasswordRequest;
use App\Http\Services\UserServices;
use App\Mail\ResetPassword;
use App\Models\User;
use App\Models\UserCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Throwable;

class ForgotPasswordController extends Controller
{
    private $userServices;
    public function __construct(UserServices $userServices)
    {
        $this->userServices = $userServices;
    }

    public function forgotPassword(UserForgetPasswordRequest $request)
    {

        try {

            $email = $request->email;
            $user = User::where('email', $email)->first();
            if (empty($user))
                return errorMessage('null', 'email is invalid');

            $mailData = $this->userServices->forgetPassword($request);

            if ($mailData)
                return apiResponse('otp_sent_on_mail', $user);
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
