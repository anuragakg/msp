<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;


class HaatMarketThreeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {     

        if($this->bank_branch_name){
            $bank_branch_name_title=$this->getBankDetail;
            $bank_branch_name_title=$bank_branch_name_title['title'];
        }else{
            $bank_branch_name_title=null;
        }
        return [
            'id' => $this->id,
            'office' => (int)$this->office,
            'drinking_water' => (int)$this->drinking_water,
            'notice_board' => (int)$this->notice_board,
            'urinal_toilet' => (int)$this->urinal_toilet,
            'electricity' => (int)$this->electricity,
            'garbage_system' => (int)$this->garbage_system,
            'parking' => (int)$this->parking,
            'input_sundry' => (int)$this->input_sundry,
            'hygienic' => (int)$this->hygienic,
            'bank' => (int)$this->bank,
            'bank_name' => $this->bank_name,
            'bank_branch_name' => $this->bank_branch_name,
            'bank_branch_name_title' => $bank_branch_name_title,
            'other_bank' => $this->other_bank,
            'post_office' => (int)$this->post_office,
            'post_office_name' => strip_tags($this->post_office_name),
            'assaying_lab' => (int)$this->assaying_lab,
            'assaying_lab_remarks' => strip_tags($this->assaying_lab_remarks),
            'packaging' => (int)$this->packaging,
            'packaging_remarks' => strip_tags($this->packaging_remarks),
            'drying_yards' => (int)$this->drying_yards,
            'drying_yards_remarks' => strip_tags($this->drying_yards_remarks),
            'bagging' => (int)$this->bagging,
            'bagging_remarks' => strip_tags($this->bagging_remarks),
            'loading' => (int)$this->loading,
            'loading_remarks' => strip_tags($this->loading_remarks),
            'conditioning' => (int)$this->conditioning,
            'conditioning_remarks' => strip_tags($this->conditioning_remarks),
            'pack_house' => (int)$this->pack_house,
            'pack_house_remarks' => strip_tags($this->pack_house_remarks),
            'storage_capacity' => (int)$this->storage_capacity,
            'storage_capacity_remarks' => strip_tags($this->storage_capacity_remarks),
            'standardisation' => (int)$this->standardisation,
            'standardisation_remarks' => strip_tags($this->standardisation_remarks),
            'primary_processing' => (int)$this->primary_processing,
            'primary_processing_remarks' => strip_tags($this->primary_processing_remarks),
            'info_display' => (int)$this->info_display,
            'info_display_remarks' => strip_tags($this->info_display_remarks),
            'it_infra' => (int)$this->it_infra,
            'it_infra_remarks' => strip_tags($this->it_infra_remarks),
            'storage' => (int)$this->storage,
            'storage_remarks' => strip_tags($this->storage_remarks),
            'public_address' => (int)$this->public_address,
            'public_address_remarks' => strip_tags($this->public_address_remarks),
            'extension' => (int)$this->extension,
            'extension_remarks' => strip_tags($this->extension_remarks),
            'boarding_lodging' => (int)$this->boarding_lodging,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,

            /* to view changes*/
            'standardisation_remarks'  => strip_tags($this->standardisation_remarks),
        ];
    }
}
