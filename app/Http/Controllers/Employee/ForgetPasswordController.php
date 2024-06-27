<?php

namespace App\Http\Controllers\Employee;

use DB;
use Carbon\Carbon;
use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgetPasswordController extends Controller
{
    public function index()
    {
        return view('forgetPassword');
    }
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);
        DB::table('password_reset_tokens')->updateOrInsert(
            [
                'email' => $request->email
            ],
            ['token' => $token, 'created_at' => Carbon::now()]
        );
        Mail::send('email.forgetPasswordLink', ['token' => $token], function ($message) use ($request) {
            $message->to('arjun@xoniertechnologies.com');
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }
    public function showResetPasswordForm($token)
    {
        return view('reset-password', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();
        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Not Allowed!! Your Password is Already Changed');
        }
        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();
        if ($user == 1) {
            Mail::to('arjun@xoniertechnologies.com')->send(new WelcomeEmail());
        }
        return back()->with('message', 'Your password has been changed!');
    }
}
