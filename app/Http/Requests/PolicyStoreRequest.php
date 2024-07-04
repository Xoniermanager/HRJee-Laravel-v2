<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PolicyStoreRequest extends FormRequest
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
            'title'                => ['required'],
            'policy_category_id'   => ['required', 'exists:policy_categories,id'],
            'start_date'           => ['required', 'date'],
            'end_date'             => ['required', 'date'],
            'image'                => ['mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'company_branch_id'    => 'required|array', 'exists:company_branches,id',
            'department_id'        => 'required|array', 'exists:departments,id',
            'designation_id'       => 'required|array', 'exists:designations,id',
            'file'                 => 'nullable|mimes:pdf',
            'description'          => 'nullable',
        ];
    }
}
