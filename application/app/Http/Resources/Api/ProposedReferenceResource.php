<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
class ProposedReferenceResource extends JsonResource
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
            'reference_id' => $this->reference_id,
            'encoded_reference_id' => str_replace('-','_',$this->reference_id),
            'remarks' => $this->remarks,
            'account_holder' => $this->account_holder,
            'account_holder_info' => $this->getAccount_holder,
            'blank_check' => !empty($this->blank_check)?url(Storage::url($this->blank_check)):null,
            'declaration_file' => !empty($this->declaration_file)?url(Storage::url($this->declaration_file)):null,
            'ac_holder_name' => $this->ac_holder_name,
            'bank_ac_no' => $this->bank_ac_no,
            'bank_name' => $this->bank_name,
            'branch_name' => $this->branch_name,
            'ifsc_code' => $this->ifsc_code,
            'state' => $this->getState,
            'vdvk' => $this->getVdvkList,
            'no_of_minutes_of_meeting'=>$this->getMinutesOfMeeting->count(),                      
        ];
    }
}


class ProposedMfps extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $equipmentsMaster=$this->getEquipmentsMfp;
        return [
            'id' => $this->shg_id,
            'mfp_name' => isset($equipmentsMaster['title'])? strip_tags($equipmentsMaster['title']) :'',
            'equipments' => ProposedEquipmentsMfpJoin::collection($this->getEquipments)
        ];
    }
}

class ProposedEquipmentsMfpJoin extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $equipmentsMaster=$this->getEquipmentsMaster;

        return [
            'id' => $this->equipment_id,
            'equipmentsMaster' => isset($equipmentsMaster['title'])? strip_tags($equipmentsMaster['title']) :'',
            'attribute_type' => $this->attribute_type ?? '',
            'attribute_value' => $this->attribute_value ?? '',
            'attribute_width' => $this->width ?? '',
            'attribute_height' => $this->height ?? '',
            'model' => $this->model ?? '',
        ];
    }
}