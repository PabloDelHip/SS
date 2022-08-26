<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class numberPhone implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $number = preg_match('/^[0-9,-]+$/', $value);
    
        return $number;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El :attribute Solo puede tener guiones (-) y numeros.';
    }
}
