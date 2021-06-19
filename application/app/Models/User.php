<?php

namespace App\Models;

use App\Models\FundManagement\SanctionLetter;
use App\Models\Shg\ShgGatherers;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Proposed\ProposedVdvkFund;
use App\Models\Proposed\StatusLogsModel;
use App\Models\Proposed\Vdvk;
use App\Models\Warehouse\WarehouseFormMapping;
use App\Models\UsersAllowedStates;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use SoftDeletes;
	use HasApiTokens, Notifiable;
	
    protected $fillable = ['user_name', 'name', 'middle_name', 'last_name', 'email', 'role', 'created_by', 'updated_by', 'mobile_no','level_id'];

    protected $hidden = [
        'password', 'remember_token', 'email_verify_token'
    ];

    public $attemptsAllowed = 5;
    public $thresholdTime = 30;

    /**
     * Get User Details
     *
     * @return mixed
     */
    public function getUserDetails()
    {
        return $this->hasOne('App\Models\UserDetail', 'user_id', 'id');
    }

    /**
     * Get Bank Details
     *
     * @return mixed
     */
    public function getUserBankDetails()
    {
        return $this->hasOne('App\Models\UserBankDetail', 'user_id', 'id');
    }

    /**
     * Get User Role
     *
     * @return mixed
     */
    public function getRole()
    {
        return $this->hasOne('App\Models\UserRole', 'id', 'role');
    }


    /**
     * Switch the status of any specified user.
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

    /**
     * Get Surveyor and Supervisor Details.
     *
     * @return mixed
     */
    public function getSurveyorSupervisorDetails()
    {
        return $this->hasOne(SurveyorSupervisor::class, 'user_id', 'id');
    }

    /**
     * User Mapping Relationship : Child Users
     *  
     * @return mixed
     */
    public function getChildUsers()
    {
        return $this->belongsToMany(User::class, 'users_mapping', 'parent_id', 'child_id');
    }

    /**
     * User Mapping Relationship : Parent Users
     *  
     * @return mixed
     */
    public function getParentUsers()
    {
        return $this->belongsToMany(User::class, 'users_mapping', 'child_id', 'parent_id');
    }

    /**
     * Inspection Mo Mapping Relationship : Child Users
     *  
     * @return mixed
     */
    public function getInspectionChildUsers()
    {
        return $this->belongsToMany(User::class, 'inspection_mo_mapping', 'parent_id', 'child_id');
    }

    /**
     * Inspection Mo Mapping Relationship : Parent Users
     *  
     * @return mixed
     */
    public function getParentInspectionUsers()
    {
        return $this->belongsToMany(User::class, 'inspection_mo_mapping', 'child_id', 'parent_id');
    }

    /**
     * Evaluation Mo Mapping Relationship : Child Users
     *  
     * @return mixed
     */
    public function getEvaluationChildUsers()
    {
        return $this->belongsToMany(User::class, 'evaluation_mo_mapping', 'parent_id', 'child_id');
    }

    /**
     * Evaluation Mo Mapping Relationship : Parent Users
     *  
     * @return mixed
     */
    public function getParentEvaluationUsers()
    {
        return $this->belongsToMany(User::class, 'evaluation_mo_mapping', 'child_id', 'parent_id');
    }

    /**
     * Get Surveyor and Supervisor Details.
     *
     * @return mixed
     */
    public function getMentoringOrganisationDetails()
    {
        return $this->hasOne(MentoringOrganisation::class, 'user_id', 'id');
    }

    public function vdvks()
    {
        return $this->hasMany(Vdvk::class, 'user_id', 'id');
    }

    public function proposedVdvkFund()
    {
        return $this->hasMany(ProposedVdvkFund::class, 'user_id', 'id');
    }

    public function getMo()
    {
        return $this->hasOne(MentoringOrganisation::class, 'user_id');
    }

    public function getUserPermissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'user_permissions_relationship',
            'user_id',
            'permission_id',
            'id'
        );
    }

    public function getPermissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'role_permissions_relationship',
            'role_id',
            'permission_id',
            'role'
        );
    }

    /**
     * Gets haat bazaar form mapping
     *
     * @return mixed
     */
    public function getHaatBazaarFormMapping()
    {
        return $this->hasMany(HaatBazaarFormMapping::class, 'created_by', 'id');
    }

    /**
     * Gets warehouse form mapping
     *
     * @return mixed
     */
    public function getWarehouseFormMapping()
    {
        return $this->hasMany(WarehouseFormMapping::class, 'created_by', 'id');
    }

    /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForMail($notification)
    {
        return $this->email;
    }
    
    public function getAssignedProposals()
    {
        return $this->hasMany(StatusLogsModel::class, 'assigned_to', 'id');
    }

    public function getShgGatherer()
    {
        return $this->hasMany(ShgGatherers::class, 'created_by', 'id');
    }

    public function getActivity()
    {
        return $this->hasMany(UsersActivity::class, 'user_id');
    }
    public function isBlocked()
    {
        if (is_null($this->blocked_at)) {
            return false;
        }

        return now()->diffInSeconds($this->blocked_at) <= $this->thresholdTime;
    }

    public function unBlock() 
    {
        $this->blocked_at = null;
        $this->failed_attempts = 0;
        return (bool) $this->save();
    }

    public function blockUser()
    {
        $this->blocked_at = now();
        $this->save();
    }

    public function attemptsRemaining()
    {
        return $this->attemptsAllowed - $this->failed_attempts;
    }

    public function getSanctionLetters()
    {
        return $this->hasMany(SanctionLetter::class,'snd_id', 'id');
    }

    public function getNoOfVdvks()
    {
        return $this->hasMany(Vdvk::class, 'user_id', 'id');
    }

    public function userNames()
    {
        return $this->hasMany(Vdvk::class, 'user_id', 'id');
    }
    public function getUsersAllowedStates()
    {
        return $this->hasMany(UsersAllowedStates::class, 'user_id', 'id');
    }

     public function getUserDepartment()
    {
        return $this->hasOne('App\Models\UserDetail', 'user_id', 'id')->with(['getDepartment']);
    }

    public function getUserHaatBazaar()
    {
        return $this->hasMany(UserHaatBazaarMapping::class, 'user_id', 'id');
    }
    public function getUserWarehouse()
    {
        return $this->hasOne(UserWarehouseMapping::class, 'user_id', 'id');
    }
}
