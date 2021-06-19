<?php

namespace App\Rules;

use App\Services\VdvkService;
use Illuminate\Contracts\Validation\Rule;

class UserProposalAssignment implements Rule
{

    private $vdvkID = 0;
    private $vdvkService;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($vdvkID)
    {
        //
        $this->vdvkID = $vdvkID;
        $this->vdvkService = new VdvkService;
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
        //
        try {
            return $this->vdvkService->getStateLevelRoleUserValidate($this->vdvkID, $value);
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The specified user is invalid.';
    }
}
