<?php

namespace App\Http\Resources\Api\Shg;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use PhpParser\Builder\Class_;

class ShgViewOneResource extends JsonResource
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
        $financial = $this->getFinancialYear; 
        $bankDetails = optional($this->getBankDetails);
        if($this->dob == null){
            $dob = '';
        }else{
            $dob = Carbon::parse($this->dob)->format('d/m/Y');
        }
        $msp_url=env('VDVK_APP_URL').'public';
        if($this->submitted_from)//msp
        {
            $tribal_image = $this->tribal_image ? url(Storage::url($this->tribal_image)) : null;
        }else{
            $tribal_image = $this->tribal_image ? $msp_url.Storage::url($this->tribal_image) : null;
        }
        return [
            'id' => $this->id,
            'name_of_tribal' => trim($this->name_of_tribal),
            'gender' => $this->gender,
            'name_of_proposed' => $this->name_of_proposed,
            'financial_year' => $this->financial_year,
            'financial_name' => isset($financial->title) ? strip_tags($financial->title) : null,
            'dob' => $dob,
            'birth_year' => $this->birth_year,
            'age' => $this->age,
            'id_type' => (int) $this->id_type,
            'id_value' => strip_tags($this->id_value),
            'father' => strip_tags($this->father),
            'mother' => strip_tags($this->mother),
            'address' => strip_tags($this->address),
            'state_name' => isset($state->title) ? strip_tags($state->title) : null,
            'state' => $this->state,
            'district_name' => isset($district->title) ? strip_tags($district->title) : null,
            'district' => $this->district,
            'block_name' => isset($block->title) ? strip_tags($block->title) : null,
            'block' => $this->block,
            'village_name' => isset($village->title) ? strip_tags($village->title) : null,
            'village' => $this->village,
            'pin_code' => $this->pin_code,
            'gram_panchayat' => strip_tags($this->gram_panchayat),
            'occupation' => $this->occupation,
            'occupation_name' => $this->getOccupation->title,
            'education' => $this->education,
            'education_name' =>  $this->getEducation->title,
            'existing_membership' => (int) $this->existing_membership,
            'shg_name' => $this->shg_name,
            'shg_nrlm_id' => $this->shg_nrlm_id,
            'shg_other_id' => $this->shg_other_id,
            'is_office_bearer' => (int) $this->is_office_bearer,
            'bearer_role' => $this->bearer_role,
            'category' => $this->category,
            'is_ews' => (int) $this->is_ews,
            'st_name' => $this->st_name,
            'is_gathering_mfp' => (int)$this->is_gathering_mfp,
            'no_of_members' => $this->no_of_members,
            'is_married' => null,
            'vehicle_type' => $this->vehicle_type,

            'bank_name' => isset($bankDetails->name) ? strip_tags($bankDetails->name) : null,
            'branch_name' => isset($bankDetails->branch) ? strip_tags($bankDetails->branch) : null,
            'bank_ifsc' => isset($bankDetails->ifsc_code) ? strip_tags($bankDetails->ifsc_code) : null,
            'bank_account_no' => isset($bankDetails->account_no) ? strip_tags($bankDetails->account_no) : null,
            'bank_mobile_no' =>  $bankDetails->mobile_no ?? null,
            'landline_no' =>  $bankDetails->landline_no ?? null,
            'is_self' => (int) ($bankDetails->is_self ?? null),
            'specify_other' => isset($bankDetails->specify_other) ? strip_tags($bankDetails->specify_other) : null,
            'phone_type' => $bankDetails->phone_type ?? null,

            'image' => $this->image ? url(Storage::url($this->image)) : null,
            'tribal_image' => $tribal_image,


            /// to view shd-gatherer details///
            //'bearer_title' => $this->getOfficeBearer->title ?? '-',
            'latitude' => isset($this->latitude) ? strip_tags($this->latitude) : null,
            'longitude' => isset($this->longitude) ? strip_tags($this->longitude) : null,
            'id_proof' => strip_tags($this->getID->title) ?? '-',
            'year_birth' => optional($this->getYear)->title ?? '-',
            'education_data' => strip_tags(optional($this->getEducation)->title) ?? '-',
            'occupation_data' => strip_tags(optional($this->getOccupation)->title) ?? '-',
            'category_data' => strip_tags(optional($this->getCategory)->title) ?? '-',
            'vehicle_data' => strip_tags(optional($this->getVehical)->title) ?? '-',
            'phone_data' => strip_tags(optional($bankDetails->getPhone)->title) ?? '-',
            'no_houseHold' => $this->getHouseHoldMembers->count() ?? '-',
            'houseHold' => getHouseHoldDetailResource::collection($this->getHouseHoldMembers),
            'yearlyUsage' => ShgYearlyUsageResource::collection($this->getMfpYearlyGatherings),
            'st_title' => strip_tags(optional($this->getScheduleCast)->title) ?? null,
        ];
    }
}


class getHouseHoldDetailResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'gender' => $this->gender == 'M' ? 'Male' : ($this->gender == 'F' ? 'Female' : 'Other'),
            'dob' =>  Carbon::parse($this->dob)->format('d/m/Y'),
            'age' => $this->age,
            'education' => $this->getEducation->title ?? '-',
            'occupation_data' => $this->getOccupation->title ?? '-',
            'relation' => $this->getMemberRelation->title ?? '-',
            'is_mfp' => $this->is_gathering_mfp == 1 ? 'Yes' : 'No',
        ];
    }
}
