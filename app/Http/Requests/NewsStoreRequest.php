<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsStoreRequest extends FormRequest
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
            'title'                =>   'required',
            'news_category_id'     =>   'required|exists:news_categories,id',
            'start_date'           =>   'required|date',
            'end_date'             =>   'required|date',
            'image'                =>   'mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_branch_id'    =>   'required_if:all_company_branch,==,0|array',
            'company_branch_id.*'  =>   'exists:company_branches,id',
            'department_id'        =>   'required_if:all_department,==,0|array',
            'department_id.*'      =>   'exists:departments,id',
            'designation_id'       =>   'required_if:all_designation,==,0|array',
            'designation_id.*'     =>   'exists:designations,id',
            'file'                 =>   'nullable|mimes:pdf',
            'description'          =>   'nullable',
        ];
    }
}
