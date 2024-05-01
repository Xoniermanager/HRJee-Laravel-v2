<?php

namespace App\Http\Controllers;

use Exception;
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
    public function userLogin(Request $request)
    {    
            try {
                $validateUser = Validator::make($request->all(),[
                    'email' => 'required|exists:users,email',
                    'password' => 'required'
                ]);
                if ($validateUser->fails()) {
                    return redirect('/admin')->withErrors($validateUser)->withInput();
                }
                $credentials = $request->only('email', 'password');
                if (Auth::attempt($credentials)) {
                    return redirect('/dashboard');
                }
                else{
                    return redirect('/admin')->withErrors($validateUser)->withInput();
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

    return redirect('admin');
}
}




