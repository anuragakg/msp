<?php

namespace App\Http\Resources\Api\Masters;

use Illuminate\Http\Resources\Json\JsonResource;

class BudgetMasterResource extends JsonResource
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
            'financial_year' => $this->getFinancialYear->title,
            'amount' => strip_tags($this->amount),
            'description' => strip_tags($this->description),
            'sanction_order_date' => $this->sanction_order_date,
            'sanction_order_copy' => $this->sanction_order_copy,
            'fund_released_date' => $this->fund_released_date,
            'fund_released_amount' => strip_tags($this->fund_released_amount),
        ];
    }
}