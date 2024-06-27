<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateProfileRequest extends FormRequest
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
            'name' => 'nullable|string|max:100',
            'father_name' => 'nullable|string|max:100',
            'mother_name' => 'nullable|string|max:100',
            'blood_group' => 'nullable|in:A+, A-, B+, B-, O-, O+',
            'gender' => 'nullable|in:M,F,O',
            'marital_status' => 'nullable|in:M,S',
            'phone' => 'nullable|min:5|max:20',
            'profile_image' => 'nullable',
            'date_of_birth' => 'nullable|date|before:' . now()->subYears(18)->toDateString(),
        ];
    }
}
