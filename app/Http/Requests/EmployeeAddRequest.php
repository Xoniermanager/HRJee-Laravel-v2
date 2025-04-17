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
            'email' => ['required', 'unique:users,email,' . request()->get('id')],
            'password' => ['sometimes', 'nullable', 'string'],
            'official_email_id' => ['required', 'unique:user_details,official_email_id,' . request()->get('user_details_id')],
            'blood_group' => ['required', 'in:A-,A+,B-,B+,O-,O+'],
            'gender' => ['required', 'in:M,F,O'],
            'marital_status' => ['required', 'in:M,S'],
            'employee_status_id' => ['required', 'exists:employee_statuses,id'],
            'date_of_birth' => ['required', 'date'],
            'joining_date' => ['required', 'date'],
            'phone' => ['required', 'min:10', 'numeric'],
            'profile_image' => ['mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'official_mobile_no' => ['sometimes', 'unique:user_details,official_mobile_no,' . request()->get('user_details_id')],
            'offer_letter_id' => ['sometimes', 'unique:user_details,offer_letter_id,' . request()->get('user_details_id')]
        ];
    }
}
