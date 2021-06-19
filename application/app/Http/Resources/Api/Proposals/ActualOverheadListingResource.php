<?php

namespace App\Http\Resources\Api\Proposals;

use Illuminate\Http\Resources\Json\JsonResource;
class ActualOverheadListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $haat_amount_spent = 0;
        $warehouse_amount_spent = 0;
        $total = 0;

        $ActualOverheadCollectionLevel = $this->getActualOverheadCollectionLevel->sum('total_cost_of_packaging_material');
        $ActualOverheadLabourCharges = $this->getActualOverheadLabourCharges->sum('total_estimated_cost');
        $ActualOverheadWeightmentCharges = $this->getActualOverheadWeightmentCharges->sum('total_estimated_cost');
        $ActualOverheadTransportationCharges = $this->getActualOverheadTransportationCharges->sum('estimated_total_cost_of_transportation');


        $ActualOverheadServiceCharges = $this->getActualOverheadServiceCharges->sum('service_charge_in_total_value_of_procurement');

        $ActualOverheadWarehouseLabourCharges = $this->getActualOverheadWarehouseLabourCharges->sum('total_estimated_cost');
        $ActualOverheadWarehouseCharges = $this->getActualOverheadWarehouseCharges->sum('total_estimated_cost');
        $ActualOverheadEstimatedWastages = $this->getActualOverheadEstimatedWastages->sum('estimated_driage_rs');
        $ActualOverheadServiceChargesDIA = $this->getActualOverheadServiceChargesDIA->sum('service_charge_value');
        
        $ActualOverheadOtherCosts = $this->getActualOverheadOtherCosts->sum('other_costs');

        $haat_amount_spent =  $ActualOverheadCollectionLevel + $ActualOverheadLabourCharges + $ActualOverheadWeightmentCharges + $ActualOverheadTransportationCharges;


        $warehouse_amount_spent = $ActualOverheadWarehouseLabourCharges + $ActualOverheadWarehouseCharges + $ActualOverheadEstimatedWastages;
        //$total_amount_spent = 12 + 18;
        /*foreach($this->getActualOverheadCollectionLevel as $packing_material){
            $haat_amount_spent =  $haat_amount_spent + $packing_material->total_cost_of_packaging_material  ;
        }
        foreach($this->getActualOverheadLabourCharges as $labour_charges){
            $haat_amount_spent =  $haat_amount_spent + $labour_charges->total_estimated_cost  ;
        }
        foreach($this->getActualOverheadWeightmentCharges as $weightment_charges){
            $haat_amount_spent =  $haat_amount_spent + $weightment_charges->total_estimated_cost  ;
        }
        foreach($this->getActualOverheadTransportationCharges as $transportation_charges){
            $haat_amount_spent =  $haat_amount_spent + $transportation_charges->estimated_total_cost_of_transportation  ;
        }

        foreach($this->getActualOverheadWarehouseLabourCharges as $warehouse_labour_charges){
            $warehouse_amount_spent =  $warehouse_amount_spent + $warehouse_labour_charges->total_estimated_cost  ;
        }
        foreach($this->getActualOverheadWarehouseCharges as $warehouse_charges){
            $warehouse_amount_spent =  $warehouse_amount_spent + $warehouse_charges->total_estimated_cost  ;
        }
        foreach($this->getActualOverheadEstimatedWastages as $estimated_wastages){
            $warehouse_amount_spent =  $warehouse_amount_spent + $estimated_wastages->estimated_driage_rs  ;
        }*/
       
        $total_amount_spent = $ActualOverheadCollectionLevel + $ActualOverheadLabourCharges + $ActualOverheadWeightmentCharges + $ActualOverheadTransportationCharges + $ActualOverheadServiceCharges + $ActualOverheadWarehouseLabourCharges + $ActualOverheadWarehouseCharges + $ActualOverheadEstimatedWastages + $ActualOverheadServiceChargesDIA + $ActualOverheadOtherCosts;
       
        
        return [
            'id' => $this->id,
            'ref_id'=> $this->ref_id,
            'proposal_id'=> $this->proposal_id,
            'status'=> $this->status,
            'mfps'=> $this->getMfpCoverage->count(),
            'haat_amount_spent'=> $haat_amount_spent,
            'warehouse_amount_spent'=> $warehouse_amount_spent,
            'ActualOverheadCollectionLevel'=> $ActualOverheadCollectionLevel,
            'ActualOverheadLabourCharges'=> $ActualOverheadLabourCharges,
            'ActualOverheadWeightmentCharges'=> $ActualOverheadWeightmentCharges,
            'ActualOverheadTransportationCharges'=> $ActualOverheadTransportationCharges,
            'ActualOverheadServiceCharges'=> $ActualOverheadServiceCharges,
            'ActualOverheadWarehouseLabourCharges'=> $ActualOverheadWarehouseLabourCharges,
            'ActualOverheadWarehouseCharges'=> $ActualOverheadWarehouseCharges,
            'ActualOverheadEstimatedWastages'=> $ActualOverheadEstimatedWastages,
            'ActualOverheadServiceChargesDIA'=> $ActualOverheadServiceChargesDIA,
            'ActualOverheadOtherCosts'=> $ActualOverheadOtherCosts,
            'total_amount_spent'=> $total_amount_spent,
            'date' => date('d-M-Y',strtotime($this->created_at)),
        ];
    }
}
