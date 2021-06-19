<?php 

namespace App\Helpers;
use App\Models\User;
use App\Models\Infrastructures\Infrastructure_Development_status_log;  
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\CommissionMaster;
use App\Notifications\AccessInfraCommisionNotification;

class InfraFundHelper
{
    
    public static function getCommission($amount)
    {
        $user = Auth::user();
        $user_id=$user->id;
        $user_role=$user->role;
        if($user_role ==5 || $user_role ==6)
        {
            $state= $user->getUserDetails->state;
            $commision_master=CommissionMaster::where(['state'=>$state,'role'=>$user_role,'status'=>'1'])->first();
            if(!empty($commision_master))
            {
                $commission_rate=$commision_master->commission;
                $max_aggregate_commission=$commision_master->max_aggregate_commission;
                $commission=($amount*$commission_rate)/100;
                $commission_amount= Helper::decimalNumberFormat($commission); 
                return array(
                    'commission_amount'=>$commission_amount,
                    'commission_rate'=>$commission_rate
                );
            }else{
                throw new \Exception("Commission rate is not set,please contact to admin");
            }    
        }else{
            return array(
                    'commission_amount'=>0,
                    'commission_rate'=>0
                );
        }
        
    }

    public static function checkAccessCommision($release)
    {
        $user = Auth::user();
        $user_id=$user->id;
        $user_role=$user->role;
        $user = Auth::user();
        $user_id=$user->id;
        $user_role=$user->role;
        if($user_role ==5)
        {
            $state= $user->getUserDetails->state;
            $commision_master=CommissionMaster::where(['state'=>$state,'role'=>$user_role,'status'=>'1'])->first();
            if(!empty($commision_master))
            {
                $commission_rate=$commision_master->commission;
                $max_aggregate_commission=$commision_master->max_aggregate_commission;
                if($release->commission_amount > $max_aggregate_commission)
                {
                    //send Notification
                    $from = User::findOrFail($user_id);
                    $trifed_user = Infrastructure_Development_status_log::leftJoin('users', function ($join) {
                        $join->on('infrastructure_development_status_log.assigned_to', '=', 'users.id');
                    })
                    ->where('users.role',2)//trifed
                    ->where(['infrastructure_development_status_log.consolidated_id' => $release->consolidated_id, 'infrastructure_development_status_log.is_assigned_next_level' => '1', 'infrastructure_development_status_log.status' => 1])
                    ->orderBy('infrastructure_development_status_log.id', 'desc')
                    ->select('infrastructure_development_status_log.*')
                    ->first();
                    if(!empty($trifed_user))
                    {
                        $to = User::findOrFail($trifed_user->assigned_to);
                        $to->notify(new AccessInfraCommisionNotification($commision_master,$release,$from));
                    }
                    $ministry_user = Infrastructure_Development_status_log::leftJoin('users', function ($join) {
                        $join->on('infrastructure_development_status_log.assigned_to', '=', 'users.id');
                    })
                    ->where('users.role',3)//ministry
                    ->where(['infrastructure_development_status_log.consolidated_id' => $release->consolidated_id, 'infrastructure_development_status_log.is_assigned_next_level' => '1', 'infrastructure_development_status_log.status' => 1])
                    ->orderBy('infrastructure_development_status_log.id', 'desc')
                    ->select('infrastructure_development_status_log.*')
                    ->first();
                    if(!empty($ministry_user))
                    {
                        $to = User::findOrFail($ministry_user->assigned_to);
                        $to->notify(new AccessInfraCommisionNotification($commision_master,$release,$from));
                    }
                    $nodal_user = Infrastructure_Development_status_log::leftJoin('users', function ($join) {
                        $join->on('infrastructure_development_status_log.assigned_to', '=', 'users.id');
                    })
                    ->where('users.role',4)//nodal
                    ->where(['infrastructure_development_status_log.consolidated_id' => $release->consolidated_id, 'infrastructure_development_status_log.is_assigned_next_level' => '1', 'infrastructure_development_status_log.status' => 1])
                    ->orderBy('infrastructure_development_status_log.id', 'desc')
                    ->select('infrastructure_development_status_log.*')
                    ->first();
                    if(!empty($nodal_user))
                    {
                        $to = User::findOrFail($nodal_user->assigned_to);
                        $to->notify(new AccessInfraCommisionNotification($commision_master,$release,$from));
                    }
                        
                                        
                }
            }    
        }
    }
    
    
}