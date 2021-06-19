<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateFormType implements Rule
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
        $vals = explode(',', $value);
        foreach ($vals as $id) {
            if (!in_array((int) $id, [1, 2, 3, 4])) {
                return false;
            }
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
        return 'The value specified for :attribute is invalid.';
    }
}
