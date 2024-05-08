<?php 
namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class OnlyString implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check if the value contains only letters (no numbers)
        if (!is_string($value) || preg_match('/[0-9]/', $value)) {
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must contain only string values (no numbers).';
    }
}
