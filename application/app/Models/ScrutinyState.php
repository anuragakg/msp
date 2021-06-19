<?php

namespace App\Models\Masters;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class ScrutinyState extends Model
{
    use SoftDeletes;

    protected $table = 'scrutiny_states';

    protected $fillable = ['state_id', 'created_by', 'updated_by'];

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

    public function hasMany($related, $foreignKey = null, $localKey = null)
    {
        //return $this->belongsTo(User::class, 'role_id', 'role');   
    }
        
    
}
