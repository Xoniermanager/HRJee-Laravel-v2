<?php

namespace App\Http\Requests;
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'company_id' => 'sometimes',
            'name' => 'required|string|max:50',
            'type' => [
                'required',
                'in:primary,secondary',
                function ($attribute, $value, $fail) {
                    if ($value === 'primary') {
                        $exists = \App\Models\CompanyBranch::where('company_id', auth()->user()->company_id)
                            ->where('type', 'primary')
                            ->exists();
        
                        if ($exists) {
                            $fail('A primary branch already exists for this company.');
                        }
                    }
                },
            ],
            'contact_no' => 'required|numeric|digits_between:10,12|unique:company_branches,contact_no',
            'email' => 'required|email|unique:company_branches,email',
            'hr_email' => 'required|email|unique:company_branches,hr_email',
            'address' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!app('geocoder')->geocode($value)->get()->count()) {
                        $fail('The provided address is incorrect.');
                    }
                }
            ],
            'city' => [
                'required',
                'string',
                'regex:/^[A-Za-z0-9\s]+$/'
            ],
            'pincode' => 'required|string',
            'country_id' => 'required_if:address_type,==,0|exists:countries,id',
            'state_id' => 'required_if:address_type,==,0|exists:states,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'city.regex' => 'The city must not contain special characters. Only letters, numbers, and spaces are allowed.',
        ];
    }
}
