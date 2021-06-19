<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProposedShgResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
         $group=$this->getShgGroup;
         $CoordinatingAgency=$this->getCoordinatingAgency;
         //$st_no=$group->getStMember->count();
		 if(isset($group->getStMember) && !empty($group->getStMember))
		 {
			 $st_no=$group->getStMember->count();
		 }else{
			 $st_no=0;
		 }
         if(isset($group->getShgGatherers) && !empty($group->getShgGatherers))
		 {
			$beneficiaries=$group->getShgGatherers->count();	
		 }else{
			 $beneficiaries=0;
		 }
         //dd($beneficiaries);
        /** Get the Proposed Shgs*/
        return [
                    'shg_id' => $this->shg_id,
                    'shg_group_id' => $group['id'],
                    'shg_group_name' => strip_tags($group['title']),
                    'total_corpus' => $this->total_corpus,
                    'coordinating_agency_type' => $this->coordinating_agency_type,
                    'coordinating_agency_name' => strip_tags($CoordinatingAgency['title']),
                    'st_no' => $st_no,//$this->st_no,
                    'corpus_agreed' => $this->corpus_agreed,
                    'contact_name' => strip_tags($this->contact_name),
                    'contact_details' => strip_tags($this->contact_details),
                    'status' => $this->status,
                    'beneficiaries'=>$beneficiaries
        ];
    }
}



