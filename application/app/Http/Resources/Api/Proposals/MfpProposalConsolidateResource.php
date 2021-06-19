<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Proposals\MfpCoverageResource;
use Illuminate\Support\Facades\Auth;

class MfpProposalConsolidateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        //if logged in user is ministry
        // if(Auth::user()->role == 3){
        //     $proposals = $this->getRecommandedMfpProcurement;
        // }else{
            $proposals = $this->getMfpProcurement;
        //}
        //$proposals = $this->getMfpProcurement;
        $mfps=0;$quantity=0;$value=0;$total_fund_require=0;
        foreach ($proposals as $key => $proposal) 
        {
            $mfps= $mfps+$proposal->getMfpCoverage->count();   
            $quantity= $quantity+$proposal->getMfpCommodity->sum('currentqty');   
            $value=$value+$proposal->getMfpCommodity->sum('currentval');   
            $total_fund_require=$total_fund_require+$proposal->getSummary->total_fund_require;   
        }
        return [
            'id' => $this->id,
            'reference_number' => $this->reference_number,
            'state' => $this->state,
            'state_name' => $this->getState->title,
            'year_id' => $this->year_id,
            'year_name' => $this->getProposedFinancialYear->title,
            'no_proposal'=>$proposals->count(),
            'proposals' => MfpProposalListingResource::collection($proposals),
            'mfps' => $mfps,
            'quantity' => $quantity,
            'value' => $value,
            'total_fund_require' => $total_fund_require,
            
        ];
    }
}
