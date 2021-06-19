<?php

namespace App\Http\Resources\Api\ReleaseFund;

use Illuminate\Http\Resources\Json\JsonResource;

class ReceivedFundListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
       
        $summary = $this->Summary;

        $total_fund_require = isset($summary->total_fund_require)?$summary->total_fund_require:0;
       // print($this->getActualDetails);
        return [
            'id' => $this->id,
            'ref_id' => $this->ref_id,
            'year_id' => $this->year_id,
            'proposal_id' => $this->proposal_id,
            'status' => $this->status,
            'released_amount' => $this->released_amount,
            'total_fund_require' => $total_fund_require,
            'commission_amount'=>$this->getActualDetails->sum('commission_amount'),
            'release_acutal_fund' => $this->totalAcutalFund($this->getActualDetails)
            
        ];
    }

    public function totalAcutalFund($data)
    { $total=0;
        foreach ($data as  $row) {
           $total +=$row['release_acutal_fund'];
        }
        return $total;
    }
}
