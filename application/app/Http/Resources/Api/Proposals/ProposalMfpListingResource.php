<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;

class ProposalMfpListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $proposal_id = $this->getProposalId->proposal_id;
      
        return [
            'id' => $this->id,
            'proposal_id'=>$proposal_id,
            'mfp_name' => $this->getMfpData->getMfpName->title,
            'qty' => $this->currentqty,
            'value' => $this->currentval
          
        ];
    }
}
