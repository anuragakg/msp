<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ValidateMapSurveyors implements Rule
{

    private $ignore_id;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id = false)
    {
        //
        $this->ignore_id = $id;
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
        $exists = User::whereHas('getParentUsers', function (Builder $query) use ($value) {
            $query->where('child_id', $value);
            if ($this->ignore_id) {
                $query->where('parent_id', '<>', $this->ignore_id);
            }
        })->count();

        if ($exists) {
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
        return 'The user has been already assigned';
    }
}
