<?php

namespace App\Http\Resources\Api\MisReport;

use Illuminate\Http\Resources\Json\JsonResource;

class VdvkFundBalanceListingResource extends JsonResource
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
        $fundBalance = $this->getFundBalances;
        $users = $this->userNames;
        //print_r($users['name']);
        $state = $location->getState;
        $district = $location->getDistrict;
        $block = $location->getBlock;

        return [
            "id"            => $this->id,
            "ref_id"            => $this->ref_id,
            // "year_id"           => $this->year_id,
            "user_id"           => $this->user_id,
            "user_name"         => $users['name'],
            "status"            => $this->status,
            "sanctioned"        => ($this->sanctioned) ?  strip_tags('Rs. '.$this->sanctioned) : '',
            "proposed_amount"   => ($this->proposed_amount) ?  strip_tags('Rs. '.$this->proposed_amount) : '',
            "remarks"           => strip_tags($this->remarks),
            // "created_by"        => $this->created_by,
            // "updated_by"        => $this->updated_by,

            'fundBalance'       => [
                "proposed_amount"   => (!empty($fundBalance['proposed_amount'])) ? strip_tags('Rs. '.$fundBalance['proposed_amount']) : '',
                "approved_amount"   => (!empty($fundBalance['approved_amount'])) ? strip_tags('Rs. '.$fundBalance['approved_amount']) : '',
                "released_amount"   => (!empty($fundBalance['released_amount'])) ? strip_tags('Rs. '.$fundBalance['released_amount']) : '',
                "balance_amount"    => (!empty($fundBalance['balance_amount'])) ? strip_tags('Rs. '.$fundBalance['balance_amount']) : '',
                "created_by"        => $fundBalance['created_by'],
                "updated_by"        => $fundBalance['updated_by'],
            ],

            'state'             => ($state->exists) ? strip_tags($state->title) : null,
            'district'          => ($district->exists) ? strip_tags($district->title) : null,
            'block'             => ($block->exists) ? strip_tags($block->title) : null,
        ];
    }
}


