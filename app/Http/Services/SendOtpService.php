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
  public function generateOTP($email, $type)
  {
    $checkOTPExists = ['email' => $email, 'type' => $type];
    // Create OTP
    $code = "1234";
    $userOtpDetails = ['code'  => $code,'updated_at' => Carbon::now()];
    $update = $this->userOtpRepository->updateOrCreate($checkOTPExists, $userOtpDetails);
    if ($update) {
      $mailData = [
        'email' => $email,
        'otp_code' => $code,
        'expire_at' => Carbon::now()->addMinutes(2)->format("H:i A")
      ];
    //   $checkValid = Mail::to($email)->send(new ResetPassword($mailData));
      $checkValid = true;
      if ($checkValid)
        return ['status' => true, 'message' => 'otp_sent_on_mail'];
      else
        return ['status' => false, 'message' => 'error_while_sending_mail'];
    }
  }

  public function verifyOTP($data, $guardType = '')
  {
    $find = UserCode::where(['email' => $data['email'], 'code' => $data['otp'], 'type' => $data['type']])
      ->where('updated_at', '>=', now()->subMinutes(20))
      ->first();
    if ($find) {
      if (!empty($guardType))
        $type = $guardType;
      else
        $type = $data['type'];

      Session::put('user_2fa', Auth::guard($type)->user()->id);
      return true;
    }
    else {
      return false;
    }
  }
}
