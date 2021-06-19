<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\Masters\CostMasterResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProposedFundsRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $commodity_data=$this->getCommodity;
        $commodity_data=!empty($commodity_data)?$commodity_data->toArray():array();
        return [
            'id' => $this->id,
            'vdvk_id' => $this->vdvk_id,
            'shg_id' => $this->shg_id,
            // 'shg_name' => isset($commodity_data['title'])? strip_tags($commodity_data['title']) :'',
            'shg_name' => optional($this->getShgGroup)->title,
            'cost_master' => $this->cost_master,
            'CostMasterData' => CostMasterResource::make($this->getCostMaster),
            'trainers_count' => $this->trainers_count,
            'trainees_count' => $this->trainees_count,
            'trainers_cost' => $this->trainers_cost,
            'lodging' => $this->lodging,
            'arrangement' => $this->arrangement,
            'wage_compensation' => $this->wage_compensation,
            'refreshment_expenses' => $this->refreshment_expenses,
            'advocacy_expenses' => $this->advocacy_expenses,
            'raw_materials_cost' => $this->raw_materials_cost,  
            'total_training_cost' => $this->total_training_cost,
            'total_batch_cost' => $this->total_batch_cost,
            'tool_kit' => $this->tool_kit,
            'working_capital' => $this->working_capital,
            'others' => fundsRequestOtherCost::collection($this->getFundsRequestOtherCost),             
            'additional' => $this->getAdditionalCosts
        ];
    }
}

class fundsRequestOtherCost extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'meta_name' => $this->meta_name,
            'meta_value' => $this->meta_value,
        ];
    }
}