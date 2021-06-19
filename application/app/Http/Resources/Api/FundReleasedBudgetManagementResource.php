<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class FundReleasedBudgetManagementResource extends JsonResource
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
            'id' => $this->id,
            'budget_id' => $this->budget_id,
            'description' => strip_tags($this->description),
            'fund_released_date' => $this->fund_released_date,
            'fund_released_amount' => strip_tags($this->fund_released_amount),
        ];
    }
}

/**
 * 
 */
class AvailableFund extends JsonResource
{
    
    public function toArray($request)
    {
        return [
            'fund' => $this->fund_released_amount,
        ];
    }
}