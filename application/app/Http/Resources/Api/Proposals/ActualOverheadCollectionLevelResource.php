<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;


class ActualOverheadCollectionLevelResource extends JsonResource
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
        if($this->size == 'M'){
            $size = 'Medium';
        }
        if($this->size == 'S'){
            $size = 'Small';
        }
        return [
            'id' => $this->id,
            'mfp_procurement_id'=>$this->mfp_procurement_id,
            'mfp_id'=>$this->mfp_id,
            'getMfpData'=>isset($this->getMfpData->getMfpName->title)?$this->getMfpData->getMfpName->title:null,
            'qty'=>$this->qty,
            'haats'=>CollectionLevelHaatsResource::collection($this->getHaats),
            'warehouse'=>$this->warehouse,
            'getWarehouseName'=>isset($this->getWarehouseName->getWarehouse->getPartOne->name)?$this->getWarehouseName->getWarehouse->getPartOne->name:null,
            'capacity'=>$this->capacity,
            'procurement_center'=>$this->procurement_center,
            'procurement_center_name' =>isset($this->getProcurementCenter)?$this->getProcurementCenter->procurement_center_name:null,
            'packing_material_type'=>$this->packing_material_type,
            'packing_material_type_name'=>$this->getPackingMaterialDatas,
            'standard_packing'=>$this->standard_packing,
            'category'=>$this->category,
            'category_name'=>isset($this->getCategory->title)?$this->getCategory->title:'',
            'size'=>$this->size,
            'size_value'=>$size,
            'total_packing_bags'=>$this->total_packing_bags,
            'unit_cost'=>$this->unit_cost,
            'total_cost_of_packaging_material'=>$this->total_cost_of_packaging_material,
            
        ];
    }
}
