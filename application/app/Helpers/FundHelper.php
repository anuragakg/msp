<?php 

namespace App\Helpers;
use Helper;
use App\Models\User;
use App\Models\Proposals\Mfp_procurement_status_log;
use Illuminate\Support\Facades\Auth;
use App\Models\Mfp_procurement_dia_release;
use App\Models\Actualdetail\Mfp_procurement_actual_detail;
use App\Models\Proposals\Mfp_storage_actual_other;

use App\Models\Mfp_procurement_fund_transactions;
use App\Models\Actualdetail\Overhead_collection_level;
use App\Models\Actualdetail\Overhead_warehouse_labour_charges;
use App\Models\Actualdetail\Overhead_labour_charges;
use App\Models\Actualdetail\Overhead_weighment_charges;
use App\Models\Actualdetail\Overhead_transportation_charges;
use App\Models\Actualdetail\Overhead_service_charges;
use App\Models\Actualdetail\Overhead_warehouse_charges;
use App\Models\Actualdetail\Overhead_estimated_wastages;
use App\Models\Actualdetail\Overhead_service_charges_dia;
use App\Models\Actualdetail\Overhead_other_costs;
use App\Models\Actualdetail\Overhead_collection_level_haat;
use App\Models\Masters\CommissionMaster;
use App\Notifications\AccessCommisionNotification;
use App\Notifications\DiaAccessCommisionNotification;
class FundHelper
{
    
