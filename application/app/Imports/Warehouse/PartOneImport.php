<?php

namespace App\Imports\Warehouse;

use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

$partOneImport = [];

class PartOneImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['partOneImport'] = [];
        $jsonDecode = json_decode($data);
        $x=0;
		
        foreach($jsonDecode as $jd){
            $GLOBALS['partOneImport'][$x]['reference_id'] = $jsonDecode[$x]->reference_id;
            $GLOBALS['partOneImport'][$x]['type'] = $jsonDecode[$x]->warehouse_type;
            $GLOBALS['partOneImport'][$x]['name'] = $jsonDecode[$x]->warehouse_name;
            $GLOBALS['partOneImport'][$x]['address'] = $jsonDecode[$x]->address;
            $GLOBALS['partOneImport'][$x]['mobile_no'] = $jsonDecode[$x]->mobile_no;
            //$GLOBALS['partOneImport'][$x]['name_private'] = $jsonDecode[$x]->name_private;
            $GLOBALS['partOneImport'][$x]['landline_no'] = $jsonDecode[$x]->landline_no;
            //$GLOBALS['partOneImport'][$x]['address_private'] = $jsonDecode[$x]->address_private;
            //$GLOBALS['partOneImport'][$x]['state'] = $jsonDecode[$x]->state;
            $GLOBALS['partOneImport'][$x]['district'] = $jsonDecode[$x]->district;
            $GLOBALS['partOneImport'][$x]['block'] = $jsonDecode[$x]->block;
            $GLOBALS['partOneImport'][$x]['gram_panchayat'] = $jsonDecode[$x]->gram_panchayat;
            $GLOBALS['partOneImport'][$x]['pin_code'] = $jsonDecode[$x]->pin_code;
            $GLOBALS['partOneImport'][$x]['village'] = $jsonDecode[$x]->village;
            $GLOBALS['partOneImport'][$x]['registration_no'] = $jsonDecode[$x]->registration_no;
            $GLOBALS['partOneImport'][$x]['registration_date'] = !empty($jsonDecode[$x]->registration_date)?date('d/m/Y',strtotime($jsonDecode[$x]->registration_date)):'';
            $GLOBALS['partOneImport'][$x]['authority'] = $jsonDecode[$x]->authority;
            $GLOBALS['partOneImport'][$x]['length'] = $jsonDecode[$x]->length;
            $GLOBALS['partOneImport'][$x]['max_stack_height'] = $jsonDecode[$x]->max_stacking_height;
            $GLOBALS['partOneImport'][$x]['width'] = $jsonDecode[$x]->width;
            $GLOBALS['partOneImport'][$x]['capacity'] = $jsonDecode[$x]->capacityin_tonnes;
            $GLOBALS['partOneImport'][$x]['warehouse_area'] = $jsonDecode[$x]->arealengthwidth;
            $GLOBALS['partOneImport'][$x]['capacity_utilization'] = $jsonDecode[$x]->capacity_utilization;
            $GLOBALS['partOneImport'][$x]['is_cold_storage_available'] = $jsonDecode[$x]->cold_storage_facility;
            //$GLOBALS['partOneImport'][$x]['is_ca_storage_available'] = $jsonDecode[$x]->is_ca_storage_available;
            $GLOBALS['partOneImport'][$x]['closed_days'] = $jsonDecode[$x]->closed_days;
            $GLOBALS['partOneImport'][$x]['open_time'] = $jsonDecode[$x]->open_hours;
            $GLOBALS['partOneImport'][$x]['close_time'] = $jsonDecode[$x]->close_hours;
            $GLOBALS['partOneImport'][$x]['is_generator'] = $jsonDecode[$x]->generator;
            $GLOBALS['partOneImport'][$x]['generator_capacity'] = $jsonDecode[$x]->capacitykw;
            $GLOBALS['partOneImport'][$x]['cold_storage_capacity'] = $jsonDecode[$x]->cold_storage_capacity;
            $GLOBALS['partOneImport'][$x]['chamber_wise_capacity'] = $jsonDecode[$x]->chamber_wise_capacity;
            $GLOBALS['partOneImport'][$x]['indemnification_available'] = $jsonDecode[$x]->indemnification_against_loss_of_damage_due_to_fire_and_burglray;
            $GLOBALS['partOneImport'][$x]['is_stuffing_facility'] = $jsonDecode[$x]->stuffing_facility;
            $GLOBALS['partOneImport'][$x]['is_open_yard_facility'] = $jsonDecode[$x]->open_yard_facility;
            $GLOBALS['partOneImport'][$x]['drying_facility'] = $jsonDecode[$x]->drying_facility;
            //$GLOBALS['partOneImport'][$x]['is_quality_agent'] = $jsonDecode[$x]->is_quality_agent;
            $GLOBALS['partOneImport'][$x]['is_commodities_stored'] = $jsonDecode[$x]->commodities_stored;
            $GLOBALS['partOneImport'][$x]['is_weightment'] = $jsonDecode[$x]->weighment;
            
            $x++;
        }
        
    }

    /*public function startCell() {
        return A1;
    }*/
    public function headingRow(): int
    {
        return 2;
    }
}