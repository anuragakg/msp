<?php

namespace App\Lib;

use App\Models\User;
use App\Models\Masters\FinancialYear;
use Illuminate\Database\Eloquent\Builder;
use NumberFormatter;


/**
 * Common Service containing miscellaneous functions
 * 
 * @package App\Lib
 */
class CommonFunctions
{

    /**
     * Gets all the approvers of the vdvk.
     * 
     * @param \App\Models\Proposed\Vdvk $vdvk 
     * @return \App\Models\User[] 
     */
    public function getVdvkApprovers($vdvk)
    {
        return $vdvk->getProposalStatusLog->map(function ($log) {
            return $log->getAssignedTo;
        })->unique('id');
    }

    /**
     * Checks users having specific permissions
     * @param string|array $permissions 
     * @return User[]
     */
    public function usersHavingPermission($permissions = null)
    {
        if (!is_array($permissions)) {
            $permissions = [$permissions];
        }

        $users = User::whereHas('getPermissions', function (Builder $query) use ($permissions) {
            $query->whereIn('alias', $permissions);
        })->get();

        return $users;
    }

    /**
     * Checks All MO And Supervisor by surveyor
     * @param string|array $surveyor 
     * @return User[]
     */
    public function getSurveyorParentUser($surveyor_id)
    {
        $users = [];
        $supervisor = User::findOrFail($surveyor_id)->getParentUsers;
        if(isset($supervisor[0]['id']))
        {
            $mo = User::findOrFail($supervisor[0]['id'])->getParentUsers;
            array_push($users, $supervisor);
            array_push($users, $mo);    
        }
        return $users;
    }

    /**
     * Convert any numeric amount to text.
     * @param mixed $amount 
     * @return string 
     */
    public function amtInWords($amount)
    {
       /* $amt = new NumberFormatter(locale_get_default(), NumberFormatter::SPELLOUT);
        $words = $amt->format($amount);
        //$words = $amount;    
        return (\Illuminate\Support\Str::title($words) . ' Only');*/
        $number = $amount;
        $no = floor($number);
       $point = round($number - $no, 4) * 100;
       $hundred = null;
       $digits_1 = strlen($no);
       $i = 0;
       $str = array();
       $words = array('0' => '', '1' => 'One', '2' => 'Two',
            '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
            '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
            '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
            '13' => 'Thirteen', '14' => 'fourteen',
            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
            '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninety'
        );
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore','Billion','Trillion','Quadrillion','Quintillion');
        while ($i < $digits_1) 
        {
             $divider = ($i == 2) ? 10 : 100;
             $number = floor($no % $divider);
             $no = floor($no / $divider);
             $i += ($divider == 10) ? 1 : 2;
            if ($number) 
            {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] ." " . $digits[$counter] . $plural . " " . $hundred:
                    $words[floor($number / 10) * 10]
                    . " " . $words[$number % 10] . " "
                    . $digits[$counter] . $plural . " " . $hundred;
            } else $str[] = null;
        }
        $str = array_reverse($str);
        $result = implode('', $str);
      
        if(($point))
        {
                $points = ($point) ?
                    "." . $words[$point / 10] . " " . 
                $words[$point = $point % 10] : '';  
                $string= $result . "" . $points . " Paise Only";
        }else{
                $string= $result . "  Only" ;  
        }       
        
        return ucwords($string);
    }

    /**
     * Checks All MO And Supervisor by surveyor
     * @param string|array $surveyor 
     * @return User[]
     */
    public function getStateRoleUsers($roleIds,$state_id=null,$district_id=null)
    {
        $users = [];
        $users = User::whereIn('role',$roleIds)->whereHas('getUserDetails', function (Builder $query) use ($state_id,$district_id) {
                   if($state_id){
                        $query->where('state', $state_id);
                   }
                   if($district_id){
                        $query->where('district', $district_id);
                   }
                        
            })->get();
        
        return $users;
    }

    public function getPreviousFYIdFromCurrent($financial_year)
    {
        /*$fy_array=explode('-', $financial_year);
        $current_year=$fy_array[0];
        $previous_year=$current_year-1;
        $previous_year_date=$previous_year.'-04-01';
        $date=date_create($previous_year_date);

        if (date_format($date,"m") >= 4) {//On or After April (FY is current year - next year)
            $financial_year = (date_format($date,"Y")) . '-' . (date_format($date,"y")+1);
        } else {//On or Before March (FY is previous year - current year)
            $financial_year = (date_format($date,"Y")-1) . '-' . date_format($date,"y");
        }
        $financial_year=trim($financial_year);*/
        $FY_qry=FinancialYear::where('id','<',$financial_year)->first();
        
        if(!empty($FY_qry))
        {
            return $FY_qry->id;
        }else{
            return false;
        }
    }
}
