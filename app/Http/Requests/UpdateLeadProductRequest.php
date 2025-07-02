<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeadProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'lead_id' => 'required|exists:leads,id',
            'product' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'lead_id.required' => 'Lead ID is required',
            'lead_id.exists' => 'Invalid lead ID',
            'product.required' => 'Please select a product',
        ];
    }
}