<?php

namespace App\Http\Resources\Api;
use App\Http\Resources\Api\Masters\HaatMasterResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserHaatResource extends JsonResource
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
            'id'                 => $this->id,
            'user_id'                 => $this->user_id,
            'haat_bazaar_id'                 => $this->haat_bazaar_id,
            'haat_bazaar_detail'                 => HaatMasterResource::make($this->getHaatMasterDetail),
            'created_by'                 => $this->created_by,
            'updated_by'                 => $this->updated_by,
            
        ];
    }
}
