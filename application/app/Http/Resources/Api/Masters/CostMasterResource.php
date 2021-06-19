<?php

namespace App\Http\Resources\Api\Masters;

use Illuminate\Http\Resources\Json\JsonResource;

class CostMasterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $state = $this->getState;
        return [
            'state' => $this->state_id,
            'state_name' => strip_tags($state->title),
            'trainers_cost' => strip_tags($this->trainers_cost),
            'trainers_days' => strip_tags($this->trainers_days),
            'lodging' => strip_tags($this->lodging),
            'arrangement' => strip_tags($this->arrangement),
            'wage_cost' => strip_tags($this->wage_cost),
            'wage_days' => strip_tags($this->wage_days),
            'food_cost' => strip_tags($this->food_cost),
            'food_days' => strip_tags($this->food_days),
            'advocacy' => strip_tags($this->advocacy),
            'raw_material_cost' => strip_tags($this->raw_material_cost),
            'toolkit' => strip_tags($this->toolkit),
            'labels' => $this->_getLabels(),
            'others' => $this->getOtherCosts()->select(['meta_name', 'meta_value'])->get(),
        ];
    }

    private function _getLabels()
    {

        return $this->getLabels->mapWithKeys(function ($v) {
            return [
                $v->meta_name => $v->meta_value,
            ];
        });
    }
}
