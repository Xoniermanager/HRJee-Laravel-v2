<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ValidateUpdateCompanyRequest extends FormRequest
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
        $userId = Auth()->user()->company_id; // Assuming the route parameter is 'user'
        return [

            // 'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'sometimes|required|string|max:255',
            'username' => 'sometimes|required|string|max:255|unique:company_details,username,' . $userId,
            'contact_no' => 'sometimes|required|string|max:20',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $userId,
            'company_address' => 'sometimes|string|max:255',
            'state' => 'sometimes|string|max:100',
            'country' => 'sometimes|string|max:100',
            'pincode' => 'sometimes|integer|max:20',
        ];
    }
}
