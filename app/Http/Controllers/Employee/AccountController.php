<?php

namespace App\Http\Controllers\Employee;

use App\Http\Requests\EmployeeChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserBankDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\CountryServices;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserAddressDetailsAddRequest;
use App\Http\Services\UserAddressDetailServices;

class AccountController extends Controller
{
    private $countryService;
    public function __construct(CountryServices $countryService)
    {
        $this->countryService = $countryService;
    }
    public function index()
    {
        $userAddressDetails = Auth::user()->addressDetails;
        $allCountries = $this->countryService->getAllActiveCountry();
        return view('employee.account.index', compact('userAddressDetails', 'allCountries'));
    }

    public function basicDetailsUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_image' => 'nullable|mimes:jpeg,png,jpg',
            'father_name' => 'required|string|max:100',
            'mother_name' => 'required|string|max:100',
            'date_of_birth' => 'required|date|before:' . now()->subYears(18)->toDateString(),
            'blood_group' => 'required|in:A+,A-,B+,B-,O-,O+',
            'gender' => 'required|in:M,F,O',
            'marital_status' => 'required|in:M,S',
            'phone' => 'required|min:5|max:20',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->except('_token');
        $userDetails = User::find(Auth::user()->id);
        if (isset($data['profile_image']) && !empty($data['profile_image'])) {
            if ($userDetails->getRawOriginal('profile_image') != null) {
                unlinkFileOrImage($userDetails->profile_image);
            }
            $data['profile_image'] = uploadingImageorFile($data['profile_image'], '/user_profile', removingSpaceMakingName($userDetails->name));
        }
        $userDetails->update($data);
        return redirect()->back()->with(['success' => 'Updated Successfully']);
    }

    public function bankDetailsUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'account_name' => 'required',
            'account_number' => 'required',
            'ifsc_code' => 'required',
            'bank_name' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        UserBankDetail::where('user_id', Auth::user()->id)->update($request->except('_token'));
        return redirect()->back()->with(['success' => 'Updated Successfully']);
    }

    public function addressDetailsUpdate(UserAddressDetailsAddRequest $request, UserAddressDetailServices $userAddressDetailServices)
    {
        $request['user_id'] = Auth::user()->id;
        $updateDetails = $userAddressDetailServices->create($request->all());
        if ($updateDetails) {
            return redirect()->back()->with(['success' => 'Updated Successfully']);
        } else {
            return redirect()->back()->with(['error' => 'Please try Again']);
        }
    }
    public function updateChangePassword(EmployeeChangePasswordRequest $request)
    {
        $credential = $request->validated();
        try {
            $response = User::find(Auth()->user()->id)->update(['password' => $credential['password']]);
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
