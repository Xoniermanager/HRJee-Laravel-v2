<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true; // Set to true if all users can access this request
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'date' => 'required|date|before_or_equal:today',
            'punch_in' => 'required|date_format:H:i',
            'punch_out' => 'required|date_format:H:i|after:punch_in',
            'reason' => 'required|string|max:255',
        ];
    }

    /**
     * Custom error messages for validation rules.
     */
    public function messages()
    {
        return [
            'date.required' => 'The date field is required.',
            'date.date' => 'Invalid date format.',
            'date.before_or_equal' => 'The date must be today or a past date.',

            'punch_in.required' => 'Punch-in time is required.',
            'punch_in.date_format' => 'Invalid time format for punch-in.',

            'punch_out.required' => 'Punch-out time is required.',
            'punch_out.date_format' => 'Invalid time format for punch-out.',
            'punch_out.after' => 'Punch-out time must be later than punch-in time.',

            'reason.required' => 'Reason is required.',
            'reason.string' => 'Reason must be a string.',
            'reason.max' => 'Reason cannot exceed 255 characters.'
        ];
    }
}
