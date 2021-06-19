<?php

namespace App\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use DB;
class ProcurementAgentListQuery extends BaseQuery
{

    /**
     * MO get states query in proposed location
     * @param string $id Resource ID
     * @return Vdvk
     */

    public function viewAllQuery($request=null)
    {
        $user = $this->getUser();

        $mappings = [
            1 => 'getUserAdmin',
            2 => 'getTrifedUser',
            3 => 'getMinistryAdmin',
            4 => 'getUserNodalDeaprtment',
            5 => 'getUserNodalDeaprtment',
            6 => 'getUserDio',
            7 => 'getUserPA',
            
            
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user,$request);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getUserAdmin($user,$request)
    {
        
        return User::where('role',7)->whereHas('getUserDetails', function (Builder $query) use ($user,$request) {
            //$query->whereNotIn('role', [8, 11, 12,1]);
            if(isset($request['designation']) && !empty($request['designation']))
            {
                $query->where('designation', $request['designation']);
            }
            if(isset($request['department']) && !empty($request['department']))
            {
                $query->where('department', $request['department']);
            }
            if(isset($request['role']) && !empty($request['role']))
            {
                $query->where('role', $request['role']);
            }
            
        });
    }
    private function getTrifedUser($user,$request)
    {
        
        return User::where('role',7)->whereHas('getUserDetails', function (Builder $query) use ($user,$request) {
            
            if(isset($request['designation']) && !empty($request['designation']))
            {
                $query->where('designation', $request['designation']);
            }
            if(isset($request['department']) && !empty($request['department']))
            {
                $query->where('department', $request['department']);
            }
            if(isset($request['role']) && !empty($request['role']))
            {
                $query->where('role', $request['role']);
            }
            
        })->orWhere('users.created_by',$user->id);
    }
    private function getMinistryAdmin($user,$request)
    {
        
        return User::where('role',7)->whereHas('getUserDetails', function (Builder $query) use ($user,$request) {
            
            if(isset($request['designation']) && !empty($request['designation']))
            {
                $query->where('designation', $request['designation']);
            }
            if(isset($request['department']) && !empty($request['department']))
            {
                $query->where('department', $request['department']);
            }
            if(isset($request['role']) && !empty($request['role']))
            {
                $query->where('role', $request['role']);
            }
        })->orWhere('users.created_by',$user->id);
    }
    private function getUserNodalDeaprtment($user,$request)
    {
        
        return User::where('role',7)->where('created_by',$user->id)->whereHas('getUserDetails', function (Builder $query) use ($user,$request) {
            $query->where('state', $user->getUserDetails->state);
            //$query->whereNotIn('role', [1,2,3]);
            if(isset($request['designation']) && !empty($request['designation']))
            {
                $query->where('designation', $request['designation']);
            }
            if(isset($request['department']) && !empty($request['department']))
            {
                $query->where('department', $request['department']);
            }
            if(isset($request['role']) && !empty($request['role']))
            {
                $query->where('role', $request['role']);
            }
            
        });
    }

    
    
    private function getUserSio($user,$request)
    {
        return User::where('role',7)->where('created_by',$user->id)->whereHas('getUserDetails', function (Builder $query) use ($user,$request) {
            $query->where('state', $user->getUserDetails->state);
            //$query->whereNotIn('role', [1,2,3,4]);
            if(isset($request['designation']) && !empty($request['designation']))
            {
                $query->where('designation', $request['designation']);
            }
            if(isset($request['department']) && !empty($request['department']))
            {
                $query->where('department', $request['department']);
            }
        });
    }

    

    /**
     * get users for DIO
     * @param $user
     * @return mixed
     */
    public function getUserDio($user,$request)
    {
        return User::where('role',7)->where('created_by',$user->id)->whereHas('getUserDetails', function (Builder $query) use ($user,$request) {
            $query->where('district', $user->getUserDetails->district);
            //$query->whereNotIn('role', [1,2,3,4,5]);
            if(isset($request['designation']) && !empty($request['designation']))
            {
                $query->where('designation', $request['designation']);
            }
            if(isset($request['department']) && !empty($request['department']))
            {
                $query->where('department', $request['department']);
            }
        });
    }

    
    /**
     * get users for DIO
     * @param $user
     * @return mixed
     */
    public function getUserPA($user,$request)
    {
        return User::where('role',7)->whereHas('getUserDetails', function (Builder $query) use ($user,$request) {
            $query->where('district', $user->getUserDetails->district);
            $query->where('user_id', $user->id);
            //$query->whereNotIn('role', [1,2,3,4,5]);
            if(isset($request['designation']) && !empty($request['designation']))
            {
                $query->where('designation', $request['designation']);
            }
            if(isset($request['department']) && !empty($request['department']))
            {
                $query->where('department', $request['department']);
            }
        });
    }


    
}
