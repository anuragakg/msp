<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class UserPermissionMapping extends Model
{
    //use SoftDeletes;

    protected $table = 'user_permissions_relationship';
    protected $dates = ['deleted_at'];
    public $timestramps = false;

   
    protected $fillable = ['user_id', 'permission_id','created_by'];

    /**
     * Switch the status of any specified master.
     * 
     * @return int|string
     */
    public function switchStatus()
    {
        if ($this->status == 1) {
            return $this->status = '0';
        }
        $this->status = 1;
    }
}