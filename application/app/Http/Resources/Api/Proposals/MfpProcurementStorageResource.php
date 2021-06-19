<?php

namespace App\Http\Resources\Api\Proposals;
use App\Models\Masters\HaatDetailsMaster; 
use App\Models\Haatbazaar\HaatMarketOne;
use Illuminate\Http\Resources\Json\JsonResource; 
class MfpProcurementStorageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {     
        $mfpMasterData=$this->getMfpcommodityData;
        $MfpName=isset($mfpMasterData->getMfpName)?$mfpMasterData->getMfpName:null;       
        $ware=isset($this->getwarehouseData->getWarehouse->getPartOne->name)?$this->getwarehouseData->getWarehouse->getPartOne->name:null;
        return [
            'id' => $this->id,
            'form_id' => $this->mfp_procurement_id,
            'getMfpData' => $MfpName,    
            'mfp_name' => $this->mfp_name,
            'warehouse'=>$this->warehouse,
            'warehousedata'=>$ware,
            'storage_type'=>$this->storage_type,
            'warehouse_type'=>$this->warehouse_type,
            'storage_capacity'=>$this->storage_capacity,
           // 'haat'=>$this->haat,
            //'haat_item'=>$this->getHaat($this->haat),
            'estimated_storage'=>$this->estimated_storage, 
            'storage_haat'=>Mfp_storage_haatResource::collection($this->getStorageHaat), 
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ];
    }

 /*   public function getHaat($ids)
    {   
        $val=explode(',', $ids); 
        foreach ($val as $value) {            
        $data=HaatDetailsMaster::where('id',$value)->first();
        $mappeddata=HaatBazaarFormMapping::where('id',$data['haat_bazaar_id'])->first();
        $haatname=HaatMarketOne::where('id',$mappeddata['part_one'])->first();
        $getData[]=$haatname['rpm_name'];
        }
        $val = implode(',', $getData);
        return $val;
         
    }*/
}
