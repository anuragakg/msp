<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;
use Helper;

class MfpCollectionLevelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request,$id=null)
    {   
        if($this->size == 'L'){
            $size = 'Large';
        }
        else if($this->size == 'M'){
            $size = 'Medium';
        }
        else if($this->size == 'S'){
            $size = 'Small';
        } else {
            $size = null;
        }
        $categoryName ='';
        if($this->category == 1){
            $categoryName = 'Category 1';
        } else if($this->category == 2){
            $categoryName = 'Category 2';
        }
        else if($this->category == 3){
            $categoryName = 'Category 3';
        } 

        return [
            'id' => $this->id,
            'mfp_procurement_id'=>$this->mfp_procurement_id,
            'mfp_id'=>isset($this->mfp_id)?$this->mfp_id:null,
            'getMfpData'=>isset($this->getMfpData->getMfpName->title)?$this->getMfpData->getMfpName->title:null,
            'qty'=>isset($this->qty)?Helper::decimalNumberFormat($this->qty):null,
            'haats'=>CollectionLevelHaatsResource::collection($this->getHaats),
            'warehouse'=>isset($this->warehouse)?$this->warehouse:null,
            'getWarehouseName'=>isset($this->getWarehouseName->getWarehouse->getPartOne->name)?$this->getWarehouseName->getWarehouse->getPartOne->name:null,
            'capacity'=>isset($this->capacity)?$this->capacity:null,
            'procurement_center'=>isset($this->procurement_center)?$this->procurement_center:null,
            'packing_material_type'=>isset($this->packing_material_type)?$this->packing_material_type:null,
            'packing_material_type_name'=>$this->getPackingMaterialDatas,
            'standard_packing'=>$this->standard_packing,
            'category'=>$this->category,
            //'category_name'=>isset($this->getCategory->title)?$this->getCategory->title:'',
            'category_name'=>$categoryName,
            'size'=>$size,
            'total_packing_bags'=>$this->total_packing_bags,
            'unit_cost'=>$this->unit_cost,
            'total_cost_of_packaging_material'=>$this->total_cost_of_packaging_material,
            
        ];
    }
}
