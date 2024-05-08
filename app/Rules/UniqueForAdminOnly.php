<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueForAdminOnly implements ValidationRule
{
    private $_table;

    public function __construct($table)
    {
        $this->_table = $table;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!empty($value))
        {
            $exists = DB::table($this->_table)->where($attribute,'=',$value)->get();
            
            if(count($exists) > 0)
            {
                if($exists[0]->company_id == null)
                {
                    $fail('The :attribute already added, please use another one.');
                }
            }
           return; 
        }
    }
}
