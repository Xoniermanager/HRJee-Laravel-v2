<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendOtpRequest;
use App\Http\Requests\VerifyOtpRequest;
use Illuminate\Http\Request;
use App\Http\Services\AuthService;
use App\Http\Services\SendOtpService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Throwable;

class AuthController extends Controller
{
    private $userAuthService;
    private  $authService;
    private  $sendOtpService;

    public function __construct(AuthService $userAuthService, SendOtpService $sendOtpService)
    {
        $this->userAuthService = $userAuthService;
        $this->sendOtpService = $sendOtpService;
    }


    public function index()
    {
        return view('employee.login');
    }

    /**
     * Process user login attempt.
     *      
     * This method handles the submission of the login form, validates the user input,
     * and attempts to authenticate the user using Laravel's built-in authentication system.
     *
     */
    public function employeeLogin(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'email' => 'required|exists:users,email|email',
                'password' => 'required'
            ]);
            if ($validateUser->fails()) {
                return redirect(route('employee'))->withErrors($validateUser)->withInput();
            }
            $credentials = $request->only('email', 'password');

            if (!Auth::guard('employee')->attempt($credentials)) {
                return Redirect::back()->with('error', 'invalid_credentials');
            } else {
                $genrateOtpresponse = $this->sendOtpService->generateOTP($request->email, 'employee');
                if ($genrateOtpresponse['status'] == true)
                    return redirect('/employee/verify/otp');
                else
                    return redirect('/employee/signin')->with('error', $genrateOtpresponse['message']);
            }



            // if (!Auth::guard('admin')->attempt($credentials)) {
            //  return redirect(route('employee.dashboard'));
            //     return redirect('/dashboard');
            // } else {
            //     $code = generateOtp();
            //     $email = $request->email;

            //     $mailData = $this->sendOtpService->update($email, 'company', $code);
            //     if ($mailData) {
            //         Session::put('email', $request->email);
            //         Session::put('password', $request->password);
            //         return redirect('/verify/otp');
            //     }

            // }
        } catch (\Throwable $th) {
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
    public function emoloyeeLogout()
    {
        auth()->guard('employee')->logout();
        return redirect(route('employee'));
    }

    public function verifyOtp()
    {
        if (!auth()->guard('employee')->check()) {
            return  redirect('/employee/signin');
        }
        return view('employee-verify-otp');
    }

    public function verifyOtpCheck(VerifyOtpRequest $request)
    {
        try {
            $data = $request->all();
            $data['email'] = auth()->guard('employee')->user()->email;
            $data['type'] = 'employee';
            $verifyOtpResponse = $this->sendOtpService->verifyOTP($data);
            if ($verifyOtpResponse)
                return redirect(route('employee.dashboard'));
            else
                return redirect('employee/verify/otp')->with('error',  'invalid or expired otp! ');
        } catch (Throwable $th) {
            return Redirect::back()->withErrors($th->getMessage());
        }
    }

    public function resendOtp(Request $request)
    {
        try {
            if (!auth()->guard('employee')->check()) {
                return   redirect('/employee/signin');
            }
            $email = Auth::guard('employee')->user()->email;
            $otpResponse = $this->sendOtpService->generateOTP($email, 'employee');
            if ($otpResponse['status'] == true)
                return redirect('employee/verify/otp')->with('success',  transLang($otpResponse['message']));
            else
                return redirect('employee/verify/otp')->with('error',  transLang($otpResponse['message']));
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }
}
