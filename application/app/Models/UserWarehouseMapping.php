<?php

namespace App\Models;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Masters\WarehouseMaster;
use Illuminate\Database\Eloquent\Model;


class UserWarehouseMapping extends Model
{
    
    protected $table = 'user_mapped_to_warehouse';
    
    protected $fillable = [
        'user_id',
        'warehouse_id',
        'created_by',
        'updated_by',
    ];
    
    public function getUser()
    {
        return $this->hasOne(User::class, 'id','user_id');
    }
    public function getUserDetails()
    {
        return $this->hasOne(UserDetail::class, 'user_id','user_id');
    }

    public function getWarehouseMasterDetail()
    {
        return $this->hasOne(WarehouseMaster::class, 'id','warehouse_id');
    }

}
