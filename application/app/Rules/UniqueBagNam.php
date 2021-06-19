<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Masters\Packing;
use DB;
class UniqueBagNam implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */ 
    public function __construct()
    { 
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

        $where=array();
        $where['shg_groups.title']=$value;
        
        $where['shg_groups.state']=$this->state_id;
        
        if($this->shg_id!=null)
        {
            $query= ShgGroup::where($where)
                ->where('shg_groups.id','!=',$this->shg_id)
                ->select(DB::raw('count(shg_groups.id) as count') )
                ->first(); 
        }else{
			$query= ShgGroup::where($where)
                ->select(DB::raw('count(shg_groups.id) as count') )
                ->first();  	
		}

        
      
        if($query->count){
            return false;
        }else{
            return true;
        }   
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This :attribute already existed ';
    }
}
