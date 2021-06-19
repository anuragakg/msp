<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class LatLongValidator implements Rule
{

    private $regex;
    private $validating;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($type = 'lat')
    {
        $types = [
            /* "lat" => '/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/',
            "long" => '/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/', */
            // "lat" => '/^(\+|-)?([01][0-7][0-9][0-9])\.{1}\d{6}$/',
            // "long" => '/^(\+|-)?([01][0-7][0-9][0-9])\.{1}\d{6}$/',
            "lat" => '/^(\+|-)?(([01])?([0-7])?([0-9])?([0-9]))(.)?\d{0,6}$/',
            "long" => '/^(\+|-)?(([01])?([0-7])?([0-9])?([0-9]))(.)?\d{0,6}$/',
        ];

        $messages = [
            'lat' => 'Latitude',
            'long' => 'Longitude',
        ];

        $this->regex = $types[$type] ?? $types['lat'];
        $this->validating = $messages[$type] ?? $messages['lat'];
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
        return preg_match($this->regex, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The :attribute must be a valid {$this->validating} coordinate, with a limit of 6 digits after a 
            decimal point";
    }
}
