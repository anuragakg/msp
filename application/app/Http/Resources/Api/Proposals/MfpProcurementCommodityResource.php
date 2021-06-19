<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource; 
use App\Http\Resources\Api\Proposals\Mfp_coverage_haat_block;
use Helper;
class MfpProcurementCommodityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {    
        $mfpMasterData=$this->getMfpData;
        $MfpName=isset($mfpMasterData->getMfpName)?$mfpMasterData->getMfpName:null;
        
        return [
            'id' => $this->id,
            'form_id' => $this->mfp_procurement_id,
            'commodity_id' => $this->commodity_id,
            'haat' => $this->haat,
            'haat_data'=>$this->getHaat,
            'block_data'=>$this->getBlock,
            'getMfpData' => $MfpName,            
            'block_haat_data'=>mfp_coverage_haat_block::collection($this->get_block_haat),
            'blocks'=>$this->blocks,
            'lastqty'=>$this->lastqty?Helper::decimalNumberFormat($this->lastqty):0,
            'lastval'=>$this->lastval?Helper::decimalNumberFormat($this->lastval):0,
            'currentqty'=>Helper::decimalNumberFormat($this->currentqty),
            'currentval'=>Helper::decimalNumberFormat($this->currentval), 
            'is_draft' => $this->is_draft,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ];
    }
}
