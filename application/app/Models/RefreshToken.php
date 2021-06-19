<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefreshToken extends Model
{
    use SoftDeletes;

    protected $table = 'refresh_token';

    protected $fillable = ['user_id', 'hash_code', 'created_by', 'expire_time'];

    public function getROName()
    {
        return $this->hasOne(ROName::class, 'id', 'ro_name');
    }

    public function getConsignmentShop()
    {
        return $this->hasOne(ConsignmentShop::class, 'id', 'consignment_shop');
    }

    public function getOwnedShop()
    {
        return $this->hasOne(OwnedShop::class, 'id', 'owned_shop');
    }

    public function getFranchise()
    {
        return $this->hasOne(Franchise::class, 'id', 'franchise');
    }

}
