<?php

namespace App\Http\Resources\Api\Actualdetail;

use Illuminate\Http\Resources\Json\JsonResource;

class MfpStorageDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   $MfpName= $this->getMfp->getMfpName['title'];
        
        return [
            'id' => $this->id,
            'ref_id' => $this->ref_id,
            'year_id' => $this->year_id,
            'mfp_id' => $this->mfp_id,
            'mfp_name' => $MfpName,
            'mfp_qty' => $this->mfp_qty,
            'other_mfp_actual' => MfpStorageOtherDetailsResource::collection($this->getActualMfpOther),
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }
}
