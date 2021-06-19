<?php

namespace App\Http\Resources\Api\MisReport;

use Illuminate\Http\Resources\Json\JsonResource;


class StateWiseVdvkProposalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $proposedLocation = $this->getProposedLocation;
        $financial_year = $this->getProposedFinancialYear;
        $date=$this->get_sanctioned_amount;
        return [
            'id' => $this->id,
            'name' => strip_tags($proposedLocation->kendra_name),
            'sanctioned_amount' => $this->getSanctionedAmount(),            
            'released_amount' => strip_tags($date->released_amount),
            'state' => '',
            'financial_year' => strip_tags($financial_year->title),
            'sanctioned_date' => $this->sanctioned_date,
            'release_date' => '',
        ];
    }

    private function getSanctionedAmount()
    {
        $sanctionLetters = $this->getSanctionLetters;
        return $sanctionLetters->sum('pivot.sanctioned_amount');
    }
}
