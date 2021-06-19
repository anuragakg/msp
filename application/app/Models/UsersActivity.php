<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersActivity extends Model
{
    //
    

    protected $table = 'users_activity';

    protected $fillable = [
    'user_id','ip_address','activity','module','created_by','updated_by','created_at','updated_at' 
    ];

   

}
