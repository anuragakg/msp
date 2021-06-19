<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class VdvkMonthlyMfpResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"    => $this->id,
            'vdvk_id'   => $this->vdvk_id,
            "year" => $this->year,
            "year_title" => strip_tags($this->getYearData->title),
            "month" => $this->month,
            "commodity" => $this->commodity,
            "collection_unit" => $this->collection_unit,
            "collection_quantity" => $this->collection_quantity,
            "processed_unit" => $this->processed_unit,
            "processed_unit_id" => $this->processed_unit_id,
            "processed_unit_type" => strip_tags($this->getProcessedUnitData->title),
            "processed_quantity" => $this->processed_quantity,
            "sold_unit" => $this->sold_unit,
            "sold_quantity" => $this->sold_quantity,
            "balance_coll_value" => $this->balance_coll_value,
            "balance_prod_value" => $this->balance_prod_value,
            "estimate_coll_value" => $this->estimate_coll_value,
            "estimate_prod_value" => $this->estimate_prod_value,
            'commodity_id' => $this->getCommodityData->id,
            'title' => strip_tags($this->getCommodityData->title),
        ];
    }
}
