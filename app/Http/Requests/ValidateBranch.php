<?php

namespace App\Http\Requests;

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
            'name' => 'required|string',
            'type' => 'required|in:primary,secondary',
            'contact_no' => 'required|numeric|unique:company_branches,contact_no',
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
            'city' => 'required|string',
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
        return [];
    }
}
