<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAnnouncementRequest extends FormRequest
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
            // "company_branch_id" => "nullable|exists:company_branches,id",
            "title" => "required|string|min:10",
            "start_date_time" => "required|after_or_equal:now",
            "expires_at" => "nullable|after_or_equal:start_date_time",
            "description" => "required|string",
            "image" => "nullable",
            "status" => "required|in:active,inactive",
            'branch_id' => ['nullable', 'exists:company_branches,id'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'designation_id' => ['nullable', 'exists:designations,id'],
            'assign_announcement' => ['required', 'in:1,0'],
            'notification_schedule_time' => ['required_if:assign_announcement,0'],
        ];
    }
}
