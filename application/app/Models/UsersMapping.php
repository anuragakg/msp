<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersMapping extends Model
{
    protected $table = 'users_mapping';

    protected $attributes = [
        'created_by' => 0
    ];

}
