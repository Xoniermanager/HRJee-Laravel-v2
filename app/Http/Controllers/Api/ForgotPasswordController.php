<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

    public function forgotPassword(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email', 'exists:users'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "error" => 'validation_error',
                    "message" => $validator->errors(),
                ], 400);
            }

            $code = generateOtp();
            $code = "1234";
            $email = $request->email;
            $mailData = $this->sendOtpService->update($email, 'user', $code);
            if ($mailData) {

                Mail::send('email.send_otp', ['code' => $code], function ($message) use ($email) {
                    $message->to($email);
                    $message->subject('Reset Password');
                });

                return response()->json([
                    'status' => true,
                    'message' => 'OTP has been sent on your mail',
                    'data' => [],
                ], 200);
            }
            else
                return apiResponse('invalid_mail',  ['status' => false, 'email' => $request->email, 'otp' => $code]);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }

    public function resetPassword(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'email' => ['required', 'email', 'exists:users'],
                'otp' => ['required'],
                'password' => ['required','string','min:8'],
                'confirm_password' => ['required','same:password']
            ]);

            if ($validator->fails()) {

                return response()->json([
                    "error" => 'validation_error',
                    "message" => $validator->errors(),
                ], 400);
            }

            $email = $request->email;

            $code = UserCode::where(['email' => $email, 'code' => $request->otp, 'type' => 'user'])->where('updated_at', '>=', now()->subMinutes(20))->first();

            if($code) {
                User::where('email', $email)->update(['password' => Hash::make($request->password)]);
                return response()->json([
                    'status' => true,
                    'message' => 'Password updated successfully',
                    'data' => [],
                ], 200);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid OTP!',
                    'data' => [],
                ], 200);
            }
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }


    // public function resetPassword(UserResetPasswordRequest $request)
    // {
    //     try {
    //         $user = User::where('email', $request->email)->first();
    //         if (empty($user))
    //             return errorMessage('null', 'invalid email');

    //         $user->update(['password' => Hash::make($request->password)]);
    //         $user->tokens()->delete();
    //         return apiResponse('password_reset');
    //     } catch (Throwable $th) {
    //         return exceptionErrorMessage($th);
    //     }
    // }
}
