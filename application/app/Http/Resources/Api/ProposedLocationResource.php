<?php

namespace App\Http\Resources\Api;

use App\Models\Shg\ShgGatherers;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProposedLocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    { 
        $shg_ids=array();
        if(!empty($this->leader))
        {
            $shg_ids[]=$this->leader;
        }
        if(!empty($this->deputy_leader))
        {
            $shg_ids[]=$this->deputy_leader;
        }
        if(!empty($this->accounts_shg_id))
        {
            $shg_ids[]=$this->accounts_shg_id;
        }
        if(!empty($this->procurement_shg_id))
        {
            $shg_ids[]=$this->procurement_shg_id;
        }
         if(!empty($this->training_shg_id))
        {
            $shg_ids[]=$this->training_shg_id;
        }
          if(!empty($this->value_addition_shg_id))
        {
            $shg_ids[]=$this->value_addition_shg_id;
        }
          if(!empty($this->marketing_shg_id))
        {
            $shg_ids[]=$this->marketing_shg_id;
        }
          if(!empty($this->it_shg_id))
        {
            $shg_ids[]=$this->it_shg_id;
        }//print_r($shg_ids);die;
        if(!empty($shg_ids)){
            $shg_groups = ShgGatherers::whereIn('id',$shg_ids)->get();
        }
        
        $shg_group_arr = array();
        if(isset($shg_groups) && !empty($shg_groups))
        {
            foreach ($shg_groups as $key => $row) {
                $shg_group_arr[$row->id]=$row->name_of_tribal;
            }
        }

        $shgGroup = $this->getShgGroup;
        $deputyShgGroup = $this->getDeputyShgGroup;

        $state_data = $this->getState;
        $district_data = $this->getDistrict;
        $block_data = $this->getBlock;
        
        $vdvk = $this->getVdvk;

        return [
            'id' => $this->id,
            'vdvk_id' => $this->vdvk_id,
            'kendra_name' => strip_tags($this->kendra_name),
            'permanent_address' =>isset($this->permanent_address) ? strip_tags($this->permanent_address) : null,
            'temporary_address' => strip_tags($this->temporary_address),
            'pin_code' => $this->pin_code,
            'state' => $this->state,
            'district' => $this->district,
            'block' => $this->block,
            'village' => $this->village,
            'actual_date' => $vdvk->actual_date,
            'shg_group' => $this->shg_group,
            'shg_group_name' =>isset($shgGroup->title) ? strip_tags($shgGroup->title) : null,
            'leader' => $this->leader,
            'leader_mobile' => strip_tags($this->leader_mobile),
            'leader_email' => strip_tags($this->leader_email),
            'shg_group_deputy' => $this->shg_group_deputy,
            'deputy_leader' => $this->deputy_leader,
            'deputy_shg_group_name' =>isset($deputyShgGroup->title) ? strip_tags($deputyShgGroup->title) : null,
            'deputy_leader_mobile' => strip_tags($this->deputy_leader_mobile),
            'deputy_leader_email' => strip_tags($this->deputy_leader_email),
            'accounts' => strip_tags($this->accounts),
            'accounts_shg_id' => $this->accounts_shg_id,
            'procurement' => strip_tags($this->procurement),
            'procurement_shg_id' => $this->procurement_shg_id,
            'training' => strip_tags($this->training),
            'training_shg_id' => $this->training_shg_id,
            'value_addition' => strip_tags($this->value_addition),
            'value_addition_shg_id' => $this->value_addition_shg_id,
            'marketing' => strip_tags($this->marketing),
            'marketing_shg_id' => $this->marketing_shg_id,
            'it' => strip_tags($this->it),
            'it_shg_id' => $this->it_shg_id,
            'bank_name' => strip_tags($this->bank_name),
            'bank_account_no' => strip_tags($this->bank_account_no),
            'ifsc_code' => strip_tags($this->ifsc_code),
            'additional_info' => strip_tags($this->additional_info),
            'passbook' => $this->passbook ? url(Storage::url($this->passbook)) : null,
            'passbook_updated' => $this->passbook,
            'status' => $this->status,

            'state_name' => strip_tags($state_data->title),
            'district_name' => strip_tags($district_data->title),
            'block_name' => strip_tags($block_data->title),
            'village_name' => isset($this->getVillage->title) ? strip_tags($this->getVillage->title) : null,
            'leader_name' => isset($shg_group_arr[$this->leader])?$shg_group_arr[$this->leader]:'',
            'deputy_leader_name' => isset($shg_group_arr[$this->deputy_leader])?$shg_group_arr[$this->deputy_leader]:'',
            'accounts_shg_name' => isset($shg_group_arr[$this->accounts_shg_id])?$shg_group_arr[$this->accounts_shg_id]:'',
            'procurement_shg_name' => isset($shg_group_arr[$this->procurement_shg_id])?$shg_group_arr[$this->procurement_shg_id]:'',
            'training_shg_name' => isset($shg_group_arr[$this->training_shg_id])?$shg_group_arr[$this->training_shg_id]:'',
            'value_addition_shg_name' => isset($shg_group_arr[$this->value_addition_shg_id])?$shg_group_arr[$this->value_addition_shg_id]:'',
            'marketing_shg_name' => isset($shg_group_arr[$this->marketing_shg_id])?$shg_group_arr[$this->marketing_shg_id]:'',
            'it_shg_name' => isset($shg_group_arr[$this->it_shg_id])?$shg_group_arr[$this->it_shg_id]:'',
           // 'it_shg_name' => isset($shg_group_arr[$this->it_shg_id])?$shg_group_arr[$this->it_shg_id]:'',
            
            

            'year_id' => $vdvk->year_id,
            'financial_year' => $vdvk->getProposedFinancialYear,

        ];
    }
}