<?php

namespace App\Http\Controllers\Company;

use App\Http\Requests\VerifyOtpRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\AuthService;
use App\Http\Services\SendOtpService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Illuminate\Support\Facades\Cookie;

class AdminController extends Controller
{
    private  $authService, $sendOtpService;

    public function __construct(AuthService $authService, SendOtpService $sendOtpService)
    {
        $this->authService = $authService;
        $this->sendOtpService = $sendOtpService;
    }



    /**
     * Process user login attempt.
     *
     * This method handles the submission of the login form, validates the user input,
     * and attempts to authenticate the user using Laravel's built-in authentication system.
     *
     */
    public function companyLogin(Request $request)
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
            if (!Auth::guard('company')->attempt($request->only('email', 'password'))) {
                return redirect()->back()->with(['error' => 'These credentials do not match our records.']);
            } else {
                Cookie::queue(Cookie::make('user_name', $request->email, 360));
                Cookie::queue(Cookie::make('password', $request->password, 360));
                $genrateOtpresponse = $this->sendOtpService->generateOTP($request->email, 'company');
                if ($genrateOtpresponse['status'] == true) {
                    return redirect('company/verify/otp');
                } else
                    return redirect('company/signin')->with('error', $genrateOtpresponse['message']);
            }
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    /**
     * Process user logout.
     *
     * This method logs out the authenticated user, clears the session data,
     * and redirects the user to the login page.
     */
    public function companyLogout()
    {
        Auth()->guard('company')->logout();
        return redirect(route('signin'));
    }

    public function signup()
    {
        return view('company.signup');
    }
    public function signin()
    {
        return view('company.signin');
    }
    public function verifyOtp()
    {
        if (!auth()->guard('company')->check()) {
            return  redirect('/company/signin');
        }
        return view('company-verify-otp');
    }

    public function verifyOtpCheck(VerifyOtpRequest $request)
    {
        try {

            $data = $request->all();
            $data['email'] = auth()->guard('company')->user()->email;
            $data['type'] = 'company';
            $verifyOtpResponse = $this->sendOtpService->verifyOTP($data);
            if ($verifyOtpResponse)
                return redirect('company/dashboard');
            else
                return redirect('company/verify/otp')->with('error',  'invalid_or_expired_otp');
        } catch (Throwable $th) {
            return Redirect::back()->withErrors($th->getMessage());
        }
    }

    public function admin_login_form()
    {
        return view('admin.account.login');
    }


    public function resendOtp(Request $request)
    {
        try {
            if (!auth()->guard('company')->check()) {
                return   redirect('/company/signin');
            }
            $email = auth()->guard('company')->user()->email;
            $otpResponse = $this->sendOtpService->generateOTP($email, 'company');
            if ($otpResponse['status'] == true)
                return redirect('company/verify/otp')->with('success',  transLang($otpResponse['message']));
            else
                return redirect('company/verify/otp')->with('error',  transLang($otpResponse['message']));
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
