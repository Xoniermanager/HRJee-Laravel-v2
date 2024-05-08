<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    private  $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        return view('login');
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
                'email' => 'required|exists:users,email',
                'password' => 'required'
            ]);
            if ($validateUser->fails()) {
                return redirect(route('employee'))->withErrors($validateUser)->withInput();
            }
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                return redirect(route('employee.dashboard'));
            } else {
                return redirect(route('employee'))->withErrors($validateUser)->withInput();
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

        return redirect(route('employee'));
    }
}
