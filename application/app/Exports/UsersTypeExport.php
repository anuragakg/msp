<?php

namespace App\Exports;

use App\Models\Masters\State;
use App\Models\Masters\District;
use App\Models\User;
use App\Services\Service;
use App\Queries\StateQuery;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;
use DB;
class UsersTypeExport implements FromArray, WithTitle
{
    public function array(): array
    {

        $from=date('Y-m-d',strtotime($_REQUEST['from']));
        $to=$_REQUEST['to'];
        if(empty($to))
        {
            $to=date('Y-m-d');
        }else{
            $to=date('Y-m-d',strtotime($_REQUEST['to']));
        }
        $cols = [];
        $districts=array();
        //==============Supervisor=================
        $supervisor_arr=array();    
        $supervisor_query="SELECT r.title as role,ud.district,sum(case when date(u.`created_at`) BETWEEN '$from'AND '$to' then 1 else 0 end) as new,count(u.id) as total FROM `users` u INNER JOIN user_roles r ON u.role=r.id LEFT JOIN user_details ud ON ud.user_id=u.id LEFT JOIN states_master sm ON ud.state=sm.id LEFT JOIN districts_master dm ON ud.district=dm.id WHERE  u.role=12 AND u.status='1' AND u.deleted_at is null GROUP BY ud.district";    
        $supervisor_user_query=DB::select($supervisor_query);

        if(!empty($supervisor_user_query))
        {
            foreach ($supervisor_user_query as $key => $user) {
                # code...
                $supervisor_arr[$user->district]=array(
                        'new'=>$user->new,
                        'total'=>$user->total,
                );
                if(!in_array($user->district,$districts)){
                    $districts[]=$user->district;
                }
            }
        }
        

        //==============Surveyor=================
        $surveyor_arr=array();    
        $surveyor_query="SELECT r.title as role,ud.district,sum(case when date(u.`created_at`) BETWEEN '$from'AND '$to' then 1 else 0 end) as new,count(u.id) as total FROM `users` u INNER JOIN user_roles r ON u.role=r.id LEFT JOIN user_details ud ON ud.user_id=u.id LEFT JOIN states_master sm ON ud.state=sm.id LEFT JOIN districts_master dm ON ud.district=dm.id WHERE  u.role=11 AND u.status='1' AND u.deleted_at is null GROUP BY ud.district";    
        $surveyor_user_query=DB::select($surveyor_query);

        if(!empty($surveyor_user_query))
        {
            foreach ($surveyor_user_query as $key => $user) {
                # code...
                $surveyor_arr[$user->district]=array(
                        'new'=>$user->new,
                        'total'=>$user->total,
                );
                if(!in_array($user->district,$districts)){
                    $districts[]=$user->district;
                }
            }
        }//dd($surveyor_arr);

        //==============MO=================
        $mo_arr=array();    
        $mo_query="SELECT r.title as role,ud.district,sum(case when date(u.`created_at`) BETWEEN '$from'AND '$to' then 1 else 0 end) as new,count(u.id) as total FROM `users` u INNER JOIN user_roles r ON u.role=r.id LEFT JOIN user_details ud ON ud.user_id=u.id LEFT JOIN states_master sm ON ud.state=sm.id LEFT JOIN districts_master dm ON ud.district=dm.id WHERE  u.role=8 AND u.status='1' AND u.deleted_at is null GROUP BY ud.district";    
        $mo_user_query=DB::select($mo_query);

        if(!empty($mo_user_query))
        {
            foreach ($mo_user_query as $key => $user) {
                # code...
                $mo_arr[$user->district]=array(
                        'new'=>$user->new,
                        'total'=>$user->total,
                );
                if(!in_array($user->district,$districts)){
                    $districts[]=$user->district;
                }
            }
        }
        //==============DIO=================
        $dio_arr=array();    
        $dio_query="SELECT ud.district,sum(case when date(u.`created_at`) BETWEEN '$from'AND '$to' then 1 else 0 end) as new,count(u.id) as total FROM `users` u  LEFT JOIN user_details ud ON ud.user_id=u.id LEFT JOIN states_master sm ON ud.state=sm.id LEFT JOIN districts_master dm ON ud.district=dm.id WHERE  u.role=13 AND u.status='1' AND u.deleted_at is null GROUP BY ud.district";    
        $dio_user_query=DB::select($dio_query);

        if(!empty($dio_user_query))
        {
            foreach ($dio_user_query as $key => $user) {
                # code...
                $dio_arr[$user->district]=array(
                        'new'=>$user->new,
                        'total'=>$user->total,
                );
                if(!in_array($user->district,$districts)){
                    $districts[]=$user->district;
                }
            }
        } 
        //==============VDVK=================
        $vdvk_arr=array();    
        $vdvk_sqlquery="SELECT pl.district,sum(case when date(v.`updated_at`) BETWEEN '$from'AND '$to' then 1 else 0 end) as new,count(v.id) as total FROM `vdvk` v INNER JOIN proposed_location pl ON pl.vdvk_id=v.id LEFT JOIN states_master sm ON pl.state=sm.id  WHERE v.submission_status=1 GROUP BY pl.district  ";    
        $vdvk_query=DB::select($vdvk_sqlquery);
         
        if(!empty($vdvk_query))
        {
            foreach ($vdvk_query as $key => $user) {
                # code...
                $vdvk_arr[$user->district]=array(
                        'new'=>$user->new,
                        'total'=>$user->total,
                );
                if(!in_array($user->district,$districts)){
                    $districts[]=$user->district;
                }       
            }
        }
        //==============VDVK Fund Sanctioned=================
        $sanctioned_arr=array();    
        $sanctioned_sqlquery="SELECT pl.district,sum(case when `sanctioned_date` BETWEEN '$from'AND '$to' then mapping.sanctioned_amount else 0 end) as new,SUM(mapping.sanctioned_amount) as total FROM `sanction_letter_vdvk_mapping` mapping INNER JOIN sanction_letter_schema ON mapping.letter_id=sanction_letter_schema.id INNER JOIN vdvk ON vdvk.id=mapping.vdvk_id JOIN proposed_location pl ON pl.vdvk_id=vdvk.id  WHERE vdvk.sanctioned IN ('1','2') GROUP BY pl.district ";    
        $sanctioned_query=DB::select($sanctioned_sqlquery);
        // dd($sanctioned_query);
        if(!empty($sanctioned_query))
        {
            foreach ($sanctioned_query as $key => $user) {
                # code...
                $sanctioned_arr[$user->district]=array(
                        'new'=>$user->new,
                        'total'=>$user->total,
                );
                if(!in_array($user->district,$districts)){
                    $districts[]=$user->district;
                }       
            }
        }
        //==============SHG Group=================
        $shg_group_arr=array();    
        $shg_group_query="SELECT ud.district,sum(case when date(sg.`created_at`) BETWEEN '$from'AND '$to' then 1 else 0 end) as new,count(sg.id) as total FROM `shg_groups` sg LEFT JOIN user_details ud ON ud.user_id=sg.created_by LEFT JOIN states_master sm ON ud.state=sm.id  WHERE sg.deleted_at is null group by ud.district";    
        $shg_group_query=DB::select($shg_group_query);

        if(!empty($shg_group_query))
        {
            foreach ($shg_group_query as $key => $user) {
                # code...
                $shg_group_arr[$user->district]=array(
                        'new'=>$user->new,
                        'total'=>$user->total,
                );
                if(!in_array($user->district,$districts)){
                    $districts[]=$user->district;
                }       
            }
        }
        //============== Gatherer=================
        $shg_arr=array();    
        $shg_query="SELECT sg.district,
		sum(case when ((date(sg.`created_at`) BETWEEN '$from'AND '$to') AND sg.`is_mobile`='1' ) then 1 else 0 end) as new,
		sum(case when ((date(sg.`created_at`) BETWEEN '$from'AND '$to') AND sg.status='1' AND sg.`is_mobile`='1') then 1 else 0 end) as approved,
		sum(case when sg.`is_mobile`='1' then 1 else 0 end) as by_mobile,
		sum(case when (sg.`is_mobile`='1' AND sg.status='1') then 1 else 0 end) as by_mobile_verified,
		count(sg.id) as total
		FROM `shg_gatherers` sg LEFT JOIN states_master sm ON sg.state=sm.id  WHERE sg.deleted_at is null group by sg.district";    
        $shg_gatherer_query=DB::select($shg_query);
        // dd($shg_gatherer_query);   
        if(!empty($shg_gatherer_query))
        {
            foreach ($shg_gatherer_query as $key => $user) {
                # code...
                $shg_arr[$user->district]=array(
                        'new'=>$user->new,
                        'total'=>$user->total,
                        'approved'=>$user->approved,
                        'by_mobile'=>$user->by_mobile,
                        'by_mobile_verified'=>$user->by_mobile_verified,
                );
                if(!in_array($user->district,$districts)){
                    $districts[]=$user->district;
                }
            }
        }
        //==============Warehouse=================
        $wh_arr=array();    
        $wh_query="SELECT wo.district,
		sum(case when ((date(wm.`created_at`) BETWEEN '$from' AND '$to') AND wm.is_mobile='1') then 1 else 0 end) as new,
		sum(case when ((date(wm.`created_at`) BETWEEN '$from' AND '$to') AND wm.is_mobile='1' AND wm.status='1') then 1 else 0 end) as approved,
		sum(case when wm.is_mobile='1'  then 1 else 0 end) as by_mobile,
		sum(case when wm.is_mobile='1' AND wm.status=1  then 1 else 0 end) as by_mobile_verified,
		count(wm.id) as total
		FROM `warehouse_form_mapping` wm INNER JOIN warehouse_ones wo ON wm.part_one=wo.id LEFT JOIN states_master sm ON wo.state=sm.id WHERE wm.deleted_at is null  group by wo.district";    
        $warehouse_query=DB::select($wh_query);
        //dd($warehouse_query);
        if(!empty($warehouse_query))
        {
            foreach ($warehouse_query as $key => $user) {
                # code...
                $wh_arr[$user->district]=array(
                        'new'=>$user->new,
                        'approved'=>$user->approved,
                        'by_mobile'=>$user->by_mobile,
                        'by_mobile_verified'=>$user->by_mobile_verified,
                        'total'=>$user->total,
                );
                 if(!in_array($user->district,$districts)){
                    $districts[]=$user->district;
                }
            }
        }
        
        //==============Haat Bazaar=================
        $hb_arr=array();    
        $hb_query="SELECT ho.district_id as district,
		sum(case when ((date(hb.`created_at`) BETWEEN '$from'AND '$to' ) AND hb.is_mobile='1') then 1 else 0 end) as new,
		sum(case when ((date(hb.`created_at`) BETWEEN '$from'AND '$to' ) AND hb.is_mobile='1' AND hb.status='1') then 1 else 0 end) as approved,
		sum(case when hb.`is_mobile`='1' then 1 else 0 end) as by_mobile,
		sum(case when (hb.`is_mobile`='1' AND hb.status='1') then 1 else 0 end) as by_mobile_verified,
		count(hb.id) as total
		FROM `haat_bazaar_form_mapping` hb INNER JOIN haat_market_one ho ON hb.part_one=ho.id LEFT JOIN states_master sm ON ho.state=sm.id WHERE hb.deleted_at is null  group by ho.district_id";    
        $haatbazaar_query=DB::select($hb_query);
        //dd($warehouse_query);
        if(!empty($haatbazaar_query))
        {
            foreach ($haatbazaar_query as $key => $user) {
                # code...
                $hb_arr[$user->district]=array(
                        'new'=>$user->new,
                        'approved'=>$user->approved,
						'by_mobile'=>$user->by_mobile,
                        'by_mobile_verified'=>$user->by_mobile_verified,
                        'total'=>$user->total,
                );
                 if(!in_array($user->district,$districts)){
                    $districts[]=$user->district;
                }
            }
        }    

        //dd($districts);
        $districts_master = District::leftJoin('states_master', function($join) {
                  $join->on('districts_master.state_id', '=', 'states_master.id');
                })
                ->whereIn('districts_master.id',$districts)
                ->select('districts_master.id as district_id','districts_master.title as district_name','states_master.title as state_name')
                ->get();
        
       // dd($districts_master);
         $heading1 = [
            '',
            '',
            
            'MO ',
            '',
            'DIO ',
            '',
            'Supervisor ',
            '',
            'Surveyor',
            '',
            'VDVK',
            '',
            'Sanctioned',
            '',
            'SHG',
            '',
            'Beneficiaries',
            '',
            '',
            '',
            '',
            'Warehouse',
            '',
            '',
            '',
            '',
            'Haat Bazaar',
            '',
            '',
            '',
            '',
        ];    
        $heading2 = [
            'State',
			'District',
			
            
            'New',      //MO
            'Total',

            'New',      //DIO
            'Total',

            'New',      // Supervisor
            'Total',
            
            'New',      //Surveyor
            'Total',

            'New',      //VDVK
            'Total',

            'New',      //Sanctioned
            'Total',

            'New',      //SHG
            'Total',    

            'New',      //Beneficiary
            'Verified By Supervisor',
            'Total Mobile Survey',
            'Total Mobile Survey Verified',
            'Total',

            'New',      //Warehouse
            'Verified By Supervisor',
            'Total Mobile Survey',
            'Total Mobile Survey Verified',
            'Total',

            'New',      //Haat
            'Verified By Supervisor',
            'Total Mobile Survey',
            'Total Mobile Survey Verified',
            'Total',
		];
       

        array_push($cols, $heading1);
        array_push($cols, $heading2);

        foreach ($districts_master as $district) {
           
            $new_mo=isset($mo_arr[$district->district_id]['new'])  ?  $mo_arr[$district->district_id]['new']: "0" ;
            $total_mo=isset($mo_arr[$district->district_id]['total'])  ?  $mo_arr[$district->district_id]['total'] : "0" ;

            $new_dio=isset($dio_arr[$district->district_id]['new'])  ?  $dio_arr[$district->district_id]['new']: "0" ;
            $total_dio=isset($dio_arr[$district->district_id]['total'])  ?  $dio_arr[$district->district_id]['total'] : "0" ;

           
            $new_supervisor=isset($supervisor_arr[$district->district_id]['new'])  ?  $supervisor_arr[$district->district_id]['new']: "0" ;
            $total_supervisor=isset($supervisor_arr[$district->district_id]['total'])  ?  $supervisor_arr[$district->district_id]['total'] : "0" ;   

            $new_surveyor=isset($surveyor_arr[$district->district_id]['new'])  ?  $surveyor_arr[$district->district_id]['new']: "0" ;
            $total_surveyor=isset($surveyor_arr[$district->district_id]['total'])  ?  $surveyor_arr[$district->district_id]['total'] : "0" ;  

            $new_shg_group=isset($shg_group_arr[$district->district_id]['new'])  ?  $shg_group_arr[$district->district_id]['new']: "0" ;
            $total_shg_group=isset($shg_group_arr[$district->district_id]['total'])  ?  $shg_group_arr[$district->district_id]['total'] : "0" ;  

            $new_vdvk=isset($vdvk_arr[$district->district_id]['new'])  ?  $vdvk_arr[$district->district_id]['new']: "0" ;
            $total_vdvk=isset($vdvk_arr[$district->district_id]['total'])  ?  $vdvk_arr[$district->district_id]['total'] : "0" ; 

            $new_sanctioned=isset($sanctioned_arr[$district->district_id]['new'])  ?  $sanctioned_arr[$district->district_id]['new']: "0" ;
            $total_sanctioned=isset($sanctioned_arr[$district->district_id]['total'])  ?  $sanctioned_arr[$district->district_id]['total'] : "0" ;  

            $new_shg=isset($shg_arr[$district->district_id]['new'])  ?  $shg_arr[$district->district_id]['new']: "0" ;
            $total_shg=isset($shg_arr[$district->district_id]['total'])  ?  $shg_arr[$district->district_id]['total'] : "0" ;  
            $total_shg_by_mobile=isset($shg_arr[$district->district_id]['by_mobile'])  ?  $shg_arr[$district->district_id]['by_mobile'] : "0" ;  
            $total_shg_by_mobile_verified=isset($shg_arr[$district->district_id]['by_mobile_verified'])  ?  $shg_arr[$district->district_id]['by_mobile_verified'] : "0" ;  
            $new_shg_approved=isset($shg_arr[$district->district_id]['approved'])  ?  $shg_arr[$district->district_id]['approved'] : "0" ;  


			//=========Warehouse Data=========
            $new_wh=isset($wh_arr[$district->district_id]['new'])  ?  $wh_arr[$district->district_id]['new']: "0" ;
            $new_wh_approved=isset($wh_arr[$district->district_id]['approved'])  ?  $wh_arr[$district->district_id]['approved']: "0" ;
            $wh_by_mobile=isset($wh_arr[$district->district_id]['by_mobile'])  ?  $wh_arr[$district->district_id]['by_mobile']: "0" ;
            $wh_by_mobile_verified=isset($wh_arr[$district->district_id]['by_mobile_verified'])  ?  $wh_arr[$district->district_id]['by_mobile_verified']: "0" ;
            $total_wh=isset($wh_arr[$district->district_id]['total'])  ?  $wh_arr[$district->district_id]['total'] : "0" ;   
			//=========Haat Bazaar Data===========
            $new_hb=isset($hb_arr[$district->district_id]['new'])  ?  $hb_arr[$district->district_id]['new']: "0" ;
            $new_hb_approved=isset($hb_arr[$district->district_id]['approved'])  ?  $hb_arr[$district->district_id]['approved']: "0" ;
            $hb_by_mobile=isset($hb_arr[$district->district_id]['by_mobile'])  ?  $hb_arr[$district->district_id]['by_mobile']: "0" ;
            $hb_by_mobile_verified=isset($hb_arr[$district->district_id]['by_mobile_verified'])  ?  $hb_arr[$district->district_id]['by_mobile_verified']: "0" ;
            $total_hb=isset($hb_arr[$district->district_id]['total'])  ?  $hb_arr[$district->district_id]['total'] : "0" ;    

        	$col = [
                $district->state_name,
				$district->district_name,
				
                $new_mo,
                $total_mo,
                $new_dio,
                $total_dio,

                $new_supervisor,
                $total_supervisor,
                $new_surveyor,
                $total_surveyor,
                
                $new_vdvk,
                $total_vdvk,    

                $new_sanctioned,
                $total_sanctioned,    

                $new_shg_group,
                $total_shg_group,



                $new_shg,
                $new_shg_approved,
                $total_shg_by_mobile,
                $total_shg_by_mobile_verified,
                $total_shg,

                

                $new_wh,
                $new_wh_approved,
                $wh_by_mobile,
                $wh_by_mobile_verified,
                $total_wh,

                $new_hb,
                $new_hb_approved,
                $hb_by_mobile,
                $hb_by_mobile_verified,
                $total_hb,
			];

        	array_push($cols, $col);
        }
        // dd($cols);   
        return $cols;

    }

    public function title(): string
    {
        return 'Users';
    }
}