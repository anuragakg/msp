<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidNameWithDot implements Rule
{

    private $customMessage;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($customMessage = null)
    {
        if (is_string($customMessage)) {
            $this->customMessage = $customMessage;
        }
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
        return preg_match("/^[A-Za-z. ]+$/", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
         return 'The :attribute should only contain dot, Space.';
    }
}
