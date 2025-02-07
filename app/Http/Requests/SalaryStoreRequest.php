<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalaryStoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:salaries,name,NULL,id,company_id,' . auth()->user()->company_id],
            'description' => 'nullable|sometimes|max:255',
            // 'salary_component_id' => 'required|array',
            // 'salary_component_id.*' => 'required|exists:salary_components,id'
            'componentDetails' => 'required|array', // Component details must be an array
            'componentDetails.*.id' => 'required|numeric', // value must be a number
            'componentDetails.*.value' => 'required|numeric', // value must be a number
            // 'componentDetails.*.is_default' => 'required|boolean', // is_default must be a boolean
            'componentDetails.*.earning_or_deduction' => 'required|in:earning,deduction', // Only allowed values for earning_or_deduction
            'componentDetails.*.value_type' => 'required|in:fixed,percentage', // Only allowed values for value_type
            'componentDetails.*.parent_component' => [  'nullable','sometimes','exists:salary_components,id' // Must exist in salary_components table
            ],
        ];
    }
}
