<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\Masters\ViewOne\BlockResource;
use App\Http\Resources\Api\Masters\ViewOne\DistrictResource;
use App\Http\Resources\Api\Masters\ViewOne\StateResource;
use App\Http\Resources\Api\Masters\ViewOne\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SurveyorMasterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $userDetails = $this->getUserDetails;

        $state = StateResource::make($userDetails->getState);
        $district = DistrictResource::make($userDetails->getDistrict);
        $block = BlockResource::make($userDetails->getBlock);
         $mapSurveyor = null;
        if ($this->role == 12) {
            $mapSurveyor = UserResource::collection($this->getChildUsers); //Super
        }
          if ($this->role == 11) {
              $mapSurveyor = UserResource::collection($this->getParentUsers); //sur
        }
     

        return [
            'id' => $this->id,
            'name' => strip_tags($this->name),
            'mobile' => $this->mobile_no,
            'email' => strip_tags($this->email),
            'state' => $state,
            'district' => $district,
            'block' => $block,
            'user_type' => strip_tags($this->getRole->title),
            'status' => $this->status,
            'map_surveyor' => $mapSurveyor

        ];
    }
}
