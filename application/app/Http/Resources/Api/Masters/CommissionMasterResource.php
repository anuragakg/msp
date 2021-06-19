<?php

namespace App\Http\Resources\Api\Masters;


use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Masters\State;
use App\Models\Masters\Role;

class CommissionMasterResource extends JsonResource
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
            'state_id'=>$this->state,
            'state_name'=> HaatStateResource::collection(State::where('id', $this->state)->get()),
            'role_id'=> $this->role,
            'role_name' => HaatStateResource::collection(Role::where('id',$this->role)->get()),
            'commission'=>$this->commission,
            'max_aggregate_commission'=>$this->max_aggregate_commission,
            'status' => $this->status,
        ];
    }
}
