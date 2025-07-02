<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Http\FormRequest;

class ValidateConnector extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => 'sometimes',

            'connector_name' => [
                'required',
                'string',
                'max:50',
            ],
            'email' => 'required',

            'msisdn' => 'required|numeric|digits_between:10,12|unique:connectors,msisdn,' . request()->id,


        ];
    }

    public function messages(): array
    {
        return [
            'connector_name.required' => 'Please enter the connector name.',
            'email.required' => 'Please enter email.',
            'msisdn.required' => 'Please enter the contact number.',
            'msisdn.digits_between' => 'The contact number must be between 10 and 12 digits.',
            'msisdn.numeric' => 'The contact number must be numeric.',
            'msisdn.unique' => 'This contact number is already in use.',
        ];
    }
}
