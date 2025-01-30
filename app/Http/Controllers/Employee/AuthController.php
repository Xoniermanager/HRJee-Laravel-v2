<?php

namespace App\Http\Controllers\Employee;

use Throwable;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Services\AuthService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\SendOtpRequest;
use App\Http\Services\SendOtpService;
use App\Http\Requests\VerifyOtpRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ChangePasswordRequest;

class AuthController extends Controller
{
    private $userAuthService;
    private $authService;
    private $sendOtpService;

    public function __construct(AuthService $userAuthService, SendOtpService $sendOtpService)
    {
        $this->userAuthService = $userAuthService;
        $this->sendOtpService = $sendOtpService;
    }


    public function index()
    {
        return view('auth.login');
    }

    /**
     * Process user login attempt.
     *
     * This method handles the submission of the login form, validates the user input,
     * and attempts to authenticate the user using Laravel's built-in authentication system.
     *
     */
    public function login(Request $request)
    {
        try {
            $validateUser = Validator::make($request->all(), [
                'email' => 'required|exists:users,email|email',
                'password' => 'required'
            ]);

            if ($validateUser->fails()) {
                return redirect(route('base'))->withErrors($validateUser)->withInput();
            }

            $credentials = $request->only('email', 'password');

            if (!Auth::attempt($credentials)) {
                return Redirect::back()->with('error', 'invalid_credentials');
            } else {
                $user = Auth::user();

                if ($user->status === '0') {
                    return redirect()->back()->with(['error' => 'Your account is not Active. Please Contact to Admin']);
                }

                $genrateOtpresponse = $this->sendOtpService->generateOTP($request->email, $user->type);

                if ($genrateOtpresponse['status'] == true)
                    return redirect('/verify/otp');
                else
                    return redirect('/login')->with('error', $genrateOtpresponse['message']);
            }
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
    public function logout()
    {
        auth()->logout();
        return redirect(route('base'));
    }

    public function verifyOtp()
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        return view('auth.verify-otp');
    }

    public function verifyOtpCheck(VerifyOtpRequest $request)
    {
        try {
            $data = $request->all();
            $data['email'] = auth()->user()->email;
            $data['type'] = auth()->user()->type;


            $verifyOtpResponse = $this->sendOtpService->verifyOTP($data);
            if ($verifyOtpResponse) {
                $user = Auth::user();
                return redirect(
                    $user->type == 'company'
                    ? route('company.dashboard')
                    : route('employee.dashboard')
                );
            } else
                return redirect('/verify/otp')->with('error', 'invalid or expired otp! ');
        } catch (Throwable $th) {
            return Redirect::back()->withErrors($th->getMessage());
        }
    }

    public function resendOtp(Request $request)
    {
        try {
            if (!auth()->guard('employee')->check()) {
                return redirect('/employee/signin');
            }
            $email = Auth::user()->email;
            $otpResponse = $this->sendOtpService->generateOTP($email, 'employee');
            if ($otpResponse['status'] == true)
                return redirect('employee/verify/otp')->with('success', transLang($otpResponse['message']));
            else
                return redirect('employee/verify/otp')->with('error', transLang($otpResponse['message']));
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $updatePassword = Admin::find(Auth()->guard('admin')->user()->id)->update(['password' => Hash::make($request['new_password'])]);
        if ($updatePassword) {
            return back()->with(['success' => 'Password Updated Successfully']);
        } else {
            return back()->with(['error' => 'Something Went Wrong! Please try Again']);
        }
    }
}
