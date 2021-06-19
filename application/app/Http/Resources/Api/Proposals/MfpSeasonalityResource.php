<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Proposals\MfpSeasonalityCommodityResource;
use Helper;
class MfpSeasonalityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        
        $commodity_data=MfpSeasonalityCommodityResource::collection($this->getCommodityData);
        
        $commodities_mfpwise=array();
        $commodities=array();
        if(!empty($commodity_data))
        {
            foreach ($commodity_data as $key => $commodity) {
                if(!empty($this->haat_id) && !empty($commodity->mfp_id))
                {
                    $haat_id=$this->haat_id;
                    $mfp_id=$commodity->mfp_id;
                    if(isset($commodities_mfpwise[$haat_id][$mfp_id]))
                    {
                        $commodities_mfpwise[$haat_id][$mfp_id]['qty'] +=$commodity->qty;
                        $commodities_mfpwise[$haat_id][$mfp_id]['value'] +=$commodity->value;
                    }else{
                        $commodities_mfpwise[$haat_id][$mfp_id]=array(
                            'haat_id'=>$haat_id,
                            'mfp_id'=>$mfp_id,
                            'qty'=>$commodity->qty,
                            'value'=>$commodity->value,
                            'mfp_name'=>$commodity->getMfp->getMfpName->title,
                            'haat_name'=>$this->getHaat->getHaatBazaarDetail->getPartOne->rpm_name,
                        );    
                    }    
                }
            }    
        }
        if(!empty($commodities_mfpwise))
        {
            foreach ($commodities_mfpwise as $haat_key => $mfps) 
            {
                foreach ($mfps as $key => $mfp) {
                    $commodities[]=array(
                        'mfp_id'=>$mfp['mfp_id'],
                        'haat_id'=>$mfp['haat_id'],
                        'qty'=>Helper::decimalNumberFormat($mfp['qty']),
                        'value'=>Helper::decimalNumberFormat($mfp['value']),
                        'mfp_name'=>$mfp['mfp_name'],
                        'haat_name'=>$mfp['haat_name'],
                    );
                }    
            }
        }
        return [
            'id' => $this->id,
            'mfp_procurement_id'=>$this->mfp_procurement_id,
            'haat_id' => $this->haat_id,
            'block_id' => $this->getBlock,
            'haat_data' => $this->getHaat,
            'commodity_data'=>$commodity_data,
            'commodities_mfpwise'=>$commodities,
            
        ];
    }
}
