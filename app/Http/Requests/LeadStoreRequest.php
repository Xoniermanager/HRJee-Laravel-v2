<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadStoreRequest extends FormRequest
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
            // 'title' => [
            //     'required',
            //     'string',
            //     'max:50',
            //     'regex:/^[a-zA-Z\s]+$/',
            // ],
            'customer_number'      =>   [
                'required',
                'string',
                'max:12',
            ],
            'customer_name'      =>   'required',
            'assigned_user'      =>   'required',
            'applicant_type'      =>   'required',
            'business_type'      =>   'required',
        ];
    }
}
