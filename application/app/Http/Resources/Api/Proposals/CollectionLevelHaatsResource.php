<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;
class CollectionLevelHaatsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request,$id=null)
    {   
        return [
            'id' => $this->id,
            'mfp_procurement_id'=>$this->mfp_procurement_id,
            'collection_level_id'=>$this->collection_level_id,
            'haat_id'=>$this->haat_id,
            'HaatName'=>isset($this->getHaat->getHaatBazaar->getPartOne->rpm_name)?$this->getHaat->getHaatBazaar->getPartOne->rpm_name:null,
            
        ];
    }

}
