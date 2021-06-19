<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
class CaptureLocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $ro_name= isset($this->getROName->title)?$this->getROName->title:null;
        $getConsignmentShop= isset($this->getConsignmentShop->title)?$this->getConsignmentShop->title:null;
        $getOwnedShop= isset($this->getOwnedShop->title)?$this->getOwnedShop->title:null;
        $getFranchise= isset($this->getFranchise->title)?$this->getFranchise->title:null;
        $getVdvkName= isset($this->getVdvkName->title)?$this->getVdvkName->title:null;
        $getClusterName= isset($this->getClusterName->title)?$this->getClusterName->title:null;
        $otherLocations=$this->getOtherLocations;
        $otherPhotos=$this->getOtherPhotos;
        $states = $this->getStates;
        $districts = $this->getDistricts;
        $blocks = $this->getBlocks;
        $villages = $this->getVillages;
        $other_img=array();
        foreach ($otherPhotos as  $value) {          
            $other_img[]=array('img'=>url(Storage::url($value['photo'])) ,'caption' =>$value['caption']);
        }
        $other_desc_img=array();
         foreach ($otherLocations as  $value) {          
            $label_photo=explode(',', $value['images']);
            $lavel_img=array();
            foreach ($label_photo as  $val) {
               $lavel_img[]=url(Storage::url($val));
            }            
            $other_desc_img[]=array('label'=>$value['label_name'],'label_val'=>$value['label_value'],'label_img'=>$lavel_img ,'description' =>$value['description']);
        }

        if($this->loc_cat_id == '1'){
            $category_name = 'Regional Office';
        }
        if($this->loc_cat_id == '2'){
            $category_name = 'Franchise';
        }
        if($this->loc_cat_id == '3'){
            $category_name = 'Consignment Shop';
        }
        if($this->loc_cat_id == '4'){
            $category_name = 'Owned Shop';
        }
        if($this->loc_cat_id == '5'){
            $category_name = 'VDVK';
        }
        if($this->loc_cat_id == '6'){
            $category_name = 'Cluster';
        }
        return [
            'id' => $this->id,
            'loc_cat_id' =>  $this->loc_cat_id,
            'category_name' => $category_name,
            'name' => $this->name,
            'ro_name_name' => $ro_name,
            'consignment_shop' => $this->consignment_shop,
            'consignment_shop_name' => $getConsignmentShop,
            'owned_shop' => $this->owned_shop,
            'owned_shop_name' => $getOwnedShop,
            'franchise' => $this->franchise,
            //'franchise_name' => $getFranchise,
            'vdvk' => $this->vdvk_name,
            'vdvk_name' => $getVdvkName,
            'cluster' => $this->cluster_name,
            'cluster_name' => $getClusterName,
            'state' => $this->state,
            'state_name' => $states['title'],
            'district' => $this->district,
            'district_name' => $districts['title'],
            'block' => $this->block,
            'block_name' => $blocks['title'],
            'pincode' => $this->pincode,
            'village' => $this->village,
            'village_name' => $villages['title'],
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'icon' => $this->icon,
            'icon_image' => $this->icon ? url(Storage::url($this->icon)) : null,
            'address' => $this->address,
            'description' => $this->description,
            'introduction' => $this->introduction,
            'tribes' => $this->tribes,
            'other_capture_locations' => $otherLocations,
            'other_capture_photos' => $otherPhotos,
            'other_photos'  =>$other_img,
            'other_desc_img' =>$other_desc_img,

        ];
    }
}
