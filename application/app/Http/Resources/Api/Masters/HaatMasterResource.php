<?php

namespace App\Http\Resources\Api\Masters;

use App\Models\Haatbazaar\HaatBazaarFormMapping;
use Illuminate\Http\Resources\Json\JsonResource;
use app\Services\Masters\StateService;
use App\Models\Masters\State;
use App\Models\Masters\District;


class HaatMasterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       $serial = 0;
        return [
            'id' => $this->id,
            'serial'=> ++$serial,
            'state_id'=> $this->state_id,
            'state_name' => HaatStateResource::collection(State::where('id', $this->state_id)->get()),
            'district_id'=>$this->district_id,
            'district_name'=>HaatDistrictResource::collection(District::where('id', $this->district_id)->get()),
            'haat_bazaar_id'=>$this->haat_bazaar_id,
            'haat_bazaar_name' => isset($this->getHaatBazaar->getPartOne->rpm_name)?$this->getHaatBazaar->getPartOne->rpm_name:'',
            'block_ids'=> HaatBlockResource::collection($this->blocks),
            //'blocks_name' => HaatBlockResource::collection($this->blocks),
            'operating_days'=>HaatOperatingDaysResource::collection($this->operating_days),
            'nature_of_operation'=>$this->nature_of_operation,
            'status' => $this->status,
        ];
    }
}
