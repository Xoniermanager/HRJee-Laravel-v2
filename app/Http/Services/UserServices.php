<?php

namespace App\Http\Services;

use App\Mail\ResetPassword;
use App\Models\User;
use App\Models\UserCode;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Throwable;

class UserServices
{
  private $userRepository;
  public function __construct(UserRepository $userRepository)
  {
    $this->userRepository = $userRepository;
  }

  public function forgetPassword($request)
  {
    try {
      $code = generateOtp();
      UserCode::updateOrCreate(['email' => $request->email], [
        'email'  => $request->email,
        'type'  => 'user',
        'code'  => $code,
      ]);

      $mailData = [
        'email' => $request->email,
        'otp_code' => $code,
        'expire_at' => Carbon::now()->addMinutes(2)->format("H:i A")
      ];
      Mail::to($request->email)->send(new ResetPassword($mailData));

      return true;
    } catch (Throwable $th) {
      return false;
    }
  }
}
