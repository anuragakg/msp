<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;

class ProposalMfpStatusLogResource extends JsonResource
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
            'year_id' => $this->year_id,
            'status' => $this->status,
            
            'verification_logs'=>StatusLogResource::collection($this->getProposedStatusLogs)
        ];
    }
}
