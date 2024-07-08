<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementAssignRequest extends FormRequest
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
            'announcement_id' => ['required', 'exists:announcements,id'],
            'company_branch_id' => ['required', 'exists:company_branches,id'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'designation_id' => ['nullable', 'exists:designations,id'],
            'assign_announcement' => ['required','in:1,0'],
            'notification_schedule_time' => ['required_if:assign_announcement,0'],
        ];
    }

    public function messages()
{
    return [
        'notification_schedule_time.required_if' => 'schedule date & time is required when you select for leter', /** You can custom message here */
    ];
}
}
