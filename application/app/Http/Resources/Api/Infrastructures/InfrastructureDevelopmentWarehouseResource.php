<?php

namespace App\Http\Resources\Api\Infrastructures;

use Illuminate\Http\Resources\Json\JsonResource; 
class InfrastructureDevelopmentWarehouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {      $mfpMasterData=$this->getMfpcommodityData;
        $MfpName=isset($mfpMasterData->getMfpName)?$mfpMasterData->getMfpName->title:null; 
         $ware=isset($this->getWarehouseDetails->getWarehouse->getPartOne->name)?$this->getWarehouseDetails->getWarehouse->getPartOne->name:null;
       // print_r($ware); die();
        return [
            'id' => $this->id,
            'infra_id' => $this->infra_id,
            'warehouse' => $this->warehouse,           
            'warehouse_name' => $ware,           
            //'block' => $this->block,
            //'block_name' => $this->getBlockDetails->title??null,
             //'mfp_id' => $this->mfp_name,
            //'mfp_name' => $MfpName,
            'mfp_data' =>InfrastructureDevelopmentWarehouseMfpRescource::collection($this->getMfpData), 
            'block_data' =>InfrastructureDevelopmentWarehouseBlockRescource::collection($this->getBlockData),
            'storage_type' => $this->storage_type,
            'storage_capacity' => $this->storage_capacity,
            'estimated_fund' => $this->estimated_fund,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
        ];
    }
}
