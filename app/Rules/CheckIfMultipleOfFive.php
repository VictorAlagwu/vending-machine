<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckIfMultipleOfFive implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $mod = $value % 5;
        return $mod === 0 ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The cost must be a multiple of five';
    }
}
