<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Http\Requests\VerifyOtpRequest;
use App\Http\Services\SendOtpService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AdminAuthController extends Controller
{
    private $authService, $sendOtpService;

    public function __construct(SendOtpService $sendOtpService)
    {
        $this->sendOtpService = $sendOtpService;
    }
    public function admin_login(Request $request)
    {
        // Validate login form data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:admin,email',
            'password' => 'required',
        ]);

        // If validation fails, redirect back with errors and old input
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            // Fetch user manually
            $admin = Admin::where('email', $request->email)->first();

            // Attempt to authenticate the user
            // if (!Auth::guard('admin')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            //     return redirect()->back()
            //         ->withInput()
            //         ->with(['error' => 'These credentials do not match our records.']);
            // }

            if (!$admin || !Hash::check($request->password, $admin->password)) {
                return redirect()->back()
                    ->withInput()
                    ->with(['error' => 'These credentials do not match our records.']);
            }

            // If login is successful, generate OTP
            $generateOtpResponse = $this->sendOtpService->generateOTP($request->email, 'admin');
            if ($generateOtpResponse['status'] === true) {
                // Save user id or email in session temporarily
                session(['otp_pending_admin' => $admin->id]);

                return redirect('/admin/verify/otp');
            } else {
                return redirect('/admin/login')->with('error', $generateOtpResponse['message']);
            }
        } catch (Throwable $th) {
            return redirect()->back()
                ->withInput()
                ->with(['error' => $th->getMessage() ?? 'Something went wrong. Please try again later.']);
        }

    }
    public function login()
    {

        return view('admin.account.login');
    }

    public function verifyOtp()
    {

        return view('admin-verify-otp');
    }
    public function verifyOtpCheck(VerifyOtpRequest $request)
    {
        try {

            $data = $request->all();
            $adminId = session('otp_pending_admin');
            if (!$adminId) {
                return redirect('/admin/login')->with('error', 'Session expired. Please login again.');
            }

            $admin = Admin::find($adminId);

            if (!$admin) {
                return redirect('/admin/login')->with('error', 'Admin not found.');
            }
            // $data['email'] = auth()->guard('admin')->user()->email;

            $data['email'] = $admin->email;
            $data['type'] = 'admin';
            $data['id'] = $admin->id;

            $verifyOtpResponse = $this->sendOtpService->verifyOTP($data, 'admin');
            if ($verifyOtpResponse) {
                // OTP is correct, now login the user
                Auth::guard('admin')->login($admin);

                // Clear the session key
                session()->forget('otp_pending_admin');
                return redirect(route('admin.dashboard'));
            }
            else
                return redirect('/admin/verify/otp')->with('error', 'invalid or expired otp! ');
        } catch (Throwable $th) {
            return Redirect::back()->withErrors($th->getMessage());
        }
    }

    public function resendOtp(Request $request)
    {
        try {
            if (!auth()->guard('admin')->check()) {
                return redirect('/admin/login');
            }
            $email = auth()->guard('admin')->user()->email;
            $otpResponse = $this->sendOtpService->generateOTP($email, 'admin');
            if ($otpResponse['status'] == true)
                return redirect('admin/verify/otp')->with('success', transLang($otpResponse['message']));
            else
                return redirect('admin/verify/otp')->with('error', transLang($otpResponse['message']));
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
    public function adminLogout()
    {
        Auth()->guard('admin')->logout();
        return redirect(route('admin.login'));
    }
}
