<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddressDetailsAddRequest extends FormRequest
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
            'l_address'                => ['required'],
            'l_country_id'             => ['required', 'exists:countries,id'],
            'l_state_id'               => ['required', 'exists:states,id'],
            'l_city'                   => ['required'],
            'l_pincode'                => ['required'],
            'p_address'                => ['required_if:address_type,==,0'],
            'p_country_id'             => ['required_if:address_type,==,0', 'exists:countries,id'],
            'p_state_id'               => ['required_if:address_type,==,0', 'exists:states,id'],
            'p_city'                   => ['required_if:address_type,==,0'],
            'p_pincode'                => ['required_if:address_type,==,0'],
        ];
    }
}
