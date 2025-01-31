<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalaryComponentAssignmentStoreRequest extends FormRequest
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
            'salary_id'             =>  ['required', 'integer', 'exists:salaries,id'],
            'salary_component_id'   =>  ['sometimes', 'exists:salary_components,id'],
            'value'                 =>  ['required'],
            'is_taxable'            =>  ['required','boolean'],
            'value_type'            =>  ['required', Rule::in(['fixed', 'percentage'])],
            'parent_component'      =>  ['sometimes', 'exists:salary_component_assignments,id'],
            'earning_or_deduction'  =>  ['required', Rule::in(['earning','deduction'])]
        ];
    }
}
