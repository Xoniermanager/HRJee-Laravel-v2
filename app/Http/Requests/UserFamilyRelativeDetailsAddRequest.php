<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFamilyRelativeDetailsAddRequest extends FormRequest
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
            'family_details'                     => "required|array",
            'family_details.*'                   => "required|array",
            'family_details.*.relation_name'     => "required",
            'family_details.*.name'              => "required",
            'family_details.*.dob'               => ["required", "date"],
            'family_details.*.phone'             => "required",
        ];
    }
}
