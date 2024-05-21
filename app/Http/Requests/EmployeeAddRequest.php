<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeAddRequest extends FormRequest
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
                'name' => ['required', 'string'],
                'email' => ['required', 'unique:users,email'],
                'password' => ['required', 'string'],
                'official_email_id' => ['required', 'unique:users,official_email_id'],
                'blood_group' => ['required', 'in:A-,A+,B-,B+,O-,O+'],
                'gender' => ['required', 'in:M,F,O'],
                'marital_status' => ['required', 'in:M,S'],
                'employee_status_id' => ['required', 'exists:employee_statuses,id'],
                'date_of_birth' => ['required', 'date'],
                'joining_date' => ['required', 'date'],
                'phone' => ['required', 'min:10', 'numeric'],
                'profile_image' => ['required', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ];
    }
}
