<?php

namespace App\Exports;

use App\Models\Masters\State;
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
class SioSndExport implements FromArray, WithTitle
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
        $snd_arr=array();    
        $snd_query="SELECT r.title as role,sm.id as state_id,sm.title as state,sum(case when date(u.`created_at`) BETWEEN '$from'AND '$to'  then 1 else 0 end) as new,count(u.id) as total FROM `users` u INNER JOIN user_roles r ON u.role=r.id LEFT JOIN user_details ud ON ud.user_id=u.id LEFT JOIN states_master sm ON ud.state=sm.id LEFT JOIN districts_master dm ON ud.district=dm.id WHERE  u.role=4 AND u.deleted_at is null GROUP BY ud.state";    


        $snd_user_query=DB::select($snd_query);

        if(!empty($snd_user_query))
        {
            foreach ($snd_user_query as $key => $user) {
                # code...
                $snd_arr[$user->state_id]=array(
                        'new'=>$user->new,
                        'total'=>$user->total,
                );
                
            }
        }


        //==============SIO=================
        $sio_arr=array();    
        $sio_query="SELECT r.title as role,sm.id as state_id,sm.title as state,sum(case when date(u.`created_at`) BETWEEN '$from'AND '$to' then 1 else 0 end) as new,count(u.id) as total FROM `users` u INNER JOIN user_roles r ON u.role=r.id LEFT JOIN user_details ud ON ud.user_id=u.id LEFT JOIN states_master sm ON ud.state=sm.id LEFT JOIN districts_master dm ON ud.district=dm.id WHERE  u.role=7 AND u.deleted_at is null GROUP BY ud.state";    
        $sio_user_query=DB::select($sio_query);

        if(!empty($sio_user_query))
        {
            foreach ($sio_user_query as $key => $user) {
                # code...
                $sio_arr[$user->state_id]=array(
                        'new'=>$user->new,
                        'total'=>$user->total,
                );
                
            }
        }
        
        //dd($hb_arr);
        $states = State::get();
         $heading1 = [
            '',
            'SND ',
            '',
            
            'SIO ',
            '',

            
        ];    
        $heading2 = [
			'State',
			
            'New',      //SND
			'Total',

            
            
            'New',      //SIO
            'Total',
            
            
		];
       

        array_push($cols, $heading1);
        array_push($cols, $heading2);

        foreach ($states as $state) {
            $new_snd=isset($snd_arr[$state->id]['new'])  ?  $snd_arr[$state->id]['new']: "0" ;
            $total_snd=isset($snd_arr[$state->id]['total'])  ?  $snd_arr[$state->id]['total'] : "0" ;

            
            $new_sio=isset($sio_arr[$state->id]['new'])  ?  $sio_arr[$state->id]['new']: "0" ;
            $total_sio=isset($sio_arr[$state->id]['total'])  ?  $sio_arr[$state->id]['total'] : "0" ;   

            

        	$col = [
				$state->title,
				$new_snd,
				$total_snd,
                
                $new_sio,
                $total_sio,

                
			];

        	array_push($cols, $col);
        }
        // dd($cols);   
        return $cols;

    }

    public function title(): string
    {
        return 'SND SIO';
    }
}