<?php

namespace App\Http\Services;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\RegistrationOtp;
use App\Models\OtpVerification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;



class AuthService 
{
    public function userLogin($request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            $details = [
                'data' => $user,
                'status' => true,
                'message' => 'User Logged In Successfully',
            ];
            return $details;
        } else {
            $details = [
                'status' => false,
                'message' => 'Invalid credentials',
            ];
            return $details;
        }
    }

    public function getOtp($request)
    {

       # User Does not Have Any Existing OTP
       $verificationOtp = OtpVerification::where('email', $request->email)->latest()->first();
       $now = Carbon::now();

       if($verificationOtp && $now->isBefore($verificationOtp['expire_at'])){
          $verification = $verificationOtp;

          $mailData = [
             'email' => $verification['email'],
             'otp_code' => $verification['otp_code'],
          ];
     
          Mail::to($verificationOtp['email'])->send(new RegistrationOtp($mailData));
 
       }else{

          $verification =  OtpVerification::create([
             'otp_type'  => 'registration', 
             'email'     => $request->email,
             'otp_code'  => rand(123456, 999999),
             'expire_at' => Carbon::now()->addMinutes(10)
          ]);
          $mailData = [
             'email' => $verification['email'],
             'otp_code' => $verification['otp_code'],
            ];

          Mail::to($verification['email'])->send(new RegistrationOtp($mailData));
       }

       $details = [
          'data' => $verification,
          'status' => true,
          'message' => 'Otp Sent Successfully'
       ];
       return $details;
    }
    public function verifyOtp($request)
    {
       #Validation Logic
       $verificationCode   = OtpVerification::where('email', $request->email)->where('otp_code', $request->otp)->first();
       $now = Carbon::now();
 
       if (!$verificationCode) {
           $details = [
             'status' => false,
             'message' => 'Your OTP is not correct'
          ];
          return $details;
       }elseif($verificationCode && $now->isAfter($verificationCode['expire_at'])){
          $details = [
             'status' => false,
             'message' => 'Your OTP has been expired'
          ];
          return $details;
       }else{
          # Expire The OTP
          $expireOtp = $verificationCode->update([ 'expire_at' => Carbon::now()]);
          $details = [
             'data' => $expireOtp,
             'status' => true,
             'message' => 'Your OTP has been verified'
          ];
          return $details;
       }
    } 

}