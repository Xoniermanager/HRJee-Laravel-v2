<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Services\AuthService;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ValidateCompany;
use Illuminate\Support\Facades\Validator;

class AuthWebController extends Controller
{
    private $authService;
    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }
public function signup()
{        
    return view('signup');
}
public function signin()
{        
    return view('signin');
}
public function getOtp(Request $request)
{
    try {
        $validateUser = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
        ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }
        $response = $this->authService->getOtp($request); 
        return $response;
      
    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }
}

public function verifyOtp(Request $request)
{
    try {
        $validateUser = Validator::make($request->all(), [
            'email' => 'required',
            'otp' => 'required',
        ]);

        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ], 401);
        }

        $response = $this->authService->verifyOtp($request); 
        return $response;
      
    } catch (\Throwable $th) {
        return response()->json([
            'status' => false,
            'message' => $th->getMessage()
        ], 500);
    }
}

public function registerCompany(ValidateCompany $request)
{
     try 
     {
      $company = Company::create([
        'name'      => $request->name,
        'username'  => $request->username,
        'contact_no'=> $request->contact_no,
        'email'     => $request->email,
        'password'  => Hash::make($request->password), 
        'role_id'   => '',
        'joining_date' => Carbon::now(),
        'logo'         => 'https://ibb.co/YPHW7WK' ,
        'company_size' => $request->company_size,
        'company_url'  => $request->company_url,
        'subscription_id'=> 1,
        'company_address'=> $request->company_address,
        'industry_type'  => $request->industry_type,
        'status' => $request->privacy_policy,
      ]);
      if($company)
      { 
          smilify('success','Company Created Successfully!');
          return redirect('/signin');
      }
      else {
        return redirect()->back()->with('error', 'Failed to create company. Please try again.');
    }
   } catch (\Exception $e) {
    return $e->getMessage();
   }
 }

}
