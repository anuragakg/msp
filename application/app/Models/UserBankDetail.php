<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserBankDetail extends Model
{
    //
    use SoftDeletes;

    protected $table = 'user_bank_details';

    protected $fillable = [
        'bank_name', 'branch_name', 'ifsc_code', 'bank_ac_no', 'mobile_no', 'ac_holder_name'
    ];
}