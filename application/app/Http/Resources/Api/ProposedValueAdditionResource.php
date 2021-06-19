<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProposedValueAdditionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $groups_data = array();
        $shg_members = array();
        $training_arr = array();
        $mfp_data = $this->getMfpData;
        $shg_data = $this->getShgData;
        $training_data = $this->getTrainingData;
        /*Create array with keys of proposed_mfp*/
        foreach ($shg_data->toArray() as $key => $arr) {
            $proposed_value = $arr['proposed_value'];
            $groups_data[$arr['proposed_value']][] = $arr;
        }
        /*Create training array*/
        if (!empty($training_data)) {
            foreach ($training_data as $key => $training) {
                $training_arr[$training->value_edition_id] = $training;
            }
        }
        //=======================
        /*Create array of every mfp with group data*/
        foreach ($mfp_data->toArray() as $key => $arr) {
            $value_edition_id = $arr['id'];
            $shg_members[] = array(
                'mfp_name' => $arr['mfp_id'],
                'shg_groups' => $groups_data[$arr['id']],
                'gatherers_no' => $arr['gatherers_no'],
                'produce_name' => $arr['produce_name'],
                'market_price' => $arr['market_price'],
                'unit' => $arr['unit'],
                'training' => $arr['training'],
                'master_trainers' => $arr['master_trainers'],
                'training_details' => isset($training_arr[$value_edition_id]) ? $training_arr[$value_edition_id] : array(),
            );
        }


        return [
            'id' => $this->id,
            'shg_members' => $shg_members,
        ];
    }
}
