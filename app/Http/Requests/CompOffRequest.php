<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompOffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Set to true if all users can access this request
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'start_date' => 'required|date',
            // 'end_date' => 'sometimes|date',
            'user_remark' => 'required|string',
        ];
    }

    /**
     * Custom error messages for validation rules.
     */
    public function messages()
    {
        return [
            'start_date.required' => 'The start date field is required.',
            'start_date.date' => 'Invalid start date format.',

            // 'end_date.date' => 'Invalid end date format.',

            'user_remark.required' => 'Remark is required.',
            'user_remark.string' => 'Remark must be a string.'
        ];
    }
}
