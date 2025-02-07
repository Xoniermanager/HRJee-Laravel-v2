<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalaryUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'unique:salaries,name,' . request()->id . ',id,company_id,' . auth()->user()->company_id],
            'description' => 'nullable|sometimes|max:255',
            'componentDetails' => 'required|array', // Component details must be an array
            'componentDetails.*.id' => 'required|numeric', // value must be a number
            'componentDetails.*.value' => 'required|numeric', // value must be a number
            'componentDetails.*.earning_or_deduction' => 'required|in:earning,deduction', // Only allowed values for earning_or_deduction
            'componentDetails.*.value_type' => 'required|in:fixed,percentage', // Only allowed values for value_type
            'componentDetails.*.parent_component' => [  'nullable','sometimes','exists:salary_components,id']
        ];
    }
}
