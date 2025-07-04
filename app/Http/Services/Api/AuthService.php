<?php

namespace App\Http\Services\Api;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\SendOtpService;
use Illuminate\Support\Facades\Password;
use App\Http\Services\UserDocumentDetailServices;

class AuthService
{
    private $sendOtpService, $userDocumentDetailsService;

    public function __construct(SendOtpService $sendOtpService, UserDocumentDetailServices $userDocumentDetailsService)
    {
        $this->sendOtpService = $sendOtpService;
        $this->userDocumentDetailsService = $userDocumentDetailsService;
    }

    /**
     * login function
     *
     * @param [type] $request
     * @return void/null/object
     */

    public function login($request)
    {
        try {
            $loginField = $request->filled('email') ? 'email' : 'emp_id';
            $loginValue = $request->input($loginField);

            if ($loginField === 'email') {
                $user = User::where('email', $loginValue)->first();
            } else {
                $user = User::whereHas('details', function ($query) use ($loginValue) {
                    $query->where('emp_id', $loginValue);
                })->with('details')->first();
            }

            if (!$user) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }

            // Check if user status is active
            if (!$user->status) {
                return response()->json(['message' => 'User status is inactive. Please contact your administrator.'], 403);
            }

            if (!Hash::check($request->password, $user->password)) {
                return response()->json(['message' => 'Invalid password'], 401);
            }

            // Create access token
            $tokenResult = $user->createToken('token');
            $accessToken = $tokenResult->plainTextToken;

            // Create refresh token
            $refreshToken = Str::random(64);
            $expiresAt = Carbon::now()->addDays(30); // 30-day expiry

            $token = $tokenResult->accessToken;
            $token->refresh_token = hash('sha256', $refreshToken);
            $token->expires_at = $expiresAt;
            $token->save();

            return response()->json([
                'message' => 'Successfully Login',
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
                'expires_at' => $expiresAt->toDateTimeString(),
                'data' => $user,
            ]);

        } catch (Throwable $th) {
            return response()->json(['message' => 'Server error', 'error' => $th->getMessage()], 500);
        }
    }

    // public function login($request)
    // {
    //     try {
    //         $user = User::where('email', $request->email)->first();
    //         if (!$user) {
    //             return errorMessage('null', 'please enter valid email!');
    //         }
    //         if (!Hash::check($request->password, $user->password)) {
    //             return errorMessage('null', 'please enter valid password!');
    //         }
    //         if ($user && ($user->id == '2' || $user->id == '1')) {
    //             $user['access_token'] = $user->createToken('token')->plainTextToken;
    //             return apiResponse('success', $user);
    //         } else {
    //             $otpResponse = $this->sendOtpService->generateOTP($request->email, 'employee');
    //             if ($otpResponse['status'] == false) {
    //                 return errorMessage('null', $otpResponse['message'],);
    //             } else {
    //                 return apiResponse($otpResponse['message']);
    //             }
    //         }
    //     } catch (Throwable $th) {
    //         return exceptionErrorMessage($th);
    //     }
    // }

    /**
     * loginByEmpId function
     *
     * @param [type] $request
     * @return void/null/object
     */
    public function loginByEmpId($request)
    {
        try {
            $userDetail = UserDetail::where('emp_id', $request->emp_id)->first();
            if (!$userDetail) {
                return errorMessage('null', 'please enter valid employee id!');
            }

            $user = $userDetail->user;
            if (!$user) {
                return errorMessage('null', 'please enter valid employee id!');
            }

            if (!Hash::check($request->password, $user->password)) {
                return errorMessage('null', 'please enter valid password!');
            }

            $user['access_token'] = $user->createToken('token')->plainTextToken;

            return apiResponse('success', $user);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }

    /**
     * profile function
     *
     * @return void/object/null
     */
    public function profile()
    {
        try {
            $user = Auth::guard('employee_api')->user();
            return apiResponse('user_profile', $user);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }

    /**
     * logout function
     *
     * @param [type] $request
     * @return void/null/object
     */
    public function logout($request)
    {
        auth()->guard('employee_api')->user()->currentAccessToken()->delete();
        return apiResponse('logut');
    }

    /**
     * sendOtp function
     *
     * @param [type] $request
     * @param [type] $type
     * @return void/null/object
     */
    public function sendOtp($request, $type)
    {
        try {
            $loginField = $request->filled('email') ? 'email' : 'emp_id';
            $loginValue = $request->input($loginField);
            // Get the email
            if ($loginField === 'email') {
                $email = $request->email;
            } else {
                $email = User::whereHas('details', function ($query) use ($loginValue) {
                    $query->where('emp_id', $loginValue);
                })
                    ->pluck('email')
                    ->first();
            }
            $otpResponse = $this->sendOtpService->generateOTP($email, $type);
            if ($otpResponse['status'] == false)
                return errorMessage('null', $otpResponse['message']);
            else
                return apiResponse($otpResponse['message']);
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }

    /**
     * verifyOtp function
     *
     * @param [type] $request
     * @return void/null/object
     */
    public function verifyOtp($request)
    {
        try {
            $data = $request;
            $data['type'] = 'employee';

            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return errorMessage('null', 'please enter valid email!');
            }
            if (!Hash::check($request->password, $user->password)) {
                return errorMessage('null', 'please enter valid password!');
            }
            if (Auth::attempt($request->only(['email', 'password']))) {
                $verifyOtpResponse = $this->sendOtpService->verifyOTP($data, 'employee_api');
                if ($verifyOtpResponse) {
                    $user = auth()->guard('employee_api')->user();
                    $user->access_token = $user->createToken("HrJee TOKEN")->plainTextToken;
                    return apiResponse('otp_verified', $user);
                } else {
                    return errorMessage('null', 'invalid_or_expired_otp');
                }
            }
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }

    /**
     * changePassword function
     *
     * @param [type] $request
     * @return void/null/object
     */
    public function changePassword($request)
    {
        try {
            #Match The Old Password
            if (!Hash::check($request->old_password, auth()->user()->password))
                return errorMessage('null', 'old_password-not_matched');

            #Update the new Password
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            return apiResponse('password_changed');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }

    /**
     * updateProfile function
     *
     * @param [type] $request
     * @return void/null/object
     */
    public function updateProfile($request)
    {
        try {
            $data = $request->except('name');

            $user = User::whereId(auth()->user()->id)->first();

            $user->update([
                'name' => $request->name
            ]);

            $date = date_create($request->date_of_birth);
            $data['date_of_birth'] = date_format($date, "Y/m/d");

            if (isset($data['profile_image']) && !empty($data['profile_image'])) {
                $upload_path = "/user_profile_picture";
                $filePath = uploadingImageorFile($data['profile_image'], $upload_path);
                $data['profile_image'] = $filePath;
            }
            $user->details->update($data);

            return apiResponse('profile_updated');
        } catch (Throwable $th) {
            return exceptionErrorMessage($th);
        }
    }

    public function updateDocuments($payload, $allDocuments){
        try {
            $request = new Request();

            foreach ($payload['documents'] as $key => $document) {
                $document_name = removingSpaceMakingName($allDocuments->firstWhere('id', $key)->name);

                $request->files->add([
                    "{$document_name}" => $document,
                ]);
            }
            
            $request->merge(['user_id' => auth()->id()]);
            
            $this->userDocumentDetailsService->create($request);
            return apiResponse('profile_updated');
        }catch(Throwable $th){
            return exceptionErrorMessage($th);
        }
    }
}
