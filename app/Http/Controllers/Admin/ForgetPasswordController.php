<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\WelcomeEmail;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
class ForgetPasswordController extends Controller
{
    public function index()
    {
        return view('admin.account.forgetPassword');
    }
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admin',
        ]);

        $token = Str::random(64);
        DB::table('password_reset_tokens')->updateOrInsert(
            [
                'email' => $request->email
            ],
            ['token' => $token, 'created_at' => Carbon::now()]
        );
        Mail::send('email.forgetPasswordLinkAdmin', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }
    public function showResetPasswordForm($token)
    {
        return view('admin.account.reset-password', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admin',
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
        $user = Admin::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();
        if ($user == 1) {
            Mail::to($request->email)->send(new WelcomeEmail());
        }
        return back()->with('message', 'Your password has been changed!');
    }
}
