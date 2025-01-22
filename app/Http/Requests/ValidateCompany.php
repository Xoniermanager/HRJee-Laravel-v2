<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ValidateCompany extends FormRequest
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
    public function rules(Request $request): array
    {
        return [
            'name' => 'sometimes|required|string|max:255,',
            'username' => 'sometimes|required|string|max:255',
            'contact_no' => 'sometimes|required|string|max:20',
            'email' => 'sometimes|required|string|email|max:255|unique:companies,email',
            'password' => 'sometimes|required|confirmed',
            'password_confirmation' => 'sometimes|required',
            'company_size' => 'sometimes|required|string',
            'company_url' => 'sometimes|required|string|url|max:100',
            'company_address' => 'sometimes|sometimes|required|string|max:255',
            'company_type_id' => 'sometimes|required|exists:company_types,id',
             'logo' => 'sometimes|max:2048',
        ];
    }
}
