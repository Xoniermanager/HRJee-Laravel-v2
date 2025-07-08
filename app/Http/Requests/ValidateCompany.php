<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;


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
            'name' => 'sometimes|required|string|max:100,',
            'username' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:20',
            'email' => 'sometimes|email|required|string|email|max:255|unique:users,email',
            'password' => [
                'sometimes',
                'required',
                'confirmed',
                Password::min(6)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'password_confirmation' => 'required_with:password|same:password',
            'company_size' => 'sometimes|required|min:1',
            'company_url' => 'sometimes|required|string|url|max:100',
            'company_address' => 'sometimes|sometimes|required|string|max:255',
            'company_type_id' => 'sometimes|required|exists:company_types,id',
            'logo' => 'sometimes|max:2048',
        ];
    }
}
