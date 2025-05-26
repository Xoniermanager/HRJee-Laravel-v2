<?php

namespace App\Http\Services;

use App\Mail\ResetPassword;
use App\Models\User;
use App\Models\UserCode;
use App\Repositories\SkillRepository;
use App\Repositories\UserOtpRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class SendOtpService
{
  private $userOtpRepository;
  public function __construct(UserOtpRepository $userOtpRepository)
  {
    $this->userOtpRepository = $userOtpRepository;
  }

  /**
   * Undocumented function
   *
   * @param [type] $email
   * @param [type] $type
   * @return void
   */
  public function generateOTP($email, $type)
  {
    $checkOTPExists = ['email' => $email, 'type' => $type];
    // Create OTP
    $code = generateOtp();
    $userOtpDetails = ['code'  => $code,'updated_at' => Carbon::now()];
    $update = $this->userOtpRepository->updateOrCreate($checkOTPExists, $userOtpDetails);
    if ($update) {
      $mailData = [
        'email' => $email,
        'otp_code' => $code,
        'expire_at' => Carbon::now()->addMinutes(2)->format("H:i A")
      ];
    $checkValid = Mail::to($email)->send(new ResetPassword($mailData));
      $checkValid = true;
      if ($checkValid)
        return ['status' => true, 'message' => 'otp_sent_on_mail'];
      else
        return ['status' => false, 'message' => 'error_while_sending_mail'];
    }
  }

  /**
   * Undocumented function
   *
   * @param [type] $data
   * @param string $guardType
   * @param string $requestType
   * @return void
   */
  public function verifyOTP($data, $guardType = '', $requestType = "")
  {
    $find = UserCode::where(['email' => $data['email'], 'code' => $data['otp'], 'type' => $data['type']])
      ->where('updated_at', '>=', now()->subMinutes(20))
      ->first();

    if ($find) {
      if($requestType == "api") {
        return ['status' => true, 'message' => 'otp_sent_on_mail'];
      } else {
        if($data['id']) {
          Session::put('user_2fa', $data['id']);
        } else {
          Session::put('user_2fa', Auth::guard($guardType)->user()->id);
        }
        // if($guardType){
          // Session::put('user_2fa', Auth::guard($guardType)->user()->id);
        //   Session::put('user_2fa', $data['id']);
        // }else{
          // Session::put('user_2fa', Auth::guard($guardType)->user()->id);
        // }

        return true;
      }

    }
    else {
      return false;
    }
  }

  /**
   * Undocumented function
   *
   * @param [type] $email
   * @param [type] $type
   * @param [type] $code
   * @return void
   */
  public function update($email,$type, $code)
  {
    UserCode::where('email', $email)->delete();
    UserCode::create(['email' => $email, 'code' => $code, 'type' => $type]);

    return true;
  }

}
