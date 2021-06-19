<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;
class Mfp_coverage_haat_block extends JsonResource
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
            'mfp_procurement_id'=>$this->mfp_procurement_id,
            'mfp_coverage_id' => $this->mfp_coverage_id,
            'haat_id' => $this->haat_id,
            'haat_data' => $this->getHaat,
            'block_id' => $this->block_id,
            'block_name' => isset($this->getBlock->title)?$this->getBlock->title:null,
            
        ];
    }
}
