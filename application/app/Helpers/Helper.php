<?php 

namespace App\Helpers;
use Illuminate\Support\Facades\Auth;
use App\Models\Mfp_procurement_dia_release;
use App\Models\Actualdetail\Mfp_procurement_actual_detail;
use App\Models\Proposals\Mfp_storage_actual_other;

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

class Helper
{
    public static function decimalNumberFormat($num)
    {
    	if($num ==''){
    		return '';	
    	}else if($num <= 0 )
    	{
    		return '0.0000';
    	}else{
    		return number_format((float)$num, 4, '.', '');
    	}
    }
    public static  function ordinal_suffix($num){
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


    public static function decimalNumber($number)
    {
        if($number==''){
            return 0;
        }
        $number = round($number,4);
        return $number;
    }



}