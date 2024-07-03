<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAddressUpdateRequest extends FormRequest
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
            'addressId' => ['required', 'exists:user_addresses_details,id'],
            'address_type' => ['required', 'in:local,both_same,permanent'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'pin_code' => ['required', 'string'],
            'country_id' => ['required', 'exists:countries,id'],
            'state_id' => ['required', 'exists:states,id'],
        ];
    }
}
