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
            "company_branch_id" => "required|exists:company_branches,id",
            "title" => "required|string|min:10",
            "start_date_time" => "required|after_or_equal:now",
            "expires_at" => "nullable|after_or_equal:now",
            "description" => "required|string",
            "image" => "nullable|nullable",
            "status" => "required|in:active,inactive",
        ];
    }
}
