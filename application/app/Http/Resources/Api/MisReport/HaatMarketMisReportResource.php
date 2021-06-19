<?php

namespace App\Http\Resources\Api\MisReport;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Masters\Commodity;

class HaatMarketMisReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $commodity = $this->getMfpCommodity()->with('getCommodity')->first();
        $po = $this->getProcurementAgents;
        $commodity_data = $this->getMfpCommodity()->with('getCommodity')->get();
        $i=0;
        foreach ($po[0]['commodity'] as $rpm) {
           $commodity=Commodity::where('id', $rpm)->select('title')->get();
            $col[] = $commodity[$i]['title']?? '';
            $i++;
        }

        //return $cols;
        $part_one = $this->getPartOne;   
        $state = $this->getState($part_one['state']); 
        $district = $this->getDistrict($part_one['district_id']);
        $block = $this->getBlock($part_one['block_id']);        
        $village = $this->getVillage($part_one['village_id']); 

        return [
            'id'    =>$part_one['id'],
            'rpm_name'      => strip_tags($part_one['rpm_name']),
            'rpm_location'  => strip_tags($part_one['rpm_location']),
            'address'       => strip_tags($part_one['address']),
            'state_name'    => strip_tags($state[0]['title']),
            'district_name' => strip_tags($district[0]['title']),
            'block_name'    => strip_tags($block[0]['title']),
            'village_name'  => strip_tags($village[0]['title']),
            'commodity_data' => $commodity_data,
            'commodity'       => isset($commodity['getCommodity']) ? [
                    "title"         => strip_tags($commodity['getCommodity']['title']),
                    "unit"          => strip_tags($commodity['getCommodity']['unit']),
                    "state"         => $commodity['getCommodity']['state'],
                    "session"       => $commodity['getCommodity']['session'],
                    "common_name"   => strip_tags($commodity['getCommodity']['common_name']),
                    "lab_name"      => strip_tags($commodity['getCommodity']['lab_name']),
                    "quality"       => strip_tags($commodity['getCommodity']['quality']),
                    "photo"         => $commodity['getCommodity']['photo'],
                    "msp"           => $commodity['getCommodity']['msp'],
                    "status"        => $commodity['getCommodity']['status'],
                    "created_by"    => $commodity['getCommodity']['created_by'],
                    "updated_by"    => $commodity['getCommodity']['updated_by'],
            ] : null ,
            'agent'        => $po,
            'commodity' => $col,
            'status'        => $this->status,
        ];
    }
}
