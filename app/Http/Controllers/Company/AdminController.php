<?php

namespace App\Http\Controllers\Company;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    private  $authService; 

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;

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
                $validateUser = Validator::make($request->all(),[
                    'email' => 'required|exists:companies,email',
                    'password' => 'required'
                ]);
                if ($validateUser->fails()) {
                    return redirect('/signin')->withErrors($validateUser)->withInput();
                }
                $credentials = $request->only('email', 'password');
                if (Auth::guard('admin')->attempt($credentials)) {
                    
                    return redirect('/dashboard');
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

public function super_admin_login_form()
{        
    return view('super_admin.account.login');
}

}