    public static function getFundAvailableAtPa()
    {
        $user = Auth::user();
        $user_id=$user->id;
        $user_role=$user->role;

        $total_released_to_procurement_agent_by_dia=Mfp_procurement_dia_release::where('procurement_agent',$user_id)->sum('total_released_to_procurement_agent');



        $actual_tribal_amount_paid=Mfp_procurement_actual_detail::where('created_by',$user_id)->sum('amount_paid');
        $total_mfp_storage_value=Mfp_storage_actual_other::where('created_by',$user_id)->sum('value');


        $Overhead_collection_level=Overhead_collection_level::where('created_by',$user_id)->sum('total_cost_of_packaging_material');
        $Overhead_labour_charges=Overhead_labour_charges::where('created_by',$user_id)->sum('total_estimated_cost');
        $Overhead_weighment_charges=Overhead_weighment_charges::where('created_by',$user_id)->sum('total_estimated_cost');
        $Overhead_transportation_charges=Overhead_transportation_charges::where('created_by',$user_id)->sum('estimated_total_cost_of_transportation');
        $Overhead_service_charges=Overhead_service_charges::where('created_by',$user_id)->sum('service_charge_in_total_value_of_procurement');
        $Overhead_warehouse_labour_charges=Overhead_warehouse_labour_charges::where('created_by',$user_id)->sum('total_estimated_cost');
        $Overhead_warehouse_charges=Overhead_warehouse_charges::where('created_by',$user_id)->sum('total_estimated_cost');
        $Overhead_estimated_wastages=Overhead_estimated_wastages::where('created_by',$user_id)->sum('estimated_driage_rs');
        $Overhead_service_charges_dia=Overhead_service_charges_dia::where('created_by',$user_id)->sum('service_charge_value');
        $Overhead_other_costs=Overhead_other_costs::where('created_by',$user_id)->sum('other_costs');


        $total_overhead_paid_value=$Overhead_collection_level + $Overhead_labour_charges + $Overhead_weighment_charges+$Overhead_transportation_charges+$Overhead_service_charges+$Overhead_warehouse_labour_charges+$Overhead_warehouse_charges+$Overhead_estimated_wastages+$Overhead_service_charges_dia+$Overhead_other_costs;

        return $total_released_to_procurement_agent_by_dia - ($actual_tribal_amount_paid + $total_mfp_storage_value + $total_overhead_paid_value);
    }

    
    public static function getCommission($amount,$role=null)
    {
        $user = Auth::user();
        $user_id=$user->id;
        if($role){
            $user_role=$role;
        }else{
            $user_role=$user->role;    
        }
        
        if($user_role ==5 || $user_role ==6 || $user_role ==7)
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
                    'commission_rate'=>$commission_rate,
                    'max_aggregate_commission'=>$max_aggregate_commission
                );
            }else{
                throw new \Exception("Commission rate is not set,please contact to admin");
            }    
        }else{
            return array(
                    'commission_amount'=>0,
                    'commission_rate'=>0,
                    'max_aggregate_commission'=>0
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
        if($user_role ==5 || $user_role ==6 || $user_role ==7)
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
                    $trifed_user = Mfp_procurement_status_log::leftJoin('users', function ($join) {
                        $join->on('mfp_procurement_status_log.assigned_to', '=', 'users.id');
                    })
                    ->where('users.role',2)//trifed
                    ->where(['mfp_procurement_status_log.consolidated_id' => $release->consolidated_id, 'mfp_procurement_status_log.is_assigned_next_level' => '1', 'mfp_procurement_status_log.status' => 1])
                    ->orderBy('mfp_procurement_status_log.id', 'desc')
                    ->select('mfp_procurement_status_log.*')
                    ->first();
                    if(!empty($trifed_user))
                    {
                        $to = User::findOrFail($trifed_user->assigned_to);
                        $to->notify(new AccessCommisionNotification($commision_master,$release,$from));
                    }
                    $ministry_user = Mfp_procurement_status_log::leftJoin('users', function ($join) {
                        $join->on('mfp_procurement_status_log.assigned_to', '=', 'users.id');
                    })
                    ->where('users.role',3)//ministry
                    ->where(['mfp_procurement_status_log.consolidated_id' => $release->consolidated_id, 'mfp_procurement_status_log.is_assigned_next_level' => '1', 'mfp_procurement_status_log.status' => 1])
                    ->orderBy('mfp_procurement_status_log.id', 'desc')
                    ->select('mfp_procurement_status_log.*')
                    ->first();
                    if(!empty($ministry_user))
                    {
                        $to = User::findOrFail($ministry_user->assigned_to);
                        $to->notify(new AccessCommisionNotification($commision_master,$release,$from));
                    }
                    $nodal_user = Mfp_procurement_status_log::leftJoin('users', function ($join) {
                        $join->on('mfp_procurement_status_log.assigned_to', '=', 'users.id');
                    })
                    ->where('users.role',4)//nodal
                    ->where(['mfp_procurement_status_log.consolidated_id' => $release->consolidated_id, 'mfp_procurement_status_log.is_assigned_next_level' => '1', 'mfp_procurement_status_log.status' => 1])
                    ->orderBy('mfp_procurement_status_log.id', 'desc')
                    ->select('mfp_procurement_status_log.*')
                    ->first();
                    if(!empty($nodal_user))
                    {
                        $to = User::findOrFail($nodal_user->assigned_to);
                        $to->notify(new AccessCommisionNotification($commision_master,$release,$from));
                    }
                        
                                        
                }
            }    
        }
    }

    public static function checkDiaAccessCommision($procurement)
    {
        $user = Auth::user();
        $user_id=$user->id;
        $user_role=$user->role;
        $user = Auth::user();
        $user_id=$user->id;
        $user_role=$user->role;
        
        $state= $user->getUserDetails->state;
        $commision_master=CommissionMaster::where(['state'=>$state,'role'=>$user_role,'status'=>'1'])->first();
        if(!empty($commision_master))
        {
            $commission_rate=$commision_master->commission;
            $max_aggregate_commission=$commision_master->max_aggregate_commission;
            if($procurement->commission_amount > $max_aggregate_commission)
            {
                //send Notification
                $from = User::findOrFail($user_id);
                $trifed_user = Mfp_procurement_status_log::leftJoin('users', function ($join) {
                    $join->on('mfp_procurement_status_log.assigned_to', '=', 'users.id');
                })
                ->where('users.role',2)//trifed
                ->where(['mfp_procurement_status_log.mfp_procurement_id' => $procurement->id, 'mfp_procurement_status_log.is_assigned_next_level' => '1', 'mfp_procurement_status_log.status' => 1])
                ->orderBy('mfp_procurement_status_log.id', 'desc')
                ->select('mfp_procurement_status_log.*')
                ->first();
                if(!empty($trifed_user))
                {
                    $to = User::findOrFail($trifed_user->assigned_to);
                    $to->notify(new DiaAccessCommisionNotification($commision_master,$procurement,$from));
                }
                $ministry_user = Mfp_procurement_status_log::leftJoin('users', function ($join) {
                    $join->on('mfp_procurement_status_log.assigned_to', '=', 'users.id');
                })
                ->where('users.role',3)//ministry
                ->where(['mfp_procurement_status_log.mfp_procurement_id' => $procurement->id, 'mfp_procurement_status_log.is_assigned_next_level' => '1', 'mfp_procurement_status_log.status' => 1])
                ->orderBy('mfp_procurement_status_log.id', 'desc')
                ->select('mfp_procurement_status_log.*')
                ->first();
                if(!empty($ministry_user))
                {
                    $to = User::findOrFail($ministry_user->assigned_to);
                    $to->notify(new DiaAccessCommisionNotification($commision_master,$procurement,$from));
                }
                $nodal_user = Mfp_procurement_status_log::leftJoin('users', function ($join) {
                    $join->on('mfp_procurement_status_log.assigned_to', '=', 'users.id');
                })
                ->where('users.role',4)//nodal
                ->where(['mfp_procurement_status_log.mfp_procurement_id' => $procurement->id,'mfp_procurement_status_log.is_assigned_next_level' => '1', 'mfp_procurement_status_log.status' => 1])
                ->orderBy('mfp_procurement_status_log.id', 'desc')
                ->select('mfp_procurement_status_log.*')
                ->first();
                if(!empty($nodal_user))
                {
                    $to = User::findOrFail($nodal_user->assigned_to);
                    $to->notify(new DiaAccessCommisionNotification($commision_master,$procurement,$from));
                }
                    
                                    
            }
        }    
        
    }

    public static function checkAccessCommisionOfPa($release)
    {
        $user = Auth::user();
        $user_id=$user->id;
        $user_role=$user->role;
        $user = Auth::user();
        $user_id=$user->id;
        $user_role=$user->role;
        if($user_role ==5 || $user_role ==6 || $user_role ==7)
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
                    $trifed_user = Mfp_procurement_status_log::leftJoin('users', function ($join) {
                        $join->on('mfp_procurement_status_log.assigned_to', '=', 'users.id');
                    })
                    ->where('users.role',2)//trifed
                    ->where(['mfp_procurement_status_log.consolidated_id' => $release->consolidated_id, 'mfp_procurement_status_log.is_assigned_next_level' => '1', 'mfp_procurement_status_log.status' => 1])
                    ->orderBy('mfp_procurement_status_log.id', 'desc')
                    ->select('mfp_procurement_status_log.*')
                    ->first();
                    if(!empty($trifed_user))
                    {
                        $to = User::findOrFail($trifed_user->assigned_to);
                        $to->notify(new AccessCommisionNotification($commision_master,$release,$from));
                    }
                    $ministry_user = Mfp_procurement_status_log::leftJoin('users', function ($join) {
                        $join->on('mfp_procurement_status_log.assigned_to', '=', 'users.id');
                    })
                    ->where('users.role',3)//ministry
                    ->where(['mfp_procurement_status_log.consolidated_id' => $release->consolidated_id, 'mfp_procurement_status_log.is_assigned_next_level' => '1', 'mfp_procurement_status_log.status' => 1])
                    ->orderBy('mfp_procurement_status_log.id', 'desc')
                    ->select('mfp_procurement_status_log.*')
                    ->first();
                    if(!empty($ministry_user))
                    {
                        $to = User::findOrFail($ministry_user->assigned_to);
                        $to->notify(new AccessCommisionNotification($commision_master,$release,$from));
                    }
                    $nodal_user = Mfp_procurement_status_log::leftJoin('users', function ($join) {
                        $join->on('mfp_procurement_status_log.assigned_to', '=', 'users.id');
                    })
                    ->where('users.role',4)//nodal
                    ->where(['mfp_procurement_status_log.consolidated_id' => $release->consolidated_id, 'mfp_procurement_status_log.is_assigned_next_level' => '1', 'mfp_procurement_status_log.status' => 1])
                    ->orderBy('mfp_procurement_status_log.id', 'desc')
                    ->select('mfp_procurement_status_log.*')
                    ->first();
                    if(!empty($nodal_user))
                    {
                        $to = User::findOrFail($nodal_user->assigned_to);
                        $to->notify(new AccessCommisionNotification($commision_master,$release,$from));
                    }
                        
                                        
                }
            }    
        }
    }

    public static function addFundTransactions($data)
    {
        $fund_transactions = new Mfp_procurement_fund_transactions($data);
        $fund_transactions->save();
    }

}