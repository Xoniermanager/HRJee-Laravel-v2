<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPastWorkDetailsAddRequest extends FormRequest
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
            'previous_company'                      => "required|array",
            'previous_company.*'                    => "required|array",
            'previous_company.*.designation'        => "required",
            'previous_company.*.from'               => ["required", "date"],
            'previous_company.*.to'                 => ["required", "date"],
            'previous_company.*.duration'           => "required",
        ];
    }
}
