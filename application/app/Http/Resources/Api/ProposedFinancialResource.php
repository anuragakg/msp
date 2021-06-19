<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProposedFinancialResource extends JsonResource
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
            'cashflow' => basename($this->cashflow),
            'cashflow_url' => url($this->cashflow),
            'p_and_l' => basename($this->p_and_l),
            'p_and_l_url' => url($this->p_and_l),
            'balance_sheet' => basename($this->balance_sheet),
            'balance_sheet_url' => url($this->balance_sheet),
            
        ];
    }
}
