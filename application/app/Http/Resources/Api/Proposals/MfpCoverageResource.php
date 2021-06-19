<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Proposals\Mfp_coverage_haat_block;
use App\Models\Proposals\Mfp_procurement_estimated_losses;
use Helper;
class MfpCoverageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request,$id=null)
    {   
        $mfpMasterData=$this->getMfpData;
        $MfpName=isset($mfpMasterData->getMfpName)?$mfpMasterData->getMfpName:null;
        //$year_id = $this->getYearId->;
        $current_year_id = $this->getYearId->year_id;
        $created_by = $this->getYearId->created_by;
        if($this->previous_year_estimated_qty)
        {
            $previous_year_estimated_qty=$this->previous_year_estimated_qty??0;
            $previous_year_estimated_value=$this->previous_year_estimated_value??0;
        }else{
            $previous_year_data=$this->getPreviousYearQty($current_year_id,$created_by,$this->mfp_id);            
            
            $previous_year_estimated_qty= $previous_year_data['qty']??0;
            $previous_year_estimated_value= $previous_year_data['value']??0;
        }
        return [
            'id' => $this->id,
            'year_id' => $current_year_id,
            
            'mfp_procurement_id'=>$this->mfp_procurement_id,
            'mfp_id' => $this->mfp_id,
            'getMfpData' => $MfpName,
            'district_id' => $this->district_id,
            'district_name' => isset($this->getDistrict->title)?$this->getDistrict->title:'',
            'block_haat_data'=>mfp_coverage_haat_block::collection($this->get_block_haat),

            'previous_year_estimated_qty'=>Helper::decimalNumberFormat($previous_year_estimated_qty),
            'previous_year_estimated_value'=>Helper::decimalNumberFormat($previous_year_estimated_value),
            
            'previous_year_actual_qty'=>Helper::decimalNumberFormat($this->previous_year_actual_qty),
            'previous_year_actual_value'=>Helper::decimalNumberFormat($this->previous_year_actual_estimated_qty),
            
            'current_year_estimated_qty'=>Helper::decimalNumberFormat($this->current_year_estimated_qty),
            'current_year_estimated_value'=>Helper::decimalNumberFormat($this->current_year_estimated_value),
        ];
    }

    public function getPreviousYearQty($current_year_id,$created_by,$mfp_id)
    {
        $coverage_data=array();
        if($mfp_id)
        {
            $previous_year_id=$current_year_id-1;
            $coverage_data=Mfp_procurement_estimated_losses::join('mfp_procurement', function($join) {
                  $join->on('mfp_procurement_estimated_losses_history.mfp_procurement_id', '=', 'mfp_procurement.id');
                })
            ->where(['mfp_procurement_estimated_losses_history.mfp_id'=>$mfp_id,'mfp_procurement_estimated_losses_history.year_id'=>$previous_year_id,'mfp_procurement_estimated_losses_history.created_by'=>$created_by])
            ->where('mfp_procurement.submission_status',1)
            ->orderBy('mfp_procurement_estimated_losses_history.created_at','desc')
            ->first();    
        }
        return $coverage_data;
    }
}
