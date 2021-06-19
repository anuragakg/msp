<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class TrainingDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $shg_members = array();
        $training_data = $this->getTrainingData;
        foreach ($training_data->toArray() as $key => $var) {
            $shg_members[] = array(
                'vdvk_id' => $var['vdvk_id'],
                'mfp_id' => $var['mfp_id'],
                'title' => strip_tags($var['title']),
                'duration' => $var['duration'],
                'start_date' => $var['start_date'],
                'end_date' => $var['end_date'],
                'description' => strip_tags($var['description']),
                'state' => $var['state'],
                'district' => $var['district'],
                'block' => $var['block'],
                'address' => strip_tags($var['address']),
                'remarks' => strip_tags($var['remarks']),
                'training_status' => $var['training_status']
            );
        }


        return [
            'id' => $this->id,
            'shg_members' => $shg_members,
        ];
    }
}
