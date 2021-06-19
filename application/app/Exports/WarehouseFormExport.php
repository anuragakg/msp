<?php

namespace App\Exports;

use App\Models\Warehouse\WarehouseFormMapping;
use App\Models\WareHouseOne;
use App\Models\WareHouseTwo;
use App\Models\WareHouseThree;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class WarehouseFormExport implements FromArray, WithTitle
{   

    public function __construct($warehouses) 
    {
        //print_r($warehouses); die;
        $this->warehouses = $warehouses;
    }

    public function array(): array
    {
        $cols = [];

        $heading = [
            'Refrence Id',
            'Type',
            'Name',
            'Address',
            'Mobile No.',
            'Landline No',
            'State',
            'District',
            'Block',
            'Gram Panchayat',
            'Pincode',
            'Village',
            'Registration No.',
            'Registration Date',
            'Authority',
            'Length',
            'Max Stack Height',
            'Width',
            'Capacity',
            'Warehouse Area',
            'Capacity Utilization',
            'Cold Storage',
            'CA Storage',
            'Closed Days',
            'Open Time',
            'Close Time',
            'Generator Capacity',
            'Cold Storage Capacity',
            'Chamber Wise Capacity',
            'Indemnification Available',
            'Stuffing Facility',
            'Open Yard Facility',
            'Quality Agent',
            'Commodities Stored',
            'Weightment',
            'Weighbridge',          
            'Weighbridge Number',
            'Electronic Weighing Scale',
            'Electronic Weighing Number',
            'Manual Weighing Scale',            
            'Manual Weighing Number',
            'Storage Rack',
            'Storage Rack Number',
            'Nearest Railway',
            'Railway Distance',
            'Nearest Highway',
            'Highway Distance',
            'Nearest APMC Market',
            'APMC Market Distance',
            'Nearest Haat Bazaar',
            'Haat Bazaar Distance',
            'Premises',
            'Farmers',
            'Government',
            'Societies',
            'Private',
            'Traders',           
            'Sop Management',
            'Disinfestation',
            'Fumigation of stores',
            'Handling and Wagon clearance',
            'Srcc',
            'Srcc Insurance',
            'Calamity',
            'Calamity Insurance',
            'Terrorist Damage',
            'Terrorist Damage Insurance',
            'Sealed Sample',
            'Sealed Sample Remarks',
            'Nwr',
            'Nwr Remark',
            'Stock Percent',
            'Nwr Count',
            'Process Nwr',
            'Awareness',
            'Bank',
            'Latitude',
            'Longitude',
            'Age Of Ware House',
            'Ware House Condition',

        ];


        array_push($cols, $heading);
        //dd($this->warehouses);
        foreach ($this->warehouses as $warehouse) {
            if(isset($warehouse->getPartOne->name))
            { 
                if($warehouse->getPartOne->type==1)
                {
                    $Type='Central Warehousing Corporation';
                }elseif($warehouse->getPartOne->type==2)
                {
                    $Type='State Warehousing Corporation';
                }elseif ($warehouse->getPartOne->type==3) {
                    $Type='Private Warehouses';
                }else
                {
                    $Type='Society Managed Warehouses';
                }
                $col = [
                    $warehouse['id'],                    
                    $Type ?? null,
                    $warehouse->getPartOne->name ?? null,
                    $warehouse->getPartOne->address ?? null,
                    $warehouse->getPartOne->mobile_no ?? null,
                    $warehouse->getPartOne->landline_no ?? null,
                    $warehouse->getPartOne->getState->title ?? null,
                    $warehouse->getPartOne->getDistrict->title ?? null,
                    $warehouse->getPartOne->getBlock->title ?? null,
                    $warehouse->getPartOne->gram_panchayat ?? null,
                    $warehouse->getPartOne->pin_code ?? null,
                    $warehouse->getPartOne->getVillage->title ?? null,
                    $warehouse->getPartOne->registration_no ?? null,
                    date('m/d/Y',strtotime($warehouse->getPartOne->registration_date ?? null)),
                    $warehouse->getPartOne->authority ?? null,
                    $warehouse->getPartOne->length ?? null,
                    $warehouse->getPartOne->max_stack_height ?? null,
                    $warehouse->getPartOne->width ?? null,
                    $warehouse->getPartOne->capacity ?? null,
                    $warehouse->getPartOne->warehouse_area ?? null,
                    $warehouse->getPartOne->capacity_utilization ?? null,
                    $warehouse->getPartOne->is_cold_storage_available ?? null,
                    $warehouse->getPartOne->is_ca_storage_available ?? null,
                    explode(',', $warehouse->getPartOne->closed_days ?? null),
                    $warehouse->getPartOne->open_time ?? null,
                    $warehouse->getPartOne->close_time ?? null,
                    $warehouse->getPartOne->is_generator ?? null,
                    $warehouse->getPartOne->cold_storage_capacity ?? null,
                    $warehouse->getPartOne->chamber_wise_capacity ?? null,
                    $warehouse->getPartOne->indemnification_available ?? null,
                    $warehouse->getPartOne->is_stuffing_facility ?? null,
                    $warehouse->getPartOne->is_open_yard_facility ?? null,
                    $warehouse->getPartOne->drying_facility ?? null,
                    $warehouse->getPartOne->is_quality_agent ?? null,
                    $warehouse->getPartOne->is_commodities_stored ?? null,
                    $warehouse->getPartOne->is_weightment ?? null,
                    $warehouse->getPartTwo->weighbridge ?? null,
                    $warehouse->getPartTwo->weighbridge_number ?? null,
                    $warehouse->getPartTwo->electronic_weighing_scale ?? null,
                    $warehouse->getPartTwo->electronic_weighing_number ?? null,
                    $warehouse->getPartTwo->manual_weighing_scale ?? null,
                    $warehouse->getPartTwo->manual_weighing_number ?? null,
                    $warehouse->getPartTwo->storage_rack ?? null,
                    $warehouse->getPartTwo->storage_rack_number ?? null,
                    $warehouse->getPartTwo->getLinkageDetails->nearest_railwaystation ?? null,
                    $warehouse->getPartTwo->getLinkageDetails->railwaystation_distance ?? null,
                    $warehouse->getPartTwo->getLinkageDetails->nearest_highway ?? null,
                    $warehouse->getPartTwo->getLinkageDetails->highway_distance ?? null,
                    $warehouse->getPartTwo->getLinkageDetails->nearest_apmc_market ?? null,
                    $warehouse->getPartTwo->getLinkageDetails->nearest_apmc_market_distance ?? null,
                    $warehouse->getPartTwo->getLinkageDetails->nearest_haat_bazaar ?? null,
                    $warehouse->getPartTwo->getLinkageDetails->nearest_haat_bazaar_distance ?? null,
                    $warehouse->getPartTwo->getLinkageDetails->premises ?? null,
                    $warehouse->getPartTwo->getDepositor->farmers ?? null,
                    $warehouse->getPartTwo->getDepositor->government ?? null,
                    $warehouse->getPartTwo->getDepositor->societies ?? null,
                    $warehouse->getPartTwo->getDepositor->private ?? null,
                    $warehouse->getPartTwo->getDepositor->traders ?? null,
                    $warehouse->getPartThree->sop_management ?? null,
                    $warehouse->getPartThree->disinfestation ?? null,
                    $warehouse->getPartThree->fumigation ?? null,
                    $warehouse->getPartThree->handling_clearance ?? null,
                    $warehouse->getPartThree->srcc ?? null,
                    $warehouse->getPartThree->srcc_insurance ?? null,
                    $warehouse->getPartThree->calamity ?? null,
                    $warehouse->getPartThree->calamity_insurance ?? null,
                    $warehouse->getPartThree->terrorist_damage ?? null,
                    $warehouse->getPartThree->terrorist_damage_insurance ?? null ,
                    $warehouse->getPartThree->sealed_sample ?? null,
                    $warehouse->getPartThree->sealed_sample_remarks ?? null,
                    $warehouse->getPartThree->nwr ?? null,
                    $warehouse->getPartThree->nwr_remarks ?? null,
                    $warehouse->getPartThree->stock_percent ?? null,
                    $warehouse->getPartThree->nwr_count ?? null,
                    $warehouse->getPartThree->process_nwr ?? null,
                    $warehouse->getPartThree->awareness ?? null,
                    $warehouse->getPartThree->bank ?? null,
                    $warehouse->getPartThree->latitude ?? null,
                    $warehouse->getPartThree->longitude ?? null,
                    $warehouse->getPartThree->warehouse_age ?? null,
                    $warehouse->getPartThree->warehouse_condition ?? null,
                
                ];

                array_push($cols, $col);    
            }
            
        }

        return $cols;

    }
    public function title(): string
    {
        return 'WarehouseData';
    }
}