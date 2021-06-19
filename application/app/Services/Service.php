<?php

namespace App\Services;
use App\Models\UsersActivity; 
use App\Models\Proposals\Mfp_procurement;
use Illuminate\Support\Facades\Auth;

class Service
{
	public function getMasterData($serviceModel)
	{
		return $serviceModel::where('status', 1)->get();
		// return Auth::user()->role == 1 ?
		// 	$serviceModel::orderBy('title', 'asc')->get() :
		// 	$serviceModel::where('status', 1)->get();
	}

	/**
	 * Checks whether a vdvk can be edited or not.
	 *
	 * @param int $vdvkID
	 * @return boolean|void
	 */
	public function canUpdateProposal($procurement)
	{
		/**
		 * Abort request if Proposal status is 1(Approved), 3(Rejected)
		 */
		return abort_if(
			in_array($procurement->status, [1, 3]),
			403,
			'Proposal cannot be edited once approved or rejected.'
		);
	}
	
	public function checkPerpage($per_page){
		$response=array();
		if(is_numeric($per_page)){
			$response['status']=1;
			return $response;
		}else{
			$response['status']=0;
			$response['message']='Per page is not valid';
			return $response;
		}
		return $response;
	}
	function ordinal_suffix($num){
        $num = $num % 100; // protect against large numbers
        if($num < 11 || $num > 13){
             switch($num % 10){
                case 1: return $num.'st';
                case 2: return $num.'nd';
                case 3: return $num.'rd';
            }
        }
        return $num.'th';
    }
    function addUserActivity($activity,$module)
    {
    	$user_id = Auth::user()->id;
    	$users_activity=array(
                    'user_id'=>$user_id,
                    'ip_address'=>$_SERVER['REMOTE_ADDR'],
                    'activity'=>$activity,
                    'module'=>$module,
                );
        $user_activity=new UsersActivity($users_activity);
        $user_activity->save();
    }
}
