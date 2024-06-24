<?php

namespace App\Http\Services\Api;


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
    public function login($request)
    {
        try {

            if (!Auth::attempt($request->only(['email', 'password'])))
                return errorMessage('null', 'invalid_credentials');

            return apiResponse('login_success', ['email' => $request->email, 'password' => $request->password]);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
    public function profile($request)
    {
        try {
            $user = Auth::user();
            return apiResponse('user_profile', $user);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
    public function logout($request)
    {
        auth()->user()->tokens()->delete();
        return apiResponse('logut');
    }
    public function sendOtp($request)
    {
        try {

            $code = generateOtp();
            UserCode::updateOrCreate(['email' => $request->email], [
                'user_id'  => $request->email,
                'type'  => 'user',
                'code'  => $code,
            ]);
            $mailData = [
                'email' => $request->email,

                'otp_code' => $code,
                'expire_at' => Carbon::now()->addMinutes(2)->format("H:i A")
            ];

            Mail::to($request->email)->send(new LoginVerification($mailData));
            return apiResponse('otp_sent_on_mail', $mailData);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
    public function verifyOtp($request)
    {
        try {
            $find = UserCode::where(['email' => $request['email'], 'code' => $request['otp'], 'type' => 'user'])
                ->where('updated_at', '>=', now()->subMinutes(2))
                ->first();
            if ($find) {
                if (Auth::attempt($request->only(['email', 'password'])))
                    $user = User::where('email', $request['email'])->first();
                else
                    return errorMessage('null', 'invalid_credentials');


                $user->tokens()->delete();

                $user->access_token = $user->createToken("HrJee TOKEN")->plainTextToken;
                Session::put('user_2fa', auth()->user()->id);
                return apiResponse('otp_verify', $user);
            } else {
                return errorMessage('null', 'invalid otp or expired');
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
            $data = $request->all();
            $date = date_create($request->date_of_birth);
            $data['date_of_birth'] = date_format($date, "Y/m/d");
            #Update the new Password
            User::whereId(auth()->user()->id)->update($data);
            return apiResponse('profile_updATED');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
