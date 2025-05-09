<?php

namespace App\Http\Controllers\Employee;

use Throwable;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\SendOtpService;
use App\Http\Requests\VerifyOtpRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UserChangePasswordRequest;

class AuthController extends Controller
{
    private $sendOtpService;

    public function __construct(SendOtpService $sendOtpService)
    {
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
                return back()->withErrors($validateUser)->withInput();
            }
            // Fetch user manually
            $user = User::where('email', $request->email)->first();

            // $credentials = $request->only('email', 'password');
            // if (!Auth::attempt($credentials)) {
            //     return back()->with('error', 'Your credentials are not correct. Please enter valid credentials.');
            // }
            if (!$user || !Hash::check($request->password, $user->password)) {
                return redirect()->back()
                    ->withInput()
                    ->with(['error' => 'These credentials do not match our records.']);
            }
            else {
                // $user = Auth::user();
                if ($user->status == '0') {
                    return redirect()->back()->with(['error' => 'Your Account is not Active. Please Contact to Admin']);
                }
                
                $companyDetails = $user->companyDetails;
                
                if ($companyDetails->subscription_expiry_date < date('Y-m-d')) {
                    return redirect()->back()->with(['error' => 'Your subscription has been expired. Please Contact to Admin']);
                }

                $genrateOtpresponse = $this->sendOtpService->generateOTP($request->email, $user->type);
                if ($genrateOtpresponse['status'] == true){
                    session(['otp_pending_user' => $user->id]);
                    return redirect('/verify/otp')->with('message',$genrateOtpresponse['message']);
                }  
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
        // if (!auth()->check()) {
        //     return redirect('/login');
        // }

        return view('auth.verify-otp');
    }

    public function verifyOtpCheck(VerifyOtpRequest $request)
    {
        try {
            $data = $request->all();
            $userId = session('otp_pending_user');
            if (!$userId) {
                return redirect('/login')->with('error', 'Session expired. Please login again.');
            }
            $user = User::find($userId);
            
            if (!$user) {
                return redirect('/login')->with('error', 'User not found.');
            }
            $data['email'] = $user->email;
            $data['type'] = $user->type;
            $data['id'] = $user->id;


            $verifyOtpResponse = $this->sendOtpService->verifyOTP($data);
            if ($verifyOtpResponse) {
                // OTP is correct, now login the user
                Auth::login($user);

                // Clear the session key
                session()->forget('otp_pending_user');

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
    public function adminChangePassword(ChangePasswordRequest $request)
    {
        $updatePassword = Admin::find(Auth()->guard('admin')->user()->id)->update(['password' => Hash::make($request['new_password'])]);
        if ($updatePassword) {
            return back()->with(['success' => 'Password Updated Successfully']);
        } else {
            return back()->with(['error' => 'Something Went Wrong! Please try Again']);
        }
    }
    public function userUpdateChangePassword(UserChangePasswordRequest $request)
    {
        $credential = $request->validated();
        try {
            $response = User::find(Auth()->user()->id)->update(['password' => Hash::make($credential['password'])]);
            if ($response == true) {
                return response()->json([
                    'status' => 200,
                    'success' => true,
                    'message' => "Password has been changed successfully"
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
