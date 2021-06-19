<?php

namespace App\Http\Resources\Api\Actualdetail;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ConsolidatedTransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $district_name = '';
        $proposal_id = '';
        $district_name = $this->getDistrict->title;
        $proposal_data = $this->getMfpProcurementTransaction;
        $received_fund = 0;
        $transaction_status = '';
        $consolidated_ref_primary_id = $this->id;
                    
        $packing_material_cost = 0;
        $labour_charges = 0;
        $weightment_charges = 0;
        $transportation_charges = 0;
        $warehouse_labour_charges = 0;
        $warehouse_charges = 0;
        $estimated_wastages = 0;
        $service_charges = 0; 
        $service_charges_dia = 0;
        $other_costs = 0 ;
        $tribal_costs = 0;
        $storage_costs = 0;
        $mfp_procurement_id = '';
        $total_mfp = 0;
        $total_qty = 0;
        $total_val = 0;
        $received_fund = 0;
        $total_fund_utilized=0;
        $remarks = 'N/A';
        $status_text ='';
        $statusss = '';
        

        foreach($proposal_data as $proposal_row){
            $proposal_id = $proposal_row->getMfpProcurement->proposal_id;
            $mfp_procurement_data = $proposal_row->getMfpProcurement;
            $mfp_procurement_id = $mfp_procurement_data->id;
            foreach($mfp_procurement_data->getActualOverheadCollectionLevel as $packing_material){
                $packing_material_cost = $packing_material_cost + $packing_material->total_cost_of_packaging_material  ;
            }
            foreach($mfp_procurement_data->getActualOverheadLabourCharges as $labour_charges_value){
                $labour_charges =  $labour_charges + $labour_charges_value->total_estimated_cost  ;
            }
            foreach($mfp_procurement_data->getActualOverheadWeightmentCharges as $weightment_charges_value){
                $weightment_charges =  $weightment_charges + $weightment_charges_value->total_estimated_cost ;
            }
            foreach($mfp_procurement_data->getActualOverheadTransportationCharges as $transportation_charges_value){
                $transportation_charges =  $transportation_charges + $transportation_charges_value->estimated_total_cost_of_transportation  ;
            }
            foreach($mfp_procurement_data->getActualOverheadServiceCharges as $service_charges_value){
                $service_charges =  $service_charges + $service_charges_value->service_charge_in_total_value_of_procurement  ;
            }
            foreach($mfp_procurement_data->getActualOverheadWarehouseLabourCharges as $warehouse_labour_charges_value){
                $warehouse_labour_charges =  $warehouse_labour_charges + $warehouse_labour_charges_value->total_estimated_cost  ;
            }
            foreach($mfp_procurement_data->getActualOverheadWarehouseCharges as $warehouse_charges_value){
                $warehouse_charges =  $warehouse_charges + $warehouse_charges_value->total_estimated_cost  ;
            }
            foreach($mfp_procurement_data->getActualOverheadEstimatedWastages as $estimated_wastages_value){
                $estimated_wastages =  $estimated_wastages + $estimated_wastages_value->estimated_driage_rs  ;
            }
            foreach($mfp_procurement_data->getActualOverheadServiceChargesDIA as $service_charges_dia_value){
                $service_charges_dia =  $service_charges_dia + $service_charges_dia_value->service_charge_value  ;
            }
            foreach($mfp_procurement_data->getActualOverheadOtherCosts as $other_cost_value){
                $other_costs =  $other_costs + $other_cost_value->other_costs  ;
            }
            foreach($mfp_procurement_data->getActualTribalDetail as $tribal){
                $tribal_costs = $tribal_costs + $tribal->amount_paid;
            }
            foreach($mfp_procurement_data->getActualMfpStorageOther as $storage){
                $storage_costs = $storage_costs + $storage->value;
            }

            foreach($mfp_procurement_data->getDiaReleasedToProcurementsAgent as $release_fund ){
                if($release_fund->procurement_agent == Auth::user()->id){
                    $total_mfp += $release_fund->total_mfp;
                    $total_qty += $release_fund->total_quantity;
                    $total_val += $release_fund->total_value;
                    $received_fund = $received_fund + $release_fund->total_released_to_procurement_agent;
                    //$remarks = isset($this->getMfpTransaction->statusLog->remarks)?$this->getMfpTransaction->statusLog->remarks:'N/A';
                }else{
                    $total_mfp += $release_fund->total_mfp;
                    $total_qty += $release_fund->total_quantity;
                    $total_val += $release_fund->total_value;
                    $received_fund = $received_fund + $release_fund->total_released_to_procurement_agent;
                    //$transaction_status = $proposal_row->statusLog->status;
                    
                }
            }
            
            $remarks = $this->remarks ? $this->remarks:'';
            $transaction_status = $this->current_status;
            //$statusss = $proposal_row->statuslog;
        
        }
        $total_fund_utilized = $tribal_costs + $storage_costs +$packing_material_cost + $labour_charges + $weightment_charges + $service_charges + $transportation_charges + $warehouse_labour_charges + $warehouse_charges + $estimated_wastages +$service_charges_dia+ $other_costs;
        if($transaction_status == 0){
            $status_text = '<label class="label label-warning">Pending</label>';
        }
        if($transaction_status == 1){
            $status_text = '<label class="label label-success">Approved</label>';
        }
        if($transaction_status == 2){
            $status_text = '<label class="label label-primary">Reverted</label>';
        }
        if($transaction_status == 3){
            $status_text = '<label class="label label-danger">Rejected</label>';
        }
        
        return [
            'id' => $this->id,
            //'statuss'=>$statusss,
            'consolidated_transaction_id' => $this->reference_number,
            'district' => $this->district,
            'district_name' => $district_name,
            'proposal_id' => $proposal_id,
            'mfp_procurement_id'=> $mfp_procurement_id,
            'mfp_id_count'=> $total_mfp,
            'qty'=> $total_qty,
            'value'=> $total_val,
            'fund_received'=>$received_fund,
            'status'=> $status_text,
            'status_value'=> $transaction_status,
            'remarks'=>$remarks,
            'total_fund_utilized'=> $total_fund_utilized,
            'tribal_cost'=> $tribal_costs,
            'storage_cost'=> $storage_costs,
            'packing_material_cost'=>$packing_material_cost,
            'submitted_on'=> date('d-M-Y H:i',strtotime($this->created_at)),
            'submitted_by'=> $this->getUser->name.' '.$this->getUser->last_name,
            'consolidated_ref_prim_id'=>$consolidated_ref_primary_id,
            'commission_amount' => $this->commission_amount,
            'commission_rate' => $this->commission_rate,
            'remaining_amount' => $this->remaining_amount,
            //'p_status'=>$statusss,

        ];
    }
}
