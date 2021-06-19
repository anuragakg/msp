<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ProposedMfpDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $CommodityData=$this->getCommodityData;
        

        $shg_data=$this->getShgData;
        
        $groups_data=array();
        $shg_members=array();
        
        $shg_data=$this->getShgData;
        /*Create array with keys of proposed_mfp*/
        foreach ($shg_data->toArray() as $key => $arr) 
        {
            $proposed_mfp=$arr['proposed_mfp'];
            $groups_data[$arr['proposed_mfp']][]=$arr;
        }
        //month name create
        $month_arr=array();
        $allmonths=array(

            1=>'January',
            2=>'February',
            3=>'March',
            4=>'April',
            5=>'May',
            6=>'June',
            7=>'July',
            8=>'August',
            9=>'September',
            10=>'October',
            11=>'November',
            12=>'December'
        );
        if(!empty($this->months))
        {
            $months=explode(',', $this->months);
            foreach ($months as $key => $month) 
            {
                $month_arr[]= $allmonths[$month];
            }
        }
        
        $shg_members=array(
                'mfp_id'=>$this->mfp_name,
                'mfp_name'=> strip_tags($CommodityData['title']),
                'months'=>explode(',', $this->months),
                'months_name'=>!empty($month_arr)?implode(',', $month_arr):'',
                'available'=>$this->available,
                'plan'=>$this->plan,
                'shg_groups'=> isset($groups_data[$this->id]) ? $groups_data[$this->id] : [],    
            );
        return [
            'id' => $this->id,
            'shg_members'=>$shg_members,
        ];
    }
}
