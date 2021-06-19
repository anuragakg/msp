<?php

namespace App\Http\Resources\Api\Shg;


use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Proposed\Vdvk;
use App\Http\Resources\Api\Masters\CommonMasterResource;

class ShgGroupResource extends JsonResource
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
            'bank_ac_no' => strip_tags($this->bank_ac_no),
            'ifsc_code' => strip_tags($this->ifsc_code),
            'total_corpus' => strip_tags($this->total_corpus),
            'coordinating_agency' => CommonMasterResource::make($this->getCoordinatingAgency),
            'st_members' => $this->st_members,
            'corpus_to_invest' => strip_tags($this->corpus_to_invest),
            'contact_person' => strip_tags($this->contact_person),
            'contact_person_mobile' => strip_tags($this->contact_person_mobile),
            'is_ajeevika' => $this->is_ajeevika,
            'ajeevika_value' => $this->ajeevika_value ? strip_tags($this->ajeevika_value) : '',
            'shg_group_no' => strip_tags($this->shg_group_no),
            'shgGatherers'  => $this->getShgGatherers,
            'vdvks' => $this->getVdvkNames(),
            'pproposed_status' =>$this->getProposedStatus(),
            'st_member' => $this->getStMember,
            'state' => $this->state,
            'district' => $this->district,
            'block' => $this->block,
        ];
    }

    private function getVdvkNames()
    {
        $proposedShg = $this->getProposedShg()->has('getProposedLocation')->get();
        return $proposedShg->map(function ($v) {
            return $v->getProposedLocation->kendra_name;
        })->unique()->implode(', ');
    }

    private function getProposedStatus()
    {
        $proposedShg = $this->getProposedShg()->has('getProposedLocation')->get();
        return $proposedShg->map(function ($v) {
            $t=Vdvk::where('id',$v->getProposedLocation->vdvk_id)->where('submission_status',1)->select('id','submission_status','status')->first();             
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
            return $id;
        })->unique()->implode(', ');
    }
}
