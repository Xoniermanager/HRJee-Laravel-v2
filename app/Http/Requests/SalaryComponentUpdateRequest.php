<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SalaryComponentUpdateRequest extends FormRequest
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
            'name'                  =>  ['required', 'unique:salaries,name,' . request()->id . ',id,company_id,' . auth()->user()->company_id],
            'default_value'         =>  ['required','numeric',function ($attribute, $value, $fail) {
                    if (request()->input('value_type') === 'percentage' && ($value < 10 || $value > 70)) {
                        $fail('The Default Value must be between 10% to 70% when value type is percentage.');
                    }
                    if (request()->input('value_type') === 'fixed' && !is_numeric($value)) {
                        $fail('The Default Value must be a valid number when value type is fixed.');
                    }
                }
            ],
            'value_type'            =>  ['required', Rule::in(['fixed', 'percentage'])],
            'parent_component'      =>  ['nullable','sometimes', 'exists:salary_components,id'],
            'is_default'            =>  ['required', 'boolean'],
            'earning_or_deduction'  =>  ['required', Rule::in(['earning', 'deduction'])]
        ];
    }
}
