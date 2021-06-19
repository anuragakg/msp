<?php

namespace App\Http\Resources\Api\Infrastructures;

use Illuminate\Http\Resources\Json\JsonResource;
class InfraProposalConsolidateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $proposals=$this->getInfrastructures;
        $total_fund_require=0;
        foreach ($proposals as $key => $proposal) 
        { 
            $total_fund_require=$total_fund_require+$proposal->Summary->total_fund_require;   
        }
        return [
            'id' => $this->id,
            'reference_number' => $this->reference_number,
            'state' => $this->state,
            'state_name' => $this->getState->title,
            'year_id' => $this->year_id,
            'year_name' => $this->getProposedFinancialYear->title,
            'no_proposal'=>$this->getInfrastructures->count(),            
            'total_fund_require' => $total_fund_require,
            'proposals' => InfrastructureProposalListingResource::collection($this->getInfrastructures),
            
        ];
    }
}
