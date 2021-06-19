<?php

namespace App\Http\Resources\Api\Actualdetail;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcurementTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        // $qty = 0;
        // $value = 0 ;
        // $mfp_id_count = 0;
        // $actual_details = $this->getMfpActualDetail;
        // foreach($actual_details  as $row){
        //     foreach($row['getActualDetailCommodity']  as $row1){
        //         //dd($row['getActualDetailCommodity']);
        //          $qty = $row1->sum('qty');
        //          $value = $row1->sum('value');
        //         $mfp_id_count = $row1->count('mfp_id');
                
        //     }
        // }
        
        return [
            'mfp_procurement_id'=> $this->mfp_procurement_id,
            'proposal_id' => $this->getMfpProcurement->proposal_id,
            'qty' => $this->getDiaRelease->total_quantity,
            'value' => $this->getDiaRelease->total_value,
            'mfp_id_count' => $this->getDiaRelease->total_mfp,
            'created_by' => $this->created_by,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
            'proposal_ref_id'=>$this->getMfpProcurement->ref_id,
            'is_procurement_details_submitted'=> $this->is_procurement_details_submitted,
            'is_overhead_details_submitted'=>$this->is_overhead_details_submitted,
            'transaction_id'=>$this->transaction_id,
         
        ];
    }
}
