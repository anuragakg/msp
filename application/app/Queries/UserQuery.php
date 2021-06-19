<?php

namespace App\Queries;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use DB;
class UserQuery extends BaseQuery
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
            5 => 'getUserSio',
            6 => 'getUserDio',
            
            
        ];

        if (isset($mappings[$user->role])) {
            return call_user_func([$this, $mappings[$user->role]], $user,$request);
        }else{
            return call_user_func([$this, $mappings[6]], $user,$request);
        }

        return abort(403,'Role based query is not defined.');
    }

    private function getUserAdmin($user,$request)
    {
      
        return User::whereHas('getUserDetails', function (Builder $query) use ($user,$request) {
            //$query->whereNotIn('role', [8, 11, 12,1]);
           if(isset($request['state']) && !empty($request['state']))
            {
                $query->where('state', $request['state']);
            }
            if(isset($request['district']) && !empty($request['district']))
            {
                $query->where('district', $request['district']);
            }
            if(isset($request['role']) && !empty($request['role']))
            {
                $query->where('role', $request['role']);
            }
            
        });
    }
    private function getTrifedUser($user,$request)
    {
        
        return User::whereHas('getUserDetails', function (Builder $query) use ($user,$request) {
            $query->whereIn('role', [4,5,6]);
            if(isset($request['state']) && !empty($request['state']))
            {
                $query->where('state', $request['state']);
            }
            if(isset($request['district']) && !empty($request['district']))
            {
                $query->where('district', $request['district']);
            }
            if(isset($request['role']) && !empty($request['role']))
            {
                $query->where('role', $request['role']);
            }
            
        })->orWhere('users.created_by',$user->id);
    }
    private function getMinistryAdmin($user,$request)
    {
        
        return User::whereHas('getUserDetails', function (Builder $query) use ($user,$request) {
            $query->whereIn('role', [2,4,5,6]);
           if(isset($request['state']) && !empty($request['state']))
            {
                $query->where('state', $request['state']);
            }
            if(isset($request['district']) && !empty($request['district']))
            {
                $query->where('district', $request['district']);
            }
            if(isset($request['role']) && !empty($request['role']))
            {
                $query->where('role', $request['role']);
            }
        })->orWhere('users.created_by',$user->id);
    }
    private function getUserNodalDeaprtment($user,$request)
    {
        
        return User::whereHas('getUserDetails', function (Builder $query) use ($user,$request) {
            $query->where('state', $user->getUserDetails->state);
            //$query->whereNotIn('role', [1,2,3]);
            if(isset($request['state']) && !empty($request['state']))
            {
                $query->where('state', $request['state']);
            }
            if(isset($request['district']) && !empty($request['district']))
            {
                $query->where('district', $request['district']);
            }
            if(isset($request['role']) && !empty($request['role']))
            {
                $query->where('role', $request['role']);
            }
            
        });
    }

    
    
    private function getUserSio($user,$request)
    {
        return User::where('created_by',$user->id)->whereHas('getUserDetails', function (Builder $query) use ($user,$request) {
            //$query->where('state', $user->getUserDetails->state);
            //$query->whereNotIn('role', [1,2,3,4]);
         if(isset($request['state']) && !empty($request['state']))
            {
                $query->where('state', $request['state']);
            }
            if(isset($request['district']) && !empty($request['district']))
            {
                $query->where('district', $request['district']);
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
        return User::where('created_by',$user->id)->whereHas('getUserDetails', function (Builder $query) use ($user,$request) {
            //$query->where('district', $user->getUserDetails->district);
            //$query->whereNotIn('role', [1,2,3,4,5]);
            if(isset($request['state']) && !empty($request['state']))
            {
                $query->where('state', $request['state']);
            }
            if(isset($request['district']) && !empty($request['district']))
            {
                $query->where('district', $request['district']);
            }
        });
    }

    
}
