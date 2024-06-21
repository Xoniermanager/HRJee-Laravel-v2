<?php

namespace App\Http\Services\Api;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AuthService
{
    public function login($request)
    {
        try {
            $validateUser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required'
                ]
            );

            if ($validateUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            if (!Auth::attempt($request->only(['email', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Email & Password does not match with our record.',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            $user->tokens()->delete();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function profile($request)
    {
        try {
            $user = Auth::user();
            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'data' => $user,
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
    public function logout($request)
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            "message" => "logged out"
        ]);
    }
    public function changePassword($request)
    {

        # Validation
        $validateUser = Validator::make(
            $request->all(),
            [
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
            ]
        );


        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }
        #Match The Old Password
        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return response()->json([
                'status' => false,
                "error" => "Old Password Doesn't match!"
            ], 500);
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return response()->json([
            'status' => true,
            "message" => "Password changed successfully!"
        ], 200);
    }
    public function updateProfile($request)
    {

        # Validation
        $validateUser = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:100',
                'father_name' => 'required|string|max:100',
                'mother_name' => 'required|string|max:100',
                'blood_group' => 'required|in:A+, A-, B+, B-, O-, O+',
                'gender' => 'required|in:M,F,O',
                'marital_status' => 'required|in:M,S',
                'phone' => 'required|min:5|max:20',
                'profile_image' => 'nullable',
                'date_of_birth' => 'required|date|before:' . now()->subYears(18)->toDateString(),
            ]
        );


        if ($validateUser->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }


        $data = $request->all();
        $date = date_create($request->date_of_birth);
        $data['date_of_birth'] = date_format($date, "Y/m/d");
        #Update the new Password
        User::whereId(auth()->user()->id)->update($data);
        return response()->json([
            'status' => true,
            "message" => "Profile Updated successfully!"
        ], 200);
    }
}
