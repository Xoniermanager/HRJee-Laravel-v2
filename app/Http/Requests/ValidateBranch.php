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
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'company_id' => 'nullable',
            'branch_type' => 'required|in:Primary,Secondary',
            'contact_no' => 'required|numeric',
            'email' => 'required|email|unique:company_branches,email',
            'hr_email' => 'required|email|unique:company_branches,email',
            'address' => 'required|string',
            'city' => 'required|string',
            'pincode' => 'required|string',
            'state' => 'required|string',
            'country_id' => 'string',
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
