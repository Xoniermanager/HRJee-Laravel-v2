<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaveCreditManagementRequest extends FormRequest
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
            'company_branch_id'                     => ['required', 'exists:company_branches,id'],
            'employee_type_id'                      => ['required', 'exists:employee_types,id'],
            'repeat_in_months'                      => ['required'],
            'minimum_working_days_if_month'         => ['required_if:repeat_in_months,=,1'],
            'credit_leave_on_day'                   => ['required'],
            'leave_type_id'                         => ['required', 'exists:leave_types,id'],
            'number_of_leaves'                      => ['required', 'integer', 'min:0.5'],
        ];
    }
}
