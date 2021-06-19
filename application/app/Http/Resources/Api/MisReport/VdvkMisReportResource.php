<?php

namespace App\Http\Resources\Api\MisReport;

use Illuminate\Http\Resources\Json\JsonResource;
use carbon\carbon;


class VdvkMisReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $location = $this->getProposedLocation;
        $vdvk = $this->getVdvk;
        $vdvk_funds = $this->getFundManagement;
        $sanctioned_amount = $this->get_sanctioned_amount; 
        $state = $location->getState;
        $district = $location->getDistrict;
        $block = $location->getBlock;
        $created_at = Carbon::parse($vdvk['created_at'])->format('d/m/Y h:i:s A');
        //$sanctioned_amount = $vdvk_funds['to_released_amount'];
        $vdvk_funds_approval_date = Carbon::parse($vdvk_funds['created_at'])->format('d/m/Y h:i:s A');

        return [
                "vdvk_id" => $location->vdvk_id,
                "kendra_name" => strip_tags($location->kendra_name),
                'state'       => ($state->exists) ? strip_tags($state->title) : null,
                'district'    => ($district->exists) ? strip_tags($district->title) : null,
                'block'       => ($block->exists) ? strip_tags($block->title) : null,
                'proposal_submission_date'       => ($created_at) ? $created_at : null,
                'proposal_approval_date' => ($vdvk['actual_date']) ? $vdvk['actual_date'] : null,
                'sanctioned_amount' => ($sanctioned_amount['released_amount']) ? 'Rs. '.$sanctioned_amount['released_amount'] : '',
                'vdvk_funds_approval_date' => ($vdvk_funds_approval_date) ? $vdvk_funds_approval_date : null,
                'status'      => $this->status,
        ];
    }
}