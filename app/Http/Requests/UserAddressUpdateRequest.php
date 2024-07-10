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
            'both_same'                   =>  'required|in:0,1',
            'address'                   =>  'required|array',
            'address.*'                 =>  'required|array',
            'address.*.addressId'       => ['sometimes'],
            'address.*.address_type'    => ['required', 'in:local,both_same,permanent'],
            'address.*.address'         => ['required', 'string'],
            'address.*.city'            => ['required', 'string'],
            'address.*.pin_code'        => ['required', 'string'],
            'address.*.country_id'      => ['required', 'exists:countries,id'],
            'address.*.state_id'        => ['required', 'exists:states,id'],
        ];
    }
}
