<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDetailsAddRequest extends FormRequest
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
                    'employee_type_id'   => ["required",'exists:employee_types,id'],
                    'department_id'        => ["required",'exists:departments,id'],
                    'designation_id'       => ["required",'exists:designations,id'],
                    'company_branch_id'    => ["required",'exists:company_branches,id'],
                    'role_id'              => ["required",'exists:roles,id'],
                    'qualification_id'     => ["required",'exists:qualifications,id'],
                    'shift_id'             => ["required",'exists:shifts,id'],
                    'skill_id'             => ["required",'exists:skills,id'],
                    'language'                     => "required|array",
                    'language.*'                   => "required|array", 
                    'language.*.language_id'       => "required",
                    'language.*.read'              => ['required', 'in:b,i,e'],
                    'language.*.write'             => ['required', 'in:b,i,e'],
                    'language.*.speak'             => ['required', 'in:b,i,e'],

        ];
    }
}
