<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyOtpRequest;
use App\Http\Services\SendOtpService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Throwable;

class SuperAdminController extends Controller
{
    private  $authService, $sendOtpService;

    public function __construct(SendOtpService $sendOtpService)
    {
        $this->sendOtpService = $sendOtpService;
    }
    public function admin_login(Request $request)
    {
        try {
            // Validate login form data
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            // If validation fails, return the error messages
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            // If authentication fails, redirect back with an error message
            if (!Auth::guard('admin')->attempt($request->only('email', 'password'))) {
                return redirect()->back()->with(['error' => 'These credentials do not match our records.']);
            } else {
                $generateOtpResponse = $this->sendOtpService->generateOTP($request->email, 'admin');
                if ($generateOtpResponse['status'] === true) {
                    return redirect('/admin/verify/otp');
                } else {
                    return redirect('/signin')->with('error', $generateOtpResponse['message']);
                }
            }
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function login()
    {
        return view('admin.account.login');
    }

    public function verifyOtp()
    {
        if (!auth()->guard('admin')->check()) {
            return  redirect('/admin/login');
        }
        return view('admin-verify-otp');
    }
    public function verifyOtpCheck(VerifyOtpRequest $request)
    {
        try {
            $data = $request->all();
            $data['email'] = auth()->guard('admin')->user()->email;
            $data['type'] = 'admin';
            $verifyOtpResponse = $this->sendOtpService->verifyOTP($data);
            if ($verifyOtpResponse)
                return redirect('/admin/dashboard');
            else
                return redirect('/admin/verify/otp')->with('error',  'invalid or expired otp! ');
        } catch (Throwable $th) {
            return Redirect::back()->withErrors($th->getMessage());
        }
    }

    public function resendOtp(Request $request)
    {
        try {
            if (!auth()->guard('admin')->check()) {
                return   redirect('/admin/login');
            }
            $email = auth()->guard('admin')->user()->email;
            $otpResponse = $this->sendOtpService->generateOTP($email, 'admin');
            if ($otpResponse['status'] == true)
                return redirect('admin/verify/otp')->with('success',  transLang($otpResponse['message']));
            else
                return redirect('admin/verify/otp')->with('error',  transLang($otpResponse['message']));
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
