<?php

namespace App\Http\Resources\Api\Masters;

use App\Models\Masters\Block;
use Illuminate\Http\Resources\Json\JsonResource;

class HaatBlockResource extends JsonResource
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
            'haat_detail_id'=>$this->haat_detail_id,
            'block_id'=>$this->block_id,
            'block_name'=>isset($this->getBlocks->title)?$this->getBlocks->title:'',
        ];
        //return  HaatBlockNameResource::collection(Block::where('id', $this->block_id)->get()); 
    }
}
