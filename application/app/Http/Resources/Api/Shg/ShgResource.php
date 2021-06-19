<?php

namespace App\Http\Resources\Api\Shg;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Proposed\Vdvk;

class ShgResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $state = $this->getState;
        $district = $this->getDistrict;
        $block = $this->getBlock;
        $village = $this->getVillage;
        $surveyor_data=$this->getSurveyor; 
        return [
            'id' => $this->id,
            'name_of_tribal' => strip_tags($this->name_of_tribal),
            'name_of_proposed' => $this->name_of_proposed,
            'gender' => $this->gender,
            'category' => $this->category,
            'id_value' => $this->id_value,
            'state' => $this->state,
            'state_name' => strip_tags($state->title),
            'district' => $this->district,
            'district_name' => strip_tags($district->title),
            'block' => $this->block,
            'block_name' => strip_tags($block->title),
            'village' => $this->village,
            'village_name' => $village->title??null,
            'shg_name' => isset($this->shg_name) ? strip_tags($this->shg_name) : null,
            'group_name' => ShgGroup::collection($this->getShgGathererGroupName),
            'vdvks' => $this->getProposals(),
            'pproposed_status' =>$this->getProposedStatus(),
			'is_completed'=> $this->no_of_members === null?'0':'1',
            'surveyor'=> $surveyor_data['name']?? null
        ];
    }

    private function getProposals()
    {
        $shgGroups = $this->getShgGathererGroupName()
            ->has('getProposedShg.getProposedLocation')
            ->with('getProposedShg.getProposedLocation')
            ->get();

        $items = collect();

        foreach ($shgGroups as $group) {
            foreach ($group->getProposedShg as $proposedShg) {
                if ($proposedShg->getProposedLocation) {
                    $items->add($proposedShg->getProposedLocation->kendra_name);
                }
            }
        }

        return $items->unique()->join(', ');
    }

    private function getProposedStatus()
    {
        $shgGroups = $this->getShgGathererGroupName()
            ->has('getProposedShg.getProposedLocation')
            ->with('getProposedShg.getProposedLocation')
            ->get();
    $items = collect();

    foreach ($shgGroups as $group) {
            foreach ($group->getProposedShg as $proposedShg) {
                if ($proposedShg->getProposedLocation) {
                    //$items->add($proposedShg->getProposedLocation->vdvk_id);
                     $t=Vdvk::where('id',$proposedShg->getProposedLocation->vdvk_id)->where('submission_status',1)->select('id','submission_status','status')->first();             
                        if($t['status']==1 && $t['submission_status']==1){
                            $id=$t['id'];
                        }elseif($t['status']==0 && $t['submission_status']==1)
                        {
                            $id=$t['id'];
                        }
                        else
                        {
                            $id='';
                        }
                        $items->add($id);

                }
            }
        }
    return $items->unique()->join(', ');
    }
}

/**
 * 
 */
class ShgGroup extends JsonResource
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
            'title' => strip_tags($this->title),
        ];
    }
}
