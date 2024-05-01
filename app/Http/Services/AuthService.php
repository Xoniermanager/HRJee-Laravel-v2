<?php

namespace App\Http\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;



class AuthService 
{
    public function userLogin($request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            $details = [
                'data' => $user,
                'status' => true,
                'message' => 'User Logged In Successfully',
            ];
            return $details;
        } else {
            $details = [
                'status' => false,
                'message' => 'Invalid credentials',
            ];
            return $details;
        }
    }

}