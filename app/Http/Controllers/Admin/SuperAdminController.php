<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class SuperAdminController extends Controller
{

    public function super_admin_login(Request $request)
    {
        try {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);
    
            if (Auth::guard('super_admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                return redirect()->intended('/super-admin/dashboard');
            }
    
            return redirect()->back()->withInput($request->only('email', 'remember'))->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);

        } catch (\Throwable $th) {
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

}
