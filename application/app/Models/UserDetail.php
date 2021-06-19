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

class UserDetail extends Model
{

	use SoftDeletes;

	protected $table = 'user_details';

    protected $fillable = ['user_id','dob','state','block','district', 'landline_no', 'id_proof_type', 'id_proof_value', 'official_address', 'department', 'designation', 'pin_code', 'created_by','updated_by'];


    public function getState()
    {
        return $this->hasOne(State::class, 'id', 'state');
    }

    public function getDistrict()
    {
        return $this->hasOne(District::class, 'id', 'district');
    }

    public function getBlock()
    {
        return $this->hasOne(Block::class, 'id', 'block');
    }

    public function getIdProof()
    {
        return $this->hasOne(IdProof::class, 'id', 'id_proof_type');
    }

    public function getDepartment()
    {
        return $this->hasOne(Department::class, 'id', 'department');
    }

    public function getDesignation()
    {
        return $this->hasOne(Designation::class, 'id', 'designation');
    }

    public function getPhoneType()
    {
        return $this->hasOne(PhoneType::class, 'id', 'phone_type');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getSndUsers () {
        return $this->getUser()->where('role', 4);
    }

    public function getUserslistWiseState($where) {
        return $this->belongsTo()->where('state', $where);
    }
}
