<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Proposed\ProposedLocation;

class ValidKendraName implements Rule
{
    protected $name;
    protected $state;
    protected $district;
    protected $block;
    protected $village;
    //private $ruleMessages = [];
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($name,$state,$district,$block,$village,$vdvk_id=null)
    {
        $this->name = $name;
        $this->state = $state;
        $this->district = $district;
        $this->block = $block;      
        $this->village = $village;      
        $this->vdvk_id = $vdvk_id;      
        
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
        
        $exists= ProposedLocation::where('kendra_name',$this->name)->where('state',$this->state)->where('district',$this->district)->where('block',$this->block)->where('village',$this->village);
        if($this->vdvk_id){
            $exists=$exists->where('vdvk_id','!=',$this->vdvk_id);
        }
        $exists=$exists->toSql();
        
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
        return 'The Kendra name has been already assigned for state district and block';
    }
}
