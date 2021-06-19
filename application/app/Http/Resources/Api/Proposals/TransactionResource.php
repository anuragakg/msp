<?php

namespace App\Http\Resources\Api\Proposals;

use App\Http\Resources\Api\Actualdetail\MfpStorageHaatDetailsResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        if ($this->uploaded_on != '') {
            $uploaded_on = date('d-M-Y', strtotime($this->uploaded_on));
        } else {
            $uploaded_on = '';
        }
        return [
            'mfp_storage_other_id' => $this->id,
            'mfp_name' => $this->getActualStorage->getMfp->getMfpName->title,
            'warehouse_name' => isset($this->getWarehouseName->getWarehouse->getPartOne->name) ? $this->getWarehouseName->getWarehouse->getPartOne->name : null,
            //'haat_name' => $this->getHaat->getHaatBazaarDetail->getPartOne->rpm_name,
            'haat_data' => isset($this->getCoresspodingHaat)?MfpStorageHaatDetailsResource::collection($this->getCoresspodingHaat):'',
            'qty' => $this->qty,
            'value' => $this->value,
            'is_uploaded' => $this->is_uploaded,
            'proposal_id' => isset($this->getMfpProcurement->proposal_id)?$this->getMfpProcurement->proposal_id:'',
            //'uploaded_on'=>($this->uploaded_on!=null || $this->uploaded_on != '0000-00-00 00:00:00')?date('d-M-Y',strtotime($this->uploaded_on)):'',
            //'uploaded_on'=>(strtotime($this->uploaded_on) != -62170005208) ? date('d-M-Y',strtotime($this->uploaded_on)):'',
            'uploaded_on' => $uploaded_on,
            'receipt_path' => !empty($this->receipt_path) ? url(Storage::url($this->receipt_path)) : null,
            //'warehouse_transactions'=>TransactionResource::collection($this->getActualMfpOther)
        ];
    }
}
