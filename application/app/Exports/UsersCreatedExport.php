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
class UsersCreatedExport implements FromArray, WithTitle
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
        $user_arr=array();    
        $users_query="SELECT users.id as user_Id,user_roles.title as user_type, states_master.title as state_name ,districts_master.title as district, users.created_at as created , COUNT(users.id) as no_of_users_created FROM users LEFT JOIN user_details ON user_details.user_id = users.id LEFT JOIN user_roles ON user_roles.id = users.role LEFT JOIN states_master ON states_master.id = user_details.state LEFT JOIN districts_master ON districts_master.id = user_details.district WHERE date(users.created_at) BETWEEN '$from'AND '$to' GROUP BY user_details.district,users.role";    
        $user_query=DB::select($users_query);

         $heading1 = [
            'State',
            'District',
            'Role',
            
            'Number of users',
          
        ];    
        
        array_push($cols, $heading1);
        
        foreach ($user_query as $user) {
           
        	$col = [
                $user->state_name,
                $user->district,
                $user->user_type,
                $user->no_of_users_created,
				
				
			];

        	array_push($cols, $col);
        }
       //  dd($cols);   
        return $cols;

    }

    public function title(): string
    {
        return 'Users Created';
    }
}