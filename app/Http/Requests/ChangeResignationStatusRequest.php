<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangeResignationStatusRequest extends FormRequest
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
        $resignationId = $this->route('id');
        $resignation = \App\Models\Resignation::findOrFail($resignationId);

        return [
            "status" => [
                'required',
                'in:Pending,Approved,Rejected,Withdrawn,Hold',

                function ($attribute, $value, $fail) use ($resignation) {
                    if ($resignation->status === $value) {
                        $fail('The status must be different from the current status.');
                    }
                },
            ],
            'remark' => 'required|string',
            'release_date' => 'required_if:status,==,approved',
        ];
    }
}
