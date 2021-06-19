<?php

namespace App\Http\Resources\Api\Warehouse;


use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseViewPartThreeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $bank_data = $this->getBankDetails;
		$commodities_data = $this->getWarehouse_mfp_commodities_Details;
        return [
            'id' => $this->id,
            'form_id' => $this->form_id,
            'sop_management' => $this->sop_management,
            'disinfestation' => $this->disinfestation,
            //'spraying' => $this->spraying,
            'fumigation' => $this->fumigation,
           // 'termite_treatment' => $this->termite_treatment,
           // 'chemical_bating' => $this->chemical_bating,
           // 'risk_steps' => $this->risk_steps,
            'handling_clearance' => $this->handling_clearance,
            'srcc' => $this->srcc,
            'srcc_insurance' => $this->srcc_insurance,
            'calamity' => $this->calamity,
            'calamity_insurance' => $this->calamity_insurance,
            'terrorist_damage' => $this->terrorist_damage,
            'terrorist_damage_insurance' => $this->terrorist_damage_insurance,
            'sealed_sample' => $this->sealed_sample,
            'sealed_sample_remarks' => $this->sealed_sample_remarks,
            'nwr' => $this->nwr,
            'nwr_remarks' => $this->nwr_remarks,
            'stock_percent' => $this->stock_percent,
            'nwr_count' => $this->nwr_count,
            'process_nwr' => $this->process_nwr,
            'awareness' => $this->awareness,
            'bank' => $this->bank,
            'latitude' => strip_tags($this->latitude),
            'longitude' => strip_tags($this->longitude),
            'warehouse_age' => $this->warehouse_age,
            'warehouse_condition' => $this->warehouse_condition,
            'bank_data' => $bank_data,
            'commodity_data' => $commodities_data,

            /* to view details */

            'age' => isset($this->getWarehouseAge->title)?strip_tags($this->getWarehouseAge->title):null,
            'condition' => isset($this->getWarehouseCondition->title)?strip_tags($this->getWarehouseCondition->title):null,

        ];
    }
}


