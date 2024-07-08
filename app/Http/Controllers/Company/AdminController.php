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
            $validateUser = Validator::make($request->all(), [
                'email' => 'required|exists:company_users,email',
                'password' => 'required'
            ]);
            if ($validateUser->fails()) {
                return  Redirect::back()->withErrors($validateUser)->withInput();
            }

            $data = $request->only('email', 'password');
            if (!Auth::guard('admin')->attempt($data)) {
                return Redirect::back()->with('error', 'invalid_credentials');
            } else {
                $genrateOtpresponse = $this->sendOtpService->generateOTP($request->email, 'admin');
                if ($genrateOtpresponse['status'] == true)
                    return redirect('company/verify/otp');
                else
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
        Auth()->guard('admin')->logout();
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
        if (!auth()->guard('admin')->check()) {
            return  redirect('/company/signin');
        }
        return view('company-verify-otp');
    }

    public function verifyOtpCheck(VerifyOtpRequest $request)
    {
        try {
            $data = $request->all();
            $data['email'] = auth()->guard('admin')->user()->email;
            $data['type'] = 'admin';
            $verifyOtpResponse = $this->sendOtpService->verifyOTP($data);
            if ($verifyOtpResponse)
                return redirect('company/dashboard');
            else
                return redirect('company/verify/otp')->with('error',  'invalid_or_expired_otp');
        } catch (Throwable $th) {
            return Redirect::back()->withErrors($th->getMessage());
        }
    }

    public function super_admin_login_form()
    {
        return view('super_admin.account.login');
    }


    public function resendOtp(Request $request)
    {
        try {
            if (!auth()->guard('admin')->check()) {
                return   redirect('/company/signin');
            }
            $email = auth()->guard('admin')->user()->email;
            $otpResponse = $this->sendOtpService->generateOTP($email, 'admin');
            if ($otpResponse['status'] == true)
                return redirect('company/verify/otp')->with('success',  transLang($otpResponse['message']));
            else
                return redirect('company/verify/otp')->with('error',  transLang($otpResponse['message']));
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
