<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
	protected $table = 'email_templates';

    protected $fillable = ['description' , 'type' , 'subject' , 'created_by', 'updated_by'];

}