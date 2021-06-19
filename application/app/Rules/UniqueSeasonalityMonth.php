<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;


class UniqueSeasonalityMonth implements Rule
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

        
        foreach ($data['seasonality'] as $key => $seasoniltyRow) 
        {
                ++$row_num;
                if(isset($seasoniltyRow['haat_id']) && !empty($seasoniltyRow['haat_id']))
                {
                    $haat_id=$seasoniltyRow['haat_id'];

                    if(isset($seasoniltyRow['mfp_id']) && !empty($seasoniltyRow['mfp_id']))
                    {
                        foreach ($seasoniltyRow['mfp_id'] as $key1=>$mfp) 
                        {
                            if(isset($seasoniltyRow['month']) && !empty($seasoniltyRow['month']))
                            {
                                foreach ($seasoniltyRow['month'][$key1] as $row2)
                                {
                                    if(isset($haat_data[$haat_id][$mfp]) && in_array($row2, $haat_data[$haat_id][$mfp]))
                                    {
                                        $this->validating = "Month exists with same haat in record number $row_num of seasonality";
                                        $isUnique = false;
                                        break;
                                    }else{
                                        $haat_data[$haat_id][$mfp][]=$row2;    
                                    }
                                    
                                }                                 
                            }       
                        }            
                    }       
                }

                
               
                $is_unique = [];
        }//dd($haat_data);
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
