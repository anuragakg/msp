<?php

namespace App\Http\Resources\Api\Masters;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class MfpResource extends JsonResource
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
            'state_id' => $this->state_id,
            'state'=>$this->getState->title,       
            'mfp_id'=>$this->mfp_id,       
            'mfp_name'=>isset($this->getMfpName->title)?$this->getMfpName->title:'',       
            'botanical_name'=>$this->botanical_name,
            'local_name'=>$this->local_name,
            'msp_price'=>$this->msp_price,
            'image'=>!empty($this->image)?url(Storage::url($this->image)):null,
            'status' => $this->status,
            'created_at'=>date('d-M-y H:m',strtotime($this->created_at)),
            'submission_date'=>date('d/m/Y H:m',strtotime($this->created_at)),
            'detail_api_path'=>url('/api/v1/masters/mfp/'.$this->id),
        ];
    }
}
