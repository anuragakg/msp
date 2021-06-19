<?php

namespace App\Http\Resources\Api\Actualdetail;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Proposals\MfpCoverageResource;
class ActualTribalDetailListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {   
        $commodity=$this->getActualDetailCommodity;
        $fund_received = $this->getReceivedFund;
        //$consolidated_tribal_transaction = $this->getProcurementConsolidatedTribalTransaction;
        $consolidated_transaction = isset($this->getMfpTransaction)?$this->getMfpTransaction:'';
        //dd($consolidated_transaction);
        $transaction_status = '';
        $district_name = '';
        if(isset($this->getMfpTransaction)){
            if(isset($this->getMfpTransaction->statusLog)){
                $transaction_status = $this->getMfpTransaction->statusLog->status;
            }
        }
        if(isset($consolidated_transaction->getProcurementConsolidatedTransaction)){
            if(isset($consolidated_transaction->getProcurementConsolidatedTransaction->getDistrict)){
                $district_name = $consolidated_transaction->getProcurementConsolidatedTransaction->getDistrict->title;
            }
        }
       
       
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

        $remarks = isset($this->getMfpTransaction->statusLog->remarks)?$this->getMfpTransaction->statusLog->remarks:'N/A';
		//$remarks = 'N/A';
        $qty = $commodity->sum('qty');
        $value = $commodity->sum('value');
        $mfp_id_count = $commodity->count('mfp_id');
        
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

        foreach($this->getActualOverheadCollectionLevel as $packing_material){
            $packing_material_cost = $packing_material_cost + $packing_material->total_cost_of_packaging_material  ;
        }
        foreach($this->getActualOverheadLabourCharges as $labour_charges_value){
            $labour_charges =  $labour_charges + $labour_charges_value->total_estimated_cost  ;
        }
        foreach($this->getActualOverheadWeightmentCharges as $weightment_charges_value){
            $weightment_charges =  $weightment_charges + $weightment_charges_value->total_estimated_cost ;
        }
        foreach($this->getActualOverheadTransportationCharges as $transportation_charges_value){
            $transportation_charges =  $transportation_charges + $transportation_charges_value->estimated_total_cost_of_transportation  ;
        }
        foreach($this->getActualOverheadServiceCharges as $service_charges_value){
            $transportation_charges =  $service_charges + $service_charges_value->service_charge_in_total_value_of_procurement  ;
        }
        foreach($this->getActualOverheadWarehouseLabourCharges as $warehouse_labour_charges_value){
            $warehouse_labour_charges =  $warehouse_labour_charges + $warehouse_labour_charges_value->total_estimated_cost  ;
        }
        foreach($this->getActualOverheadWarehouseCharges as $warehouse_charges_value){
            $warehouse_charges =  $warehouse_charges + $warehouse_charges_value->total_estimated_cost  ;
        }
        foreach($this->getActualOverheadEstimatedWastages as $estimated_wastages_value){
            $estimated_wastages =  $estimated_wastages + $estimated_wastages_value->estimated_driage_rs  ;
        }
        foreach($this->getActualOverheadEstimatedWastages as $estimated_wastages_value){
            $estimated_wastages =  $estimated_wastages + $estimated_wastages_value->estimated_driage_rs  ;
        }
        foreach($this->getActualOverheadServiceChargesDIA as $service_charges_dia_value){
            $service_charges_dia =  $service_charges_dia + $service_charges_dia_value->service_charge_value  ;
        }
        foreach($this->getActualOverheadOtherCosts as $other_cost_value){
            $other_costs =  $other_costs + $other_cost_value->other_costs  ;
        }
       
     

        $total_fund_utilized = $this->amount_paid + $packing_material_cost + $labour_charges + $weightment_charges + $transportation_charges + $warehouse_labour_charges + $warehouse_charges + $estimated_wastages;
        $sum_of_receipt_generated=$this->getReceiptGenerated->sum('amount');
        return [
            'id' => $this->id,
            'ref_id' => $this->ref_id,
            'id_type' => $this->id_type,
            'id_value' => $this->id_value,
            'shg_id' => $this->shg_id,
            'name_of_tribal' => $this->name_of_tribal,
            'bank_account_no' => $this->bank_account_no,
            'village' => $this->village,
            'bank_ifsc' => $this->bank_ifsc,
            'procurement_date' =>date('d-M-Y',strtotime( $this->procurement_date)),
            'mfp_procurement_id' => $this->mfp_procurement_id,
            'proposal_id' => $this->getMfpProcurement->proposal_id,
            'amount_paid' => $this->amount_paid,
            'amount_payable' => $this->amount_payable,
            'has_receipt_generated' => $this->has_receipt_generated,
            'qty' => $qty,
            'value' => $value,
            'mfp_id_count' => $mfp_id_count,
            'created_by' => $this->created_by,
            'created_at' => date('d-M-Y H:i',strtotime($this->created_at)),
            'consolidated_id'=> $this->consolidated_id,
            'proposal_ref_id'=>$this->getMfpProcurement->ref_id,
            'fund_received'=>$fund_received->total_released_to_procurement_agent,
            'consolidated_transaction_id'=>isset($consolidated_transaction->getProcurementConsolidatedTransaction)?$consolidated_transaction->getProcurementConsolidatedTransaction->reference_number:'',
            'district_name'=>$district_name,
            'status'=> $status_text,
            'status_value'=> $transaction_status,
            'remarks'=> $remarks,
            'total_fund_utilized'=> $total_fund_utilized,
            'submitted_by' => $this->getUser->name.' '.$this->getUser->last_name,
            'sum_of_receipt_generated' =>$sum_of_receipt_generated,
            'balance_for_receipt_generated' =>$this->amount_paid-$sum_of_receipt_generated,
            'is_procurement_details_submitted'=> $this->is_procurement_details_submitted,
            'is_overhead_details_submitted'=>$this->is_overhead_details_submitted,
            'transaction_id'=>isset($this->getMfpTransaction)?$this->getMfpTransaction->transaction_id:'NA',
         
        ];
    }
}
