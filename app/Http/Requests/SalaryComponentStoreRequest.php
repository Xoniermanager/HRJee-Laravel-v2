<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SalaryComponentStoreRequest extends FormRequest
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
            'name'                  =>  ['required', 'string', 'max:255'],
            'default_value'         =>  ['required'],
            'is_taxable'            =>  ['required','boolean'],
            'value_type'            =>  ['required', Rule::in(['fixed', 'percentage'])],
            'parent_component'      =>  ['sometimes', 'exists:salary_components,id'],
            'is_default'            =>  ['required','boolean'],
            'earning_or_deduction'  =>  ['required', Rule::in(['earning','deduction'])]
        ];
    }
}
