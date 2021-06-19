<?php

namespace App\Http\Resources\Api\SanctionLetter;

use Illuminate\Http\Resources\Json\JsonResource;

class InfrastructureSanctionLetterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        //$ministry_share=$this->getMinistryShare;
        
        return [
            'id' => $this->id,
            'transaction_id' => $this->transaction_id,
            'transaction_date' => date('d/m/Y',strtotime($this->transaction_date)),
            'transaction_date_format' => date('d-M-Y',strtotime($this->transaction_date)),
            'sanctioned_amount' => $this->sanctioned_amount,
            'sanctioned_by' => $this->getUser,
            'file_number' => $this->file_number,
            'sanction_date' => $this->sanction_date,
            'sanction_date' => $this->sanction_date,
            
            
            
        ];
    }
}
