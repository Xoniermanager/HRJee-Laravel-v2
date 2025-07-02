<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Request;
use Illuminate\Foundation\Http\FormRequest;

class LenderStoreRequest extends FormRequest
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
            'product_id' => 'required',

            'lender_name' => [
                'required',
                'string',
                'max:255',
            ],

        ];
    }

    public function messages(): array
    {
        return [
            'lender_name.required' => 'Please enter the lender name.',
            'product_id.required' => 'Please select a product.',
        ];
    }
}
