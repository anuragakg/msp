<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Proposals\Mfp_procurement_nodal;
use Illuminate\Support\Facades\Auth;

class UniqueMfpYear implements Rule
{
    protected $data;
    protected $validating;
    protected $id;
    //private $ruleMessages = [];
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($data,$id=null)
    {
        $this->data = $data;
        $this->validating=''; 
        $this->id=$id; 
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
        $data = $this->data;
        
                $where['mfp']= $data['mfp'];
                $where['year']= $data['year'];
                $where['created_by'] = Auth::user()->id;
                $query = Mfp_procurement_nodal::where($where);
               
                $exists = $query->count();
                if($exists)
                {
                    $this->validating = "This MFP for ".$data['year']."already existed ";
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
        return $this->validating;
    }
}
