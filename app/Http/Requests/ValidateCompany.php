<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateCompany extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:companies',
            'contact_no' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:companies',
            'password' => 'required|string|min:8',
            'company_size' => 'required|string',
            'company_url' => 'required|string|url|max:100',
            'company_address' => 'required|string|max:255',
            'industry_type' => 'required|string|max:255',
        ];
    }
}
