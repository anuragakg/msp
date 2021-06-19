<?php

namespace App\Http\Resources\Api;
use App\Models\Shg\ShgGroup;
use Illuminate\Http\Resources\Json\JsonResource;

class ProposedValueAdditionResourceNew extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $mfp_data=$this->getMfpName;
       
        $shg_groups_data=$this->getValueShgGroupData;
        $groups_name=array();
        if(!empty($shg_groups_data))
        {
            foreach ($shg_groups_data->toArray() as $key => $group){
                
                $groups_name[]= $group['shg_group_name'];
                
            }
        }
        
        return [
            "mfp_name" => $this->mfp_id,
            "mfp_id_title" => ($mfp_data) ? strip_tags($mfp_data['title']) : '',
            "shg_group" => $this->shg_group,
            "gatherers_no" => $this->gatherers_no,
            //"produce_name" => strip_tags($this->produce_name),
            //"market_price" => strip_tags($this->market_price),
            //"unit" => $this->unit,
            "products_data"=>$this->getValueAdditionProducts,
            "training" => $this->training,
            "master_trainers" => $this->master_trainers,
            "training_details" => ValueAdditionTrainingData::make($this->getTrainingData),
            "shg_groups" => $this->getValueShgGroupData,
            "shg_groups_name" => !empty($groups_name)?implode(',', $groups_name):'',
            "trainers" => ValueAdditionTrainers::collection($this->getTrainers),
        ];
    }
}


class ValueAdditionTrainingData extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
		$states=$this->getState;
		$states_data=!empty($states)?$states->toArray():array();
		
		$districts=$this->getDistrict;
		$districts_data=!empty($districts)?$districts->toArray():array();
		
		$blocks=$this->getBlock;
		$blocks_data=!empty($blocks)?$blocks->toArray():array();
		
		$mfp_data=$this->getMfpName;
		$mfp_data=!empty($mfp_data)?$mfp_data->toArray():array();
		
		$trainingStatus=$this->getTrainingStatus;
		$trainingStatus=!empty($trainingStatus)?$trainingStatus->toArray():array();

		//echo 'a<pre>';print_r($states->toArray());die;
        return [
            "title" => strip_tags($this->title),
            "duration" => $this->duration,
            "mfp_id" => $this->mfp_id,
            "mfp_id_name" => isset($mfp_data['title'])? strip_tags($mfp_data['title']) :'',
            "start_date" => $this->start_date,
            "end_date" => $this->end_date,
            "description" => strip_tags($this->description),
            "state" => $this->state,
            "state_name" => isset($states_data['title'])? strip_tags($states_data['title']) :'',
            "district" => $this->district,
			"district_name" => isset($districts_data['title'])? strip_tags($districts_data['title']) :'',
            "block" => $this->block,
			"block_name" => isset($blocks_data['title'])? strip_tags($blocks_data['title']) :'',
            "address" => strip_tags($this->address),
            "remarks" => strip_tags($this->remarks),
            "training_status" => $this->training_status,
            "training_status_name" => isset($trainingStatus['title'])? strip_tags($trainingStatus['title']) :'',
        ];
    }
}

class ValueAdditionTrainers extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $states=$this->getState;
        $states_data=!empty($states)?$states->toArray():array();
        
        $districts=$this->getDistrict;
        $districts_data=!empty($districts)?$districts->toArray():array();
        
        $blocks=$this->getBlock;
        $blocks_data=!empty($blocks)?$blocks->toArray():array();

        $education=$this->getEducation;
        $education_data=!empty($education)?$education->toArray():array();

        $specialisation=$this->getSpecialisation;
        $specialisation_data=!empty($specialisation)?$specialisation->toArray():array();
        return [
            "name" => strip_tags($this->name),
            "gender" => $this->gender,
            "dob" => $this->dob,
            "address" => strip_tags($this->address),
            "mobile_no" => $this->mobile_no,
            "landline_no" => strip_tags($this->landline_no),
            "state" => $this->state,
            "state_name" => isset($states_data['title'])? strip_tags($states_data['title']) :'',
            "district" => $this->district,
            "district_name" => isset($districts_data['title'])? strip_tags($districts_data['title']) :'',
            "block" => $this->block,
            "block_name" => isset($blocks_data['title'])? strip_tags($blocks_data['title']) :'',
            "education" => $this->education,
            "education_name" => isset($education_data['title'])? strip_tags($education_data['title']) :'',
            "yoe" => $this->yoe,
            "trained_from" => $this->trained_from,
            "specialisation" => $this->specialisation,
            "specialisation_name" => isset($specialisation_data['title'])? strip_tags($specialisation_data['title']) :'',
        ];
    }
}
