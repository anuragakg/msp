<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;


class HaatMarketFourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {     
        $procurementAgent['haat_data'] = $this->getProcurementAgent;  
        $annualExpenditure['haat_data'] = $this->getHaatMarketAnnualExpenditure;
        $mfpCommodity['haat_data'] = $this->getMfpCommodity;        
        //$getAgentCommodity = $this->getAgentCommodity;       
       // print_r($getAgentCommodity); die();
        return [
            'id' => $this->id,
            'cleaning_and_sanitation' => (int)$this->cleaning_and_sanitation,
            'garbage_collection' => (int)$this->garbage_collection,
            'waste_utilization' => (int)$this->waste_utilization,
            'other_facility' => (int)$this->other_facility,
            'remarks' => strip_tags($this->remarks),
            'annual_income' => strip_tags($this->annual_income),
            'latitude' => strip_tags($this->latitude),
            'longitude' => strip_tags($this->longitude),
            'nearest_apmc_distance' => (string)$this->nearest_apmc_distance,
            'haat_bazaar_annual_expenditure' => $annualExpenditure,
            'haat_bazaar_mfp_commodities' => $mfpCommodity,
            'haat_bazaar_procurement_agent' => $procurementAgent,
           // 'agent_commodity' =>$getAgentCommodity,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by, 
        ];

    }
}
