<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Masters\HaatDetailsMaster;

class UniqueHaatBlock implements Rule
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
        $data=$this->data;
        
        $row_num=0;
        $is_unique = [];
        $isUnique = true;
        foreach ($data['mfp_coverage'] as $coverageRow) 
        {
                ++$row_num;
               foreach ($coverageRow['haat_id'] as $key1 => $row) 
                {
                    //print_r($coverageRow);die;
                    $key = $row.$coverageRow['block_id'][$key1];
                    if(isset($is_unique[$key])){
                        $this->validating = "Block exists with same haat in record number $row_num of mfp coverage";
                        $isUnique = false;
                        break;
                    }
                    else
                    {
                        $is_unique[$key] = '';
                    }
                }
                $is_unique = [];
        }
        return $isUnique;
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
