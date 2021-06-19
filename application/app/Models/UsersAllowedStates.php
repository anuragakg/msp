<?php

namespace App\Models;

use App\Models\Masters\Block;
use App\Models\Masters\District;
use App\Models\Masters\State;
use App\Models\Masters\IdProof;
use App\Models\Masters\PhoneType;
use App\Models\Masters\Department;
use App\Models\Masters\Designation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersAllowedStates extends Model
{

	//use SoftDeletes;

	protected $table = 'users_allowed_states';

    protected $fillable = ['user_id','state', 'created_by','updated_by'];


    public function getState()
    {
        return $this->belongsTo(State::class, 'state');
    }

}
