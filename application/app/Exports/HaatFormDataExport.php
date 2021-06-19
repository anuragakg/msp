<?php

namespace App\Exports;

use App\Models\HaatBazaarFormMapping;
use App\Models\HaatMarketOne;
use App\Models\HaatMarketTwo;
use App\Models\HaatMarketThree;
use App\Models\HaatMarketFour;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class HaatFormDataExport implements FromArray, WithTitle 
{
    public function __construct($haat_markets) 
    {
       // print_r($haat_markets); die;
        $this->haat_markets = $haat_markets;
    }


    public function array(): array
    {

        
        $cols = [];


        $heading = [
            'Refrecne Id',
            'RPM Name',
            'Address',
            'RPM Location',
            'State',
            'District',
            'Block',
            'Gram Panchayat',
            'Village',
            'Pincode',
            'RPM ownership',
            'Operating RPM',
            'RPM premises',
            'On rent',
            'Rate per Annum',
            'Market Regulation',
            'Regulation Type',
            'Periodicity',
            'Working days',
            'Sale Start Time',
            'Sale End Time',
            'Staff Size',
            'Nearest Railway',
            'Railway Distance',
            'Nearest Highway',
            'Highway Distance',
            'Nearest APMC Market',
            'APMC Market Distance',
            'Nearest Bus Stand',
            'AGMARKNET',

            'Market Type',
            'Market Charges',
            'Commission Charges',
            'Broker Fees',
            'Sitting Charges',
            'Commission Agency Charges',
            'Weighing Charges',
            'User Charges',
            'Other Charges',
            'Boundary Wall',
            'Built Up Area',
            'Access Road',
            'Internal Road',
            'Is Godown Secured',
            'Tonnage',
            'Godown Area',
            'Weigbridge',
            'Electronic Weighing Scale',
            'Manual Weighing Scale',
            'Number',
            'Is Demarcated Area',
            'Cleaning Area',
            'Other Infrastructure',


            'Office',
            'Drinking Water',
            'Notice Board',
            'Urinal/Toilet With Water Supply',
            'Electricity',
            'Garbage Disposal System',
            'Parking',
            'Input Sundry Shop',
            'Hygienic',
            'Bank',
            'If Yes, Bank Branch Name',
            'Post Office',
            'If Yes, Post Office Branch Name',
            'Assaying Laboratory',
            'Assaying Laboratory Remarks',
            'Packaging & Labelling Facilities',
            'Packaging & Labelling Facilities Remarks',     
            'Drying Yards',
            'Drying Yards Remarks',
            'Bagging & Stitching Machine Facilities',
            'Bagging & Stitching Machine Facilities Remarks',
            'Loading,Unloading & Dispatch Facilities',
            'Loading,Unloading & Dispatch Facilities Remarks',
            'Pre-Conditioning-Cleaning',
            'Pre-Conditioning-Cleaning Remarks',
            'Integrated Pack-House',
            'Integrated Pack-House Remarks',
            'Storage Capacity',
            'Storage Capacity Remarks',
            'Primary Processing',
            'Primary Processing Remarks',
            'Information Display',
            'Information Display Remarks',
            'It Infrastructure',
            'It Infrastructure Remarks',
            'Storage(Dry/Cold)',
            'Storage(Dry/Cold) Remarks',
            'Public Address',
            'Public Address Remarks',
            'Extension and Training',
            'Extension and Training Remarks',
            'Boarding / Lodging',
            'Standardisation',
            'Standardisation Remarks',

            'Cleaning and Sanitation',
            'Waste Utilization',
            'Garbage Collection and Disposal',
            'Any Other Facility/Services',
            'Remarks',
            'Annual Income (In Rs.)',
            'Latitude',
            'Longitude'
            //'Distance from Nearest APMC Market (KM.)'

        ];

        array_push($cols, $heading);
          
        foreach ($this->haat_markets as $haat_market) {

            $col = [

//              print_r($haat_market['getPartOne']),
//              die(),
                $haat_market['id'],
                $haat_market['get_haat_market_part_one']['rpm_name'],
                $haat_market['get_haat_market_part_one']['rpm_location'],
                $haat_market['get_haat_market_part_one']['address'],
                $haat_market['get_haat_market_part_one']['get_state']['title'],
                $haat_market['get_haat_market_part_one']['get_district']['title'],
                $haat_market['get_haat_market_part_one']['get_block']['title'],
                $haat_market['get_haat_market_part_one']['gram_panchayat'],
                $haat_market['get_haat_market_part_one']['get_village']['title'],
                $haat_market['get_haat_market_part_one']['pin_code'],
                $haat_market['get_haat_market_part_one']['get_rpm_ownership']['title'],
                $haat_market['get_haat_market_part_one']['operating_rpm'],
                $haat_market['get_haat_market_part_one']['premises_rpm'] == 1 ? 'Owned' : 'Leased',
                $haat_market['get_haat_market_part_one']['is_on_rent'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_one']['rate_per_annum'] ?? null,
                $haat_market['get_haat_market_part_one']['get_market_regulation']['title'],
                $haat_market['get_haat_market_part_one']['get_reguation_type']['title'],
                $haat_market['get_haat_market_part_one']['get_periodicities']['title'],
                $haat_market['get_haat_market_part_one']['working_days'],
                $haat_market['get_haat_market_part_one']['sale_start_time'],
                $haat_market['get_haat_market_part_one']['sale_end_time'],
                $haat_market['get_haat_market_part_one']['staff_size'],

                $haat_market['get_haat_market_part_one']['get_linkage']['nearest_railway_station'] ?? null,
                $haat_market['get_haat_market_part_one']['get_linkage']['railway_distance'] ?? null,
                $haat_market['get_haat_market_part_one']['get_linkage']['nearest_highway'] ?? null,
                $haat_market['get_haat_market_part_one']['get_linkage']['highway_distance'] ?? null,
                $haat_market['get_haat_market_part_one']['get_linkage']['nearest_apmc_market'] ?? null,
                $haat_market['get_haat_market_part_one']['get_linkage']['apmc_distance'] ?? null,
                $haat_market['get_haat_market_part_one']['get_linkage']['nearest_bus_stand'] ?? null,
                $haat_market['get_haat_market_part_one']['get_linkage']['agmarknet_node'] == 1 ? 'Yes' : 'No',

                $haat_market['get_haat_market_part_two']['get_market_type']['title'],
                $haat_market['get_haat_market_part_two']['market_charges'],
                $haat_market['get_haat_market_part_two']['market_fees'],
                $haat_market['get_haat_market_part_two']['broker_fees'],
                $haat_market['get_haat_market_part_two']['sitting_charges'],
                $haat_market['get_haat_market_part_two']['commission_agency_charges'],
                $haat_market['get_haat_market_part_two']['weighing_charges'],
                $haat_market['get_haat_market_part_two']['user_charges'],
                $haat_market['get_haat_market_part_two']['other_charges'],
                $haat_market['get_haat_market_part_two']['getboundry_wall']['title'],
                $haat_market['get_haat_market_part_two']['getbuiltup_area']['title'],
                $haat_market['get_haat_market_part_two']['get_road_access']['title'],
                $haat_market['get_haat_market_part_two']['internal_road'],
                $haat_market['get_haat_market_part_two']['is_godown_secured'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_two']['tonnage'],
                $haat_market['get_haat_market_part_two']['godown_area'],
                $haat_market['get_haat_market_part_two']['weigbridge'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_two']['electronic_weighing_scale']  == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_two']['manual_weighing_scale']  == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_two']['number'],
                $haat_market['get_haat_market_part_two']['is_demarcated_area']  == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_two']['cleaning_area'],
                $haat_market['get_haat_market_part_two']['other_infrastructure'],

                $haat_market['get_haat_market_part_three']['office'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['drinking_water'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['notice_board'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['urinal_toilet'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['electricity'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['garbage_system'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['parking'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['input_sundry'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['hygienic'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['bank'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['bank_name'] ?? null,
                $haat_market['get_haat_market_part_three']['post_office'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['post_office_name'] ?? null,
                $haat_market['get_haat_market_part_three']['assaying_lab'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['assaying_lab_remarks'],
                $haat_market['get_haat_market_part_three']['packaging'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['packaging_remarks'],
                $haat_market['get_haat_market_part_three']['drying_yards'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['drying_yards_remarks'],
                $haat_market['get_haat_market_part_three']['bagging'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['bagging_remarks'],
                $haat_market['get_haat_market_part_three']['loading'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['loading_remarks'],
                $haat_market['get_haat_market_part_three']['conditioning'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['conditioning_remarks'],
                $haat_market['get_haat_market_part_three']['pack_house'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['pack_house_remarks'],
                $haat_market['get_haat_market_part_three']['storage_capacity'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['storage_capacity_remarks'],             
                $haat_market['get_haat_market_part_three']['primary_processing'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['primary_processing_remarks'],
                $haat_market['get_haat_market_part_three']['info_display'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['info_display_remarks'],
                $haat_market['get_haat_market_part_three']['it_infra'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['it_infra_remarks'],
                $haat_market['get_haat_market_part_three']['storage'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['storage_remarks'],
                $haat_market['get_haat_market_part_three']['public_address'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['public_address_remarks'],
                $haat_market['get_haat_market_part_three']['extension'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['extension_remarks'],
                $haat_market['get_haat_market_part_three']['boarding_lodging'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['standardisation'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_three']['standardisation_remarks'],
                
                $haat_market['get_haat_market_part_four']['cleaning_and_sanitation'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_four']['garbage_collection'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_four']['waste_utilization'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_four']['other_facility'] == 1 ? 'Yes' : 'No',
                $haat_market['get_haat_market_part_four']['remarks'],
                $haat_market['get_haat_market_part_four']['annual_income'],
                $haat_market['get_haat_market_part_four']['latitude'],
                $haat_market['get_haat_market_part_four']['longitude'],
               // $haat_market['get_haat_market_part_four']['nearest_apmc_distance']


            ];

            array_push($cols, $col);
        }

        return $cols;

    }

    public function title(): string
    {
        return 'HaatBazaarData';
    }
}