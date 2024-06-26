<?php

namespace App\Http\Controllers\Company;

use App\Http\Requests\VerifyOtpRequest;
use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\AuthService;
use App\Http\Services\SendOtpService;
use App\Models\CompanyUser;
use App\Models\UserCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
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
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flash('success', 'You have been logged out.');

        return redirect('signin');
    }

    public function signup()
    {
        return view('signup');
    }
    public function signin()
    {
        return view('signin');
    }
    public function verifyOtp()
    {
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
}
