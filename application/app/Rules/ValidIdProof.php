<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Masters\IdProof;

class ValidIdProof implements Rule
{
    protected $id_proof_type;
    //private $ruleMessages = [];
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id_proof_type)
    {
        $this->id_proof_type = $id_proof_type;

        try{
            $this->idProof = IdProof::findOrFail($this->id_proof_type);
        } catch (\Exception $th) {
            return false;
        }

        // $this->ruleMessages = [
        //     1 => 'Aadhaar ID is not valid.',
        //     2 => 'Voter ID is not valid.',
        //     3 => 'Pan ID is not valid.',
        //     4 => 'Other Govt ID is not valid.',
        // ];
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
        if (isset($this->idProof) ) {
            switch ($this->idProof->title) {
                case 'Aadhaar ID':
                    # Aadhaar ID
                    return preg_match("/^\d{12}$/", $value);

                case 'Voter ID':
                    # Voter ID 
                    return preg_match("/^([a-zA-Z]){3}([0-9]){7}?$/", $value);

                case 'PAN ID':
                    # Pan Id
                    return preg_match("/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/", $value);

                case 'Other Govt ID':
                    # Other Govt ID  // Also, Including all of the above
                    return preg_match('/^[a-z0-9 .\-]+$/i', $value);

                case 'NA':
                    # Other Govt ID  // Also, Including all of the above
                    return true;

                default:
                    # code...
                    return true;
            }
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $title = isset($this->idProof) ? $this->idProof->title : 'NA';
        return 'The '.$title.' is not valid.';
    }
}
