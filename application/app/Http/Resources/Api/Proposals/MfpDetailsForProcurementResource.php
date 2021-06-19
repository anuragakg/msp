<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;

class MfpDetailsForProcurementResource extends JsonResource
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
            'mfp'=> $this->mfp,
            'year'=>$this->year,
            'procurement_qty'=>$this->procurement_qty,
            'procurement_value'=>$this->procurement_value,
            'disposal_qty'=>$this->disposal_qty,
            'disposal_value'=>$this->disposal_value,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }
}
