<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementStoreRequest extends FormRequest
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
            "title"                 => "required|string|min:5",
            "start_date_time"       => "required|after_or_equal:date",
            "expires_at_time"       => "nullable|after_or_equal:start_date_time",
            "description"           => "required",
            "image"                 => 'mimes|jpeg|png|jpg|gif|svg|max:2048',
            'company_branch_id'     => 'required_if:all_company_branch,==,0|array',
            'company_branch_id.*'   => 'exists:company_branches,id',
            'department_id'         => 'required_if:all_department,==,0|array',
            'department_id.*'       => 'exists:departments,id',
            'designation_id'        => 'required_if:all_designation,==,0|array',
            'designation_id.*'      => 'exists:designations,id',
            'assign_announcement'   => 'required|in:1,0',
            'notification_schedule_time' => 'required_if:assign_announcement,==,0',
        ];
    }
}
