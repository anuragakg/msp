<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
class UniqueUserRoleLevel implements Rule
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
        $user=Auth::user();
        $data=$this->data;
        $roles=array(4,5,6,7,8,9,10,11);
        if (in_array($data['role'], $roles)) 
        {
            $where['state']=$data['state'];    
        }
        $district_role=array(6,7,8,9,10,11);
        if (in_array($data['role'], $district_role)) 
        {
            $where['district']=$data['district'];
        }
        
        $where['role']=$data['role'];
        $where['level_id']=$data['level_id'];
        $query = User::whereHas('getUserDetails', function (Builder $query) use ($user,$where) {
            $query->where($where);
        });
        if(isset($this->id) && !empty($this->id) && $this->id!=0)
        {
            $query->where('id','!=',$this->id);
        }
        $exists=$query->count();
        if($exists)
        {
            $this->validating = "You are not allowed to create user with same role and level more than 1";
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
