<?php

namespace App\Imports;

use App\Models\HaatMarketOne;
use App\Models\HaatMarketLinkages;
use App\Models\OtherHaatBazaar;
use App\Models\HaatBazaarFormMapping;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;

$haatOneData = [];
class HaatMarketOneImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['haatOneData'] = [];
        $jsonDecode = json_decode($data);
        $x=0;
        foreach($jsonDecode as $jd){
            
            if (!array_key_exists("reference_id",$jsonDecode[$x]))
            {
                return false;
            }

            $GLOBALS['haatOneData'][$x]['reference_id'] = $jsonDecode[$x]->reference_id;
            $GLOBALS['haatOneData'][$x]['rpm_name'] = $jsonDecode[$x]->rpm_name;
            $GLOBALS['haatOneData'][$x]['rpm_location'] = $jsonDecode[$x]->rpm_location;
            $GLOBALS['haatOneData'][$x]['address'] = $jsonDecode[$x]->address;
            //$GLOBALS['haatOneData'][$x]['state'] = $jsonDecode[$x]->state;
            $GLOBALS['haatOneData'][$x]['district'] = $jsonDecode[$x]->district;
            $GLOBALS['haatOneData'][$x]['block'] = $jsonDecode[$x]->block;
            $GLOBALS['haatOneData'][$x]['gram_panchayat'] = $jsonDecode[$x]->gram_panchayat;
            $GLOBALS['haatOneData'][$x]['village'] = $jsonDecode[$x]->village;
            $GLOBALS['haatOneData'][$x]['pin_code'] = $jsonDecode[$x]->pin_code;
            $GLOBALS['haatOneData'][$x]['rpm_ownership'] = $jsonDecode[$x]->rpm_ownership;
            $GLOBALS['haatOneData'][$x]['operating_rpm'] = $jsonDecode[$x]->operating_rpm;
            $GLOBALS['haatOneData'][$x]['premises_rpm'] = $jsonDecode[$x]->premises_rpm;
            // $GLOBALS['haatOneData'][$x]['is_on_rent'] = $jsonDecode[$x]->is_on_rent;
            // $GLOBALS['haatOneData'][$x]['rate_per_annum'] = $jsonDecode[$x]->rate_per_annum;
            $GLOBALS['haatOneData'][$x]['market_regulation'] = $jsonDecode[$x]->market_regulation;
            $GLOBALS['haatOneData'][$x]['regulation_type'] = $jsonDecode[$x]->regulation_type;
            $GLOBALS['haatOneData'][$x]['periodicity'] = $jsonDecode[$x]->periodicity;
            $GLOBALS['haatOneData'][$x]['working_days'] = $jsonDecode[$x]->working_days;

            $GLOBALS['haatOneData'][$x]['sale_start_time'] = Date::excelToDateTimeObject($jsonDecode[$x]->sale_start_time)->format('H:i');
            $GLOBALS['haatOneData'][$x]['sale_end_time'] = Date::excelToDateTimeObject($jsonDecode[$x]->sale_end_time)->format('H:i');

            $GLOBALS['haatOneData'][$x]['staff_size'] = $jsonDecode[$x]->staff_size;
            $GLOBALS['haatOneData'][$x]['nearest_railway_station'] = $jsonDecode[$x]->nearest_railway_station;
            $GLOBALS['haatOneData'][$x]['railway_distance'] = $jsonDecode[$x]->railway_distance;
            $GLOBALS['haatOneData'][$x]['nearest_highway'] = $jsonDecode[$x]->nearest_highway;
            $GLOBALS['haatOneData'][$x]['highway_distance'] = $jsonDecode[$x]->highway_distance;
            $GLOBALS['haatOneData'][$x]['nearest_apmc_market'] = $jsonDecode[$x]->nearest_apmc_market;
            $GLOBALS['haatOneData'][$x]['apmc_distance'] = $jsonDecode[$x]->apmc_distance;
            $GLOBALS['haatOneData'][$x]['nearest_bus_stand'] = $jsonDecode[$x]->nearest_bus_stand;
            $GLOBALS['haatOneData'][$x]['agmarknet_node'] = $jsonDecode[$x]->agmarknet_node;
            $x++;
        }
    }

    public function headingRow(): int
    {
        return 2;
    }
}