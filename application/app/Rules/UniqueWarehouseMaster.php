<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Masters\WarehouseMaster;
use App\Models\Masters\WarehouseMasterBlocks;

class UniqueWarehouseMaster implements Rule
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
        foreach ($data['warehouse'] as $key => $row) 
        {   
            ++$row_num;
                $where['state_id']=$row['state'];
                $where['district_id']=$row['district'];
                $where['warehouse']=$row['warehouse'];
                $where['corresponding_hats']=$row['corresponding_hats'];
                $query=WarehouseMaster::where($where); 
                if(isset($data['form_id']) && !empty($data['form_id']) && $data['form_id']!=0)
                {  
                    $query->where('id','!=',$data['form_id']);
                }
                $query=$query->get();
                if(!empty($query->toArray()))
                {
                    foreach($query->toArray() as $arr)
					{	
						$queryBlock=WarehouseMasterBlocks::where('warehouse_id',$arr['id'])->whereIn('block_id',$row['block']);
						$ifBlockexists=$queryBlock->count();
						
						if($ifBlockexists)
						{
							$this->validating = "The warehouse is already existed with same state,district,block in record number $row_num";
							return false;
						}
					}
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



