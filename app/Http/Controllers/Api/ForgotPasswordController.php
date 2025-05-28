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
            // Validation rules
            $validator = Validator::make($request->all(), [
                'emp_id' => 'required_without:email|string|exists:user_details,emp_id',
                'email' => 'required_without:emp_id|nullable|email|exists:users,email',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => 'validation_error',
                    'message' => implode(', ', $validator->errors()->all()), // single string
                ], 400);
            }
            $code = generateOtp();

            // Generate OTP
            $code = "1234"; // or use generateOtp();

            // Determine login field
            $loginField = $request->filled('email') ? 'email' : 'emp_id';
            $loginValue = $request->input($loginField);

            // Get the email
            if ($loginField === 'email') {
                $email = $request->email;
            } else {
                $email = User::whereHas('details', function ($query) use ($loginValue) {
                    $query->where('emp_id', $loginValue);
                })
                ->pluck('email')
                ->first();
            }

            // Send OTP
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
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Mail could not be sent because the email address is invalid.',
                    'data' => [],
                ], 200);
            }

        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }

    }

    public function resetPassword(Request $request)
    {

        try {
            $validator = Validator::make($request->all(), [
                'emp_id' => 'required_without:email|string|exists:user_details,emp_id',
                'email' => 'required_without:emp_id|nullable|email|exists:users,email',
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

            $loginField = $request->filled('email') ? 'email' : 'emp_id';
            $loginValue = $request->input($loginField);

            // Get the email
            if ($loginField === 'email') {
                $email = $request->email;
            } else {
                $email = User::whereHas('details', function ($query) use ($loginValue) {
                    $query->where('emp_id', $loginValue);
                })
                ->pluck('email')
                ->first();
            }


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
