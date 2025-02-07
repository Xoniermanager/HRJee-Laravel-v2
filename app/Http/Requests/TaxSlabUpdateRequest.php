<?php
namespace App\Http\Requests;

use App\Models\TaxSlabRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class TaxSlabUpdateRequest extends FormRequest
{
   /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Optionally, add authorization logic to check if the user has permission to update the tax slab
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'income_range_start' => [
                'required',
                'numeric',
                'min:0',
                'unique:tax_slab_rules,income_range_start,' . request()->id . ',id,company_id,' . Auth::user()->company_id . ',income_range_end,' . $this->income_range_end,
                function ($attribute, $value, $fail) {
                    // Retrieve the latest tax slab for the given company, excluding the current record being updated
                    $lastRecord = TaxSlabRule::where('company_id', Auth::user()->company_id)
                        ->where('id', '!=', request()->id) // Exclude the current record from the check
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
                'gt:' . $this->income_range_start,  // Ensure income_range_end is greater than income_range_start
                // Ensure income_range_end is unique for the company, excluding the current record being updated
                'unique:tax_slab_rules,income_range_end,' . request()->id . ',id,company_id,' . Auth::user()->company_id . ',income_range_start,' . $this->income_range_start,
            ],
            'tax_rate' => 'required|numeric|min:0|max:70',
        ];
    }

    /**
     * Get the error messages for the validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'income_range_start.required' => 'The starting income range is required.',
            'income_range_end.required' => 'The ending income range is required.',
            'tax_rate.required' => 'The tax rate is required.',
            // Customize any other error messages as necessary
        ];
    }
}
