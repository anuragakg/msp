<?php

namespace App\Http\Resources\Api\Shg;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class ShgMembersResource extends JsonResource
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
            'name' => strip_tags($this->name),
            'gender' => $this->gender,
            'dob' => Carbon::parse($this->dob)->format('d/m/Y'),
            'age' => $this->age,
            'occupation' => $this->occupation,
            'education' => $this->education,
            'relationship_with_member' => $this->relationship_with_member,
            'is_gathering_mfp' => (int)$this->is_gathering_mfp,
        ];
    }
}
