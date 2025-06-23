<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Http\FormRequest;

class ValidateBranch extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => 'sometimes',

            'name' => [
                'required',
                'string',
                'max:50',
                'regex:/^[A-Za-z\s]+$/',
            ],

            'type' => [
                'required',
                Rule::in(['primary', 'secondary']),
                function ($attribute, $value, $fail) {
                    $branchId = request('id');
        
                    if ($value === 'primary') {
                        $exists = \App\Models\CompanyBranch::where('company_id', auth()->user()->company_id)
                            ->where('type', 'primary')
                            ->when($branchId, function ($query) use ($branchId) {
                                $query->where('id', '!=', $branchId);
                            })
                            ->exists();

                        if ($exists) {
                            $fail('A primary branch already exists for this company.');
                        }
                    }
                },
            ],

            'contact_no' => 'required|numeric|digits_between:10,12',

            'email' => 'required|email',

            'hr_email' => 'required|email',

            'address' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!app('geocoder')->geocode($value)->get()->count()) {
                        $fail('The provided address is incorrect.');
                    }
                },
            ],

            'city' => [
                'required',
                'string',
                'regex:/^[A-Za-z0-9\s]+$/',
            ],

            'pincode' => [
                'required',
                'string',
                'max:8',
                'regex:/^[A-Za-z0-9\s]+$/',
            ],

            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter the branch name.',
            'name.regex' => 'The branch name may only contain letters and spaces.',
            'type.required' => 'Please select the branch type.',
            'type.in' => 'Branch type must be either primary or secondary.',
            'contact_no.required' => 'Please enter the contact number.',
            'contact_no.digits_between' => 'The contact number must be between 10 and 12 digits.',
            'contact_no.numeric' => 'The contact number must be numeric.',
            'contact_no.unique' => 'This contact number is already in use.',
            'email.required' => 'Please enter the branch email.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This branch email is already in use.',
            'hr_email.required' => 'Please enter the HR email.',
            'hr_email.email' => 'Please enter a valid HR email address.',
            'hr_email.unique' => 'This HR email is already in use.',
            'address.required' => 'Please enter the branch address.',
            'city.required' => 'Please enter the city.',
            'city.regex' => 'City may only contain letters, numbers, and spaces.',
            'pincode.required' => 'Please enter the pincode.',
            'pincode.max' => 'The pincode may not be greater than 8 characters.',
            'pincode.regex' => 'The pincode may only contain letters, numbers, and spaces.',
            'country_id.required_if' => 'Please select a country.',
            'country_id.exists' => 'Selected country is invalid.',
            'state_id.required_if' => 'Please select a state.',
            'state_id.exists' => 'Selected state is invalid.',
        ];
    }
}
