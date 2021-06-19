<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Masters\HaatDetailsMaster;

class UniqueHaatBazaarMaster implements Rule
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
        foreach ($data['haatbazaar'] as $key => $row) 
        {
            ++$row_num;
                $where['state_id']=$row['state'];
                $where['district_id']=$row['district'];
                $where['haat_bazaar_id']=$row['haat_bazaar'];
                $query = HaatDetailsMaster::where($where);
                if(isset($data['form_id']) && !empty($data['form_id']) && $data['form_id']!=0)
                {
                    $query->where('id','!=',$data['form_id']);
                }
                $exists=$query->count();
                if($exists)
                {
                    $this->validating = "The haat bazaar is already existed with same state,district in record number $row_num";
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
        return $this->validating;
    }
}
