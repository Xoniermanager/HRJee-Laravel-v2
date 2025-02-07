<?php
namespace App\Http\Requests;

use App\Models\TaxSlabRule;
use Illuminate\Foundation\Http\FormRequest;

class TaxSlabStoreRequest extends FormRequest
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
            'income_range_start' => [
                'required',
                'numeric',
                'min:0',
                'unique:tax_slab_rules,income_range_start,NULL,id,company_id,' . Auth()->user()->company_id . ',income_range_end,' . $this->income_range_end,
                function ($attribute, $value, $fail) {
                    // Retrieve the latest tax slab for the given company
                    $lastRecord = TaxSlabRule::where('company_id', Auth()->user()->company_id)
                        ->orderBy('income_range_end', 'desc')
                        ->first();

                    // Check if the last record exists and if the current income_range_start is greater than the last income_range_end
                    if ($lastRecord && $value <= $lastRecord->income_range_end) {
                        // Validation fails if income_range_start is not greater than the last income_range_end
                        $fail('Income range start must be greater than the last income range end for the given company.');
                    }
                },
            ],
            'income_range_end' => [
                'required',
                'numeric',
                'min:0',
                'gt:' . $this->income_range_start,  // Fixed this line
                'unique:tax_slab_rules,income_range_end,NULL,id,company_id,' . Auth()->user()->company_id . ',income_range_start,' . $this->income_range_start,
            ],
            'tax_rate' => 'required|numeric|min:0|max:70',
        ];

    }

    /**
     * Get custom error messages for validation.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'income_range_start.required' => 'Please enter the starting income range.',
            'income_range_start.numeric' => 'Income range start must be a number.',
            'income_range_start.min' => 'Income range start must be a positive number.',
            'income_range_start.unique' => 'This income range start already exists for the given company and income range end.',
            'income_range_end.required' => 'Please enter the ending income range.',
            'income_range_end.numeric' => 'Income range end must be a number.',
            'income_range_end.min' => 'Income range end must be a positive number.',
            'income_range_end.greater_than' => 'Income range end must be greater than the starting range.',
            'income_range_end.unique' => 'This income range end already exists for the given company and income range start.',
            'tax_rate.required' => 'Please enter the tax rate.',
            'tax_rate.numeric' => 'Tax rate must be a number.',
            'tax_rate.min' => 'Tax rate cannot be negative.',
            'tax_rate.max' => 'Tax rate cannot exceed 70%.',
        ];
    }
}
