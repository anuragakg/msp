<?php

namespace App\Http\Resources\Api\Infrastructures;

use Illuminate\Http\Resources\Json\JsonResource;

class TransactionStatusLogResource extends JsonResource
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
            'ref_id' => $this->ref_id,
            'status' => $this->status,            
            'verification_logs'=>TxnStatusLogResource::collection($this->getLogs)
        ];
    }
}
