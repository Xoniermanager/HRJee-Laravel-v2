<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class AssetStoreRequest extends FormRequest
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
            'name'                          => ['required', 'string'],
            'model'                         => ['required', 'string'],
            'purchase_value'                => ['required', 'string'],
            'depreciation_per_year'         => ['nullable'],
            'invoice_no'                    => ['nullable'],
            'serial_no'                     => ['required', 'string'],
            'invoice_file'                  => ['mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'ownership'                     => ['in:owned,rented'],
            'asset_category_id'             => ['required', 'exists:asset_categories,id'],
            'asset_manufacturer_id'         => ['required', 'exists:asset_manufacturers,id'],
            'invoice_date'                  => ['required', 'date'],
            'validation_upto'               => ['required', 'date'],
        ];
    }
}
