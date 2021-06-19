<?php

namespace App\Http\Resources\Api\SanctionLetter;

use App\Models\InfraSanctionLetter;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class InfrastructureSanctionedListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $loggedInRole = Auth::user()->role;
        if($loggedInRole == 3){ //Ministry
            $max_sanctioned_ammount = $this->getConsolidatedData->approved_amount * 75/100;
        }else{
            $max_sanctioned_ammount = $this->getConsolidatedData->approved_amount * 25/100;
        }
        return [
            'id' => $this->id,
            'consolidated_id' => $this->consolidated_id,
            'no_proposal'   => $this->getProposalDatalist->count(),
            'proposal_id' => $this->getProposalData->proposal_id,
            'reference_number' => $this->getConsolidatedData->reference_number,
            'state' => $this->getConsolidatedData->state,
            'state_name' => $this->getConsolidatedData->getState->title,
            'year_id' => $this->getConsolidatedData->year_id,
            'year_name' => $this->getConsolidatedData->getProposedFinancialYear->title,
            'file_number' => $this->file_number,
            'sanction_date' => date('d/m/Y',strtotime($this->sanction_date)),
            'approved_amount'=> $this->getConsolidatedData->approved_amount,
            'max_sanctioned_amount'=> $max_sanctioned_ammount ,
            'sanctioned_amount' => $this->sanctioned_amount,
            'total_sanctioned_amount'=> InfraSanctionLetter::where("consolidated_id",$this->consolidated_id)->sum("sanctioned_amount"),
            'transaction_id' => $this->transaction_id,
            'transaction_date' =>date('d/m/Y',strtotime($this->transaction_date)),
            'created_by' => $this->getUser->name.' '.$this->getUser->middle_name.' '.$this->getUser->last_name,
            'created' => date('d/m/Y',strtotime($this->created_at)),
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
            
        ];
    }
}
