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
class UsersActivityExport implements FromArray, WithTitle
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
        $users_query="SELECT users.id as user_Id, users.user_name, user_roles.title as user_type, states_master.title as state_name ,districts_master.title as district, users_activity.activity, users_activity.updated_at as activity_date FROM users_activity  LEFT JOIN users ON users.id=users_activity.user_id LEFT JOIN user_details ON user_details.user_id = users_activity.user_id LEFT JOIN user_roles ON user_roles.id = users.role LEFT JOIN states_master ON states_master.id = user_details.state LEFT JOIN districts_master ON districts_master.id = user_details.district WHERE date(users_activity.updated_at) BETWEEN '$from'AND '$to'";    
        $user_query=DB::select($users_query);
          //  dd($user_query);
         $heading1 = [
            'User Name',
            'Role',
            'State',
            'District',
            'Activity',
            'Group',
            'Activity Date',
            
        ];    
        
        array_push($cols, $heading1);
        
        $keyword_aray=array(
                'List'=>'Administrative',
                'Changed Shg Status'=>'Survey Approval System',
                'Created Block'=>'Administrative',
                'Created Haat Market Part'=>'Survey Activity',
                'Created Scheduled Tribes'=>'Administrative',
                'Created Shg Part'=>'Survey Activity',
                'Update SHG Part'=>'Survey Activity',
                'Created User'=>'Administrative',
                'View'=>'Administrative',
                'View'=>'Administrative',
                'Manage'=>'Administrative',
                'Login'=>'Administrative',
        );    
    

        foreach ($user_query as $user) {
                    $activity=$user->activity;
                    $group='';
                if (strpos($activity, 'Login') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'Manage') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'View') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'Created User') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'Created User') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'Created Scheduled Tribes') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'Created Block') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'List') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'Changed Shg Status') !== false) {
                          $group='Survey Approval System';
                }else if (strpos($activity, 'Created Block') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'Created Haat Market Part') !== false) {
                          $group='Survey Activity';
                }else if (strpos($activity, 'Created Shg Part') !== false) {
                          $group='Survey Activity';
                }else if (strpos($activity, 'Update SHG Part') !== false) {
                          $group='Survey Activity';
                }else if (strpos($activity, 'Manage All') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'Import Excel') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'Export Excel') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'MIS Report') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'User List') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'Update List') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'Update User') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'User Role') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'Mapping') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'Year List') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'Manage All') !== false) {
                          $group='Administrative';
                }else if (strpos($activity, 'Create Warehouse Part') !== false) {
                          $group='Survey Activity';
                }else if (strpos($activity, 'Update Warehouse Part') !== false) {
                          $group='Survey Activity';
                }else if (strpos($activity, 'Update SHG Part') !== false) {
                          $group='Survey Activity';
                }else if (strpos($activity, 'Update Haat Bazaar Part') !== false) {
                          $group='Survey Activity';
                } else{
                    $group='Administrative';
                }


            $col = [
                $user->user_name,
                $user->user_type,
                $user->state_name,
                $user->district,
                $user->activity,
                $group,
                $user->activity_date,
                
            ];

            array_push($cols, $col);
        }
       //  dd($cols);   
        return $cols;

    }

    public function title(): string
    {
        return 'Users Activty';
    }
}