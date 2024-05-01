<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateEmployee extends FormRequest
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
            'full_name'=> 'required|string|max:40',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|',
            'phone'    => 'required|numeric|digits_between:9,11',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
            // 'profile_image' =>'required|string',
            'joining_date' => 'required|date',
            'branch' => 'required|numeric',
            'department_id' => 'required|numeric',
            'designation_id' => 'required|numeric',
            'employee_id' => 'required|string',
            'family_contact_number' => 'sometimes|numeric|digits_between:9,11'
        ];
    }
    public function messages()
    {
       return [];
    }
}
