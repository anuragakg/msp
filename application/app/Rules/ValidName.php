<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidName implements Rule
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
        return preg_match("/^[a-z\s]+$/i", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->customMessage
            ? $this->customMessage
            : 'The :attribute should be valid name.';
    }
}
