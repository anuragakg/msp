<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPasswordHistory extends Model
{
    use SoftDeletes;

    protected $table = 'user_password_history';

    protected $fillable = ['user_id', 'hash'];
}
