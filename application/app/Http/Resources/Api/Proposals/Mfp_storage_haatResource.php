<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;
class Mfp_storage_haatResource extends JsonResource
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
            'mfp_storage_id'=>$this->mfp_storage_id,
            'mfp_procurement_id' => $this->mfp_procurement_id,
            'haat' => $this->haat,
            'haat_item' => $this->getMFPHaat              
        ];
    }
}
