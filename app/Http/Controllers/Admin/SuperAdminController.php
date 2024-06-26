<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyOtpRequest;
use App\Http\Services\SendOtpService;
use App\Models\UserCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Throwable;

class SuperAdminController extends Controller
{
    private  $authService, $sendOtpService;

    public function __construct(SendOtpService $sendOtpService)
    {
        $this->sendOtpService = $sendOtpService;
    }


    public function super_admin_login(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            // if (Auth::guard('super_admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            //     return redirect()->intended('/super-admin/dashboard');
            // }

            // return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
            //     'email' => 'The provided credentials do not match our records.',
            // ]);


            if (!Auth::guard('super_admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                    'email' => 'The provided credentials do not match our records.',
                ]);
            } else {
                $email = $request->email;
                $genrateOtpresponse = $this->sendOtpService->generateOTP($email, 'super_admin');
                if ($genrateOtpresponse['status'] == true)
                    return redirect('/admin/verify/otp');
                else
                    return redirect('/signin')->with('error', $genrateOtpresponse['message']);
                
            }
        } catch (Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    // public function logout(Request $request)
    // {
    //     Auth::logout();
    //     $request->session()->flash('success', 'You have been logged out.');

    //     return redirect('signin');
    // }

    // public function signup()
    // {        
    //     return view('signup');
    // }
    // public function signin()
    // {        
    //     return view('signin');
    // }

    public function login()
    {
        return view('super_admin.account.login');
    }

    public function verifyOtp()
    {
        return view('admin-verify-otp');
    }
    public function verifyOtpCheck(VerifyOtpRequest $request)
    {
        try {
            $data = $request->all();
            $data['email'] = auth()->guard('super_admin')->user()->email;
            $data['type'] = 'super_admin';
            $verifyOtpResponse = $this->sendOtpService->verifyOTP($data);
            if ($verifyOtpResponse)
                return redirect('/admin/dashboard');
            else
                return redirect('/verify/otp')->with('error', transLang($verifyOtpResponse['message']));
        } catch (Throwable $th) {
            return Redirect::back()->withErrors($th->getMessage());
        }
    }
}
