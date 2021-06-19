<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProposedMfpResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $groups_data=array();
        $shg_members=array();
        $mfp_data=$this->getMfpData;
        $shg_data=$this->getShgData;
        /*Create array with keys of proposed_mfp*/
        foreach ($shg_data->toArray() as $key => $arr) 
        {
            $proposed_mfp=$arr['proposed_mfp'];
            $groups_data[$arr['proposed_mfp']][]=$arr;
        }
        /*Create array of every mfp with group data*/
        foreach ($mfp_data->toArray() as $key => $arr) 
        {
            $shg_members[]=array(
                'mfp_name'=>$arr['mfp_name'],
                'months'=>explode(',', $arr['months']),
                'available'=>$arr['available'],
                'plan'=>$arr['plan'],
                'shg_groups'=>$groups_data[$arr['id']],    
            );
        }
        
        
        return [
            'id' => $this->id,
            'shg_members'=>$shg_members,
        ];
    }
}
