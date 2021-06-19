<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;


class HaatMarketTwoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $getBoundryWall = $this->getboundryWall;        
        $getBuiltupArea = $this->getbuiltupArea;        
        $getTransportation = $this->getTransportation;
        return [
            'id' => $this->id,
            'market_type' => $this->market_type,
            'market_charges' => $this->market_charges,
            'market_fees' => $this->market_fees,
            'broker_fees' => $this->broker_fees,
            'sitting_charges' => $this->sitting_charges,
            'commission_agency_charges' => $this->commission_agency_charges,
            'weighing_charges' => $this->weighing_charges,
            'user_charges' => $this->user_charges,
            'other_charges' => $this->other_charges,
            'boundary_wall' => isset($getBoundryWall->id)?$getBoundryWall->id:null,
            // 'boundary_wall_name' => $getBoundryWall->title,
            // 'boundary_wall_details' => $getBoundryWall,
            'built_up_area' => isset($getBuiltupArea->id)?$getBuiltupArea->id:null,
            // 'built_up_area_name' => $getBuiltupArea->title,
            // 'built_up_area_details' => $getBuiltupArea,
            'access_road' => $this->access_road,
            'internal_road' => $this->internal_road,
            'is_godown_secured' => (int)$this->is_godown_secured,
            'tonnage' => $this->tonnage,
            'godown_area' => $this->godown_area,
            'weigbridge' => (int)$this->weigbridge,
            'electronic_weighing_scale' => (int)$this->electronic_weighing_scale,
            'manual_weighing_scale' => (int)$this->manual_weighing_scale,
            'number' => $this->number,
            'is_demarcated_area' => (int)$this->is_demarcated_area,
            'cleaning_area' => $this->cleaning_area,
            'other_infrastructure' => $this->other_infrastructure,
            'transportation' => $this->transportation,
            'transportation_name' => $getTransportation,
            // 'transportation_details' => $this->getTransportation,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,

            /* to view details */

            'road_access' => isset($this->getRoadAccess)? strip_tags($this->getRoadAccess->title) : null,
            'internal_access' => isset($this->getInternalRoadAccess)? strip_tags($this->getInternalRoadAccess->title) : null,
            'market_name' => isset($this->getMarketType)? strip_tags($this->getMarketType->title): null,
            'transportation_details'=> $this->getTransportationdata($this->transportation),
        ];
    }
}
