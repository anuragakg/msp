<?php

namespace App\Http\Resources\Api\Inspection;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
/**
 * 
 * @package App\Http\Resources\Api\Inspection
 */
class InspectionVdvkResource extends JsonResource
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
            "id" => $this->id,
            "vdvk_id" => $this->vdvk_id,
            "mo_id" => $this->mo_id,
            "date_of_inspection" => Carbon::parse($this->date_of_inspection)->format('d/m/Y'),
            "recommendation" => strip_tags($this->recommendation),
            "inspection_letter" => url($this->inspection_letter),
        ];
    }
}
