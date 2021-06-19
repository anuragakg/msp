<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Masters\Commodity;
class ProposedBuyerTieUpsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $agent = $this->getAgent;                
        $StatusEngagement = $this->getStatusEngagement;                
        $commodity_data=Commodity::all();
        $commodity_arr=array();
        $saved_commodity=$this->commodity;
        if(!empty($commodity_data))
        {
            foreach ($commodity_data as $key => $commodity){
                if(!empty($saved_commodity) && in_array($commodity->id,$saved_commodity))
                {
                    $commodity_arr[]=$commodity['title'];    
                }
            }
        }
        //echo '<pre>';print_r($commodity_arr);die;
        return [
            'agent_id' => !empty($this->agent_id)?$this->agent_id:'',
            'agent_name' => isset($agent['name'])? strip_tags($agent['name']) :'',
            // 'agent' => $agent,
            'name' => $this->name ?? '',
            'mobile_no' => $this->mobile_no ?? '',
            'landline_no' => $this->landline_no ?? '',
            'commodity' => $this->commodity ?? '',
            'commodities_name' => (isset($commodity_arr) && !empty($commodity_arr))?implode(',',$commodity_arr):'',
            'address' => $this->address ?? '',
            'proposed_arrangements' => $this->proposed_arrangements ?? '',
            'status_engagement' => $this->status_engagement ?? '',
            'status_engagement_title' => $StatusEngagement['title'] ?? '',
        ];
    }
}
