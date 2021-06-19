<?php

namespace App\Services\Proposals;

use App\Http\Resources\Api\Proposals\MfpSeasionalityQuarterWiseResource;
use App\Models\Actualdetail\Mfp_procurement_actual_detail;
use App\Models\Masters\Mfp;
use App\Models\Proposals\Mfp_procurement;
use App\Models\Proposals\Mfp_procurement_commodity;
use App\Models\Proposals\Mfp_procurement_storage;
use App\Models\Actualdetail\Overhead_collection_level;
use App\Models\Actualdetail\Overhead_warehouse_labour_charges;
use App\Models\Actualdetail\Overhead_labour_charges;
use App\Models\Actualdetail\Overhead_weighment_charges;
use App\Models\Actualdetail\Overhead_transportation_charges;
use App\Models\Actualdetail\Overhead_service_charges;
use App\Models\Actualdetail\Overhead_warehouse_charges;
use App\Models\Actualdetail\Overhead_estimated_wastages;
use App\Models\Actualdetail\Overhead_service_charges_dia;
use App\Models\Actualdetail\Overhead_other_costs;
use App\Models\Actualdetail\Overhead_collection_level_haat;
use App\Models\Mfp_procurement_dia_release;
use App\Models\Proposals\Actual_overhead;
use App\Models\Proposals\Mfp_procurement_collection_level;
use App\Models\Proposals\Mfp_procurement_transaction;
use App\Models\Mfp_procurement_dia_release_commodity;
use App\Services\Service;
use App\Queries\ActualOverheadQuery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use FundHelper;
use DB;

class ActualOverheadDetailsService extends Service
{
    private $actualOverheadQuery;

    public function __construct(ActualOverheadQuery $actualOverheadQuery = null)
    {
        $this->actualOverheadQuery = $actualOverheadQuery;
    }

    /**
     * Get a single item from database
     *
     * @param number $id
     * @return mixed
     */
    public function getOne($id)
    {
        return Mfp_procurement::where('ref_id', $id)->firstOrFail();
        //return Actual_overhead::where('mfp_procurement_id',$procurement->id)->first();
        //return $procurement;
        
    }

  
    /**
     * Update one item from database
     *
     * @param number $id
     * @param Array $data
     * @return mixed
     */
    public function updateItem($id, $data)
    {
        DB::beginTransaction();
        try {
            $total_fund_available=FundHelper::getFundAvailableAtPa();
            $user_id = Auth::user()->id;
            $consolidated_id = $data['cons_id'];
            $procurement = Mfp_procurement::where('ref_id', $data['form_id'])->firstOrFail();
            $procurement_actual_detail = Mfp_procurement_actual_detail::where('consolidated_id',$data['cons_id'])->first();
            $procurement_actual_detail->is_overhead_details_submitted = 1;
            $procurement_actual_detail->save();
           
            //=====================Save Packaging cost material=================================
            if (isset($data['collection_level']) && !empty($data['collection_level'])) {
                // $actual_overhead = new Actual_overhead();
                // $actual_overhead->mfp_procurement_id = $procurement->id;
                // $actual_overhead->proposal_id = $procurement->proposal_id;
                // $actual_overhead->status = 1;
                // $actual_overhead->created_by = $user_id;   
                //$procurement->is_actual_overhead_submitted = 1;
                

                Overhead_collection_level::where(['mfp_procurement_id' => $procurement->id])->delete();
                Overhead_collection_level_haat::where(['mfp_procurement_id' => $procurement->id])->delete();

                foreach ($data['collection_level'] as $key => $row) {

                    $collection_level = new Overhead_collection_level();
                    $collection_level->mfp_procurement_id = $procurement->id;
                    $collection_level->tribal_consolidated_id = $consolidated_id;
                    $collection_level->mfp_id = $row['mfp_id'] ?? null;
                    $collection_level->qty = $row['qty'] ?? null;
                    //$collection_level->warehouse = $row['warehouse'] ?? null;
                    $collection_level->capacity = $row['capacity'] ?? null;
                    $collection_level->procurement_center = $row['procurement_center'] ?? null;
                    $collection_level->packing_material_type = $row['packing_material_type'] ?? null;
                    //$collection_level->standard_packing = $row['standard_packing'] ?? null;
                    // $collection_level->category = $row['category'] ?? null;
                    $collection_level->size = $row['size'] ?? null;
                    $collection_level->total_packing_bags = $row['total_packing_bags'] ?? null;
                    $collection_level->unit_cost = $row['unit_cost'] ?? null;
                    $collection_level->total_cost_of_packaging_material = $row['total_cost_of_packaging_material'] ?? null;
                    $collection_level->created_by = $user_id;
                    $collection_level->updated_by = $user_id;
                    $collection_level->save();
                    if(isset($row['corresponding_haat'])){
                        foreach ($row['corresponding_haat'] as $haatkey => $haat_id) 
                        {
                            $collection_level_haat = new Overhead_collection_level_haat();
                            $collection_level_haat->mfp_procurement_id = $procurement->id;
                            $collection_level_haat->collection_level_id = $collection_level->id;
                            $collection_level_haat->haat_id = $haat_id;  
                            $collection_level_haat->created_by = $user_id;
                            $collection_level_haat->updated_by = $user_id;
                            $collection_level_haat->save();
                        }
                    }
                   
                    
                }
            }
            //To save labour charges
            if (isset($data['labour_charges']) && !empty($data['labour_charges'])) {
                Overhead_labour_charges::where('mfp_procurement_id', $procurement->id)->delete();
                $labour_mfp_haat=array();
                foreach ($data['labour_charges'] as $key => $row) {
                    if(!empty($row['mfp']) && !empty($row['haat']))
                    {
                        if(isset($labour_mfp_haat[$row['mfp']]) && in_array($row['haat'], $labour_mfp_haat[$row['mfp']]))
                        {
                            throw new \Exception("Please select different MFP and haat combination in 2. Labour Charges saction");
                            
                        }
                        $labour_mfp_haat[$row['mfp']][]=$row['haat'];    
                    }
                    
                    $labour_charges = new Overhead_labour_charges();
                    $labour_charges->mfp_procurement_id = $procurement->id;
                    $labour_charges->tribal_consolidated_id = $consolidated_id;
                    $labour_charges->mfp_id = isset($row['mfp'])?$row['mfp']: null;
                    $labour_charges->haat_id = $row['haat'] ?? null;
                    $labour_charges->unit_manday_rate = $row['unit_manday_rate'] ?? null;
                    $labour_charges->estimated_mandays = $row['estimated_mandays'] ?? null;
                    $labour_charges->total_estimated_cost = $row['total_estimated_cost'] ?? null;
                    $labour_charges->created_by = $user_id;
                    $labour_charges->updated_by = $user_id;
                    $labour_charges->save();
                }
            }
            //To save weightment charges
            if (isset($data['weightment_charges']) && !empty($data['weightment_charges'])) {
                Overhead_weighment_charges::where('mfp_procurement_id', $procurement->id)->delete();
                $weightment_mfp_haat=array();
                $weightment_mfp_pc=array();
                foreach ($data['weightment_charges'] as $key => $row) {
                    if($row['type']=='H' && !empty($row['mfp']) && !empty($row['haat_id']))
                    {
                        if(isset($weightment_mfp_haat[$row['mfp']]) && in_array($row['haat_id'], $weightment_mfp_haat[$row['mfp']]))
                        {
                            throw new \Exception("Please select different MFP and haat combination in 3. Weighment  Charges saction");
                            
                        }
                        $weightment_mfp_haat[$row['mfp']][]=$row['haat_id'];    
                    }
                    if($row['type']=='P' && !empty($row['mfp']) && !empty($row['procurement_center_id']))
                    {
                        if(isset($weightment_mfp_pc[$row['mfp']]) && in_array($row['procurement_center_id'], $weightment_mfp_pc[$row['mfp']]))
                        {
                            throw new \Exception("Please select different MFP and procurement center combination in 3. Weighment  Charges saction");
                            
                        }
                        $weightment_mfp_pc[$row['mfp']][]=$row['procurement_center_id'];    
                    }
                    $weightment_charges = new Overhead_weighment_charges();
                    $weightment_charges->mfp_procurement_id = $procurement->id;
                    $weightment_charges->tribal_consolidated_id =$consolidated_id;
                    $weightment_charges->mfp_id = $row['mfp'] ?? null;
                    $weightment_charges->type = $row['type'] ?? null;
                    if(isset($row['type'] )){
                        $weightment_charges->haat_id = $row['type']=='H'?$row['haat_id']:null;
                        $weightment_charges->procurement_center_id = $row['type']=='P'?$row['procurement_center_id']:null;
                    }else{
                        $weightment_charges->haat_id = null;
                        $weightment_charges->procurement_center_id =null;
                    }
                    
                    $weightment_charges->total_estimated_cost = $row['total_estimated_cost'] ?? null;
                    $weightment_charges->created_by = $user_id;
                    $weightment_charges->updated_by = $user_id;
                    $weightment_charges->save();
                }
            }
            //To save transportation charges
            if (isset($data['transportation_charges']) && !empty($data['transportation_charges'])) {
                Overhead_transportation_charges::where('mfp_procurement_id', $procurement->id)->delete();
                $transportation_mfp_haat=array();
                foreach ($data['transportation_charges'] as $key => $row) {
                    if(!empty($row['mfp']) && !empty($row['haat']))
                    {
                        if(isset($transportation_mfp_haat[$row['mfp']]) && in_array($row['haat'], $transportation_mfp_haat[$row['mfp']]))
                        {
                            throw new \Exception("Please select different MFP and haat combination in 4. Transportation Charges");
                            
                        }
                        $transportation_mfp_haat[$row['mfp']][]=$row['haat'];    
                    }
                    $transportation_charges = new Overhead_transportation_charges();
                    $transportation_charges->mfp_procurement_id = $procurement->id;
                    $transportation_charges->tribal_consolidated_id = $consolidated_id;
                    $transportation_charges->mfp_id = $row['mfp'] ?? null;
                    $transportation_charges->haat_id = $row['haat'] ?? null;
                    $transportation_charges->approx_distance = $row['approx_distance'] ?? null;
                    $transportation_charges->type_of_transport = $row['type_of_transport'] ?? null;
                    //$transportation_charges->qty = $row['qty'] ?? null;
                    $transportation_charges->charges_per_qunital = $row['charges_per_quintal'] ?? null;
                    $transportation_charges->estimated_total_cost_of_transportation = $row['total_transportation_cost'] ?? null;
                    $transportation_charges->created_by = $user_id;
                    $transportation_charges->updated_by = $user_id;
                    $transportation_charges->save();
                }
            }
            //To save service charges
            if (isset($data['service_charges']) && !empty($data['service_charges'])) {
                Overhead_service_charges::where('mfp_procurement_id', $procurement->id)->delete();
                $service_charges_mfp_agency=array();
                foreach ($data['service_charges'] as $key => $row) {
                    if(!empty($row['mfp']) && !empty($row['primary_level_agency']))
                    {
                        if(isset($service_charges_mfp_agency[$row['mfp']]) && in_array($row['primary_level_agency'], $service_charges_mfp_agency[$row['mfp']]))
                        {
                            throw new \Exception("Please select different MFP and primary level agency combination in 5. Service Charge to Primary Level Agency");
                            
                        }
                        $service_charges_mfp_agency[$row['mfp']][]=$row['primary_level_agency'];    
                    }
                    $service_charges = new Overhead_service_charges();
                    $service_charges->mfp_procurement_id = $procurement->id;
                    $service_charges->tribal_consolidated_id =$consolidated_id;
                    $service_charges->mfp_id = $row['mfp'] ?? null;
                    $service_charges->qty_of_mfp = $row['qty_of_mfp'] ?? null;
                    $service_charges->primary_level_agency = $row['primary_level_agency'] ?? null;
                    $service_charges->estimated_value_of_mfp_procurement = $row['estimated_value_of_mfp_procurement'] ?? null;
                    $service_charges->estimated_service_charge_primary_level_agency = $row['estimated_service_charges'] ?? null;
                    $service_charges->service_charge_in_total_value_of_procurement = $row['share_service_charge'] ?? null;
                    $service_charges->created_by = $user_id;
                    $service_charges->updated_by = $user_id;
                    $service_charges->save();
                }
            }

            //To save ware house labour charges
            if (isset($data['warehouse_labour_charges']) && !empty($data['warehouse_labour_charges'])) {
                Overhead_warehouse_labour_charges::where('mfp_procurement_id', $procurement->id)->delete();
                $warehouse_mfp_labour=array();
                foreach ($data['warehouse_labour_charges'] as $key => $row) {
                    if(!empty($row['mfp']) && !empty($row['warehouse']))
                    {
                        if(isset($warehouse_mfp_labour[$row['mfp']]) && in_array($row['warehouse'], $warehouse_mfp_labour[$row['mfp']]))
                        {
                            throw new \Exception("Please select different MFP and warehouse combination in warehouse labour charges section");
                            
                        }
                        $warehouse_mfp_labour[$row['mfp']][]=$row['warehouse'];    
                    }
                    $warehouse_labour_charges = new Overhead_warehouse_labour_charges();
                    $warehouse_labour_charges->mfp_procurement_id = $procurement->id;
                    $warehouse_labour_charges->tribal_consolidated_id = $consolidated_id;
                    $warehouse_labour_charges->mfp_id = $row['mfp'] ?? null;
                    $warehouse_labour_charges->warehouse_id = $row['warehouse'] ?? null;
                    $warehouse_labour_charges->qty = $row['qty'] ?? null;
                    $mfp_id = $row['mfp'];
                    $warehouse_labour_charges->unit_rate = $row['unit_rate'] ?? null;
                    $warehouse_labour_charges->total_estimated_cost = $row['total_estimated_cost'] ?? null;
                    $warehouse_labour_charges->created_by = $user_id;
                    $warehouse_labour_charges->updated_by = $user_id;
                    $warehouse_labour_charges->save();
                }
            }

            //To save ware house charges
            if (isset($data['warehouse_charges']) && !empty($data['warehouse_charges'])) {

                Overhead_warehouse_charges::where('mfp_procurement_id', $procurement->id)->delete();
                $warehouse_level_mfp_warehouse=array();
                foreach ($data['warehouse_charges'] as $key => $row) {
                    if(!empty($row['mfp']) && !empty($row['warehouse']))
                    {
                        if(isset($warehouse_level_mfp_warehouse[$row['mfp']]) && in_array($row['warehouse'], $warehouse_level_mfp_warehouse[$row['mfp']]))
                        {
                            throw new \Exception("Please select different MFP and warehouse combination in Warehouse Charges(At Warehouse Level) section");
                            
                        }
                        $warehouse_level_mfp_warehouse[$row['mfp']][]=$row['warehouse'];    
                    }
                    $warehouse_charges = new Overhead_warehouse_charges();
                    $warehouse_charges->mfp_procurement_id = $procurement->id;;
                    $warehouse_charges->tribal_consolidated_id = $consolidated_id;
                    $warehouse_charges->mfp_id = $row['mfp'] ?? null;
                    $warehouse_charges->warehouse_id = $row['warehouse'] ?? null;
                    $warehouse_charges->unit_id = $row['unit'] ?? null;
                    $warehouse_charges->unit_storage_rate = $row['unit_storage_rate'] ?? null;
                    $warehouse_charges->estimated_quantity = $row['estimated_quantity'] ?? null;
                    $warehouse_charges->total_estimated_cost = $row['total_estimated_cost'] ?? null;
                    $warehouse_charges->estimation_duration_of_storage = $row['estimated_duration_of_storage'] ?? null;
                    $warehouse_charges->from_date =  Carbon::createFromFormat('d/m/Y',$row['from_date']) ?? null;
                    $warehouse_charges->to_date =  Carbon::createFromFormat('d/m/Y',$row['to_date']) ?? null;
                    $warehouse_charges->created_by = $user_id;
                    $warehouse_charges->updated_by = $user_id;
                    $warehouse_charges->save();
                }
            }
            //To save estimated wastages
            if (isset($data['estimated_wastages']) && !empty($data['estimated_wastages'])) {
                Overhead_estimated_wastages::where('mfp_procurement_id', $procurement->id)->delete();
                $estimated_wastages_mfp_warehouse=array();
                foreach ($data['estimated_wastages'] as $key => $row) {
                    if(!empty($row['mfp']) && !empty($row['warehouse']))
                    {
                        if(isset($estimated_wastages_mfp_warehouse[$row['mfp']]) && in_array($row['warehouse'], $estimated_wastages_mfp_warehouse[$row['mfp']]))
                        {
                            throw new \Exception("Please select different MFP and warehouse combination in Estimated Wastages/Driage(As Per Norms) section");
                            
                        }
                        $estimated_wastages_mfp_warehouse[$row['mfp']][]=$row['warehouse'];    
                    }
                    $estimated_wastages = new Overhead_estimated_wastages();
                    $estimated_wastages->mfp_procurement_id = $procurement->id;
                    $estimated_wastages->tribal_consolidated_id = $consolidated_id;
                    $estimated_wastages->mfp_id = $row['mfp'] ?? null;
                    $estimated_wastages->warehouse_id = $row['warehouse'] ?? null;
                    $estimated_wastages->procurement_quantity = $row['procurement_quantity'] ?? null;
                    $estimated_wastages->procurement_value = $row['procurement_value'] ?? null;
                    $estimated_wastages->estimated_driage_rs = $row['estimated_driage_value'] ?? null;
                    $estimated_wastages->estimated_driage_percentage = $row['estimated_driage_percentage'] ?? null;
                    $estimated_wastages->created_by = $user_id;
                    $estimated_wastages->updated_by = $user_id;
                    $estimated_wastages->save();
                }
            }

            //To save estimated wastages
            if (isset($data['service_charge_at_dia']) && !empty($data['service_charge_at_dia'])) {
                Overhead_service_charges_dia::where('mfp_procurement_id', $procurement->id)->delete();
                foreach ($data['service_charge_at_dia'] as $key => $row) {
                    $service_charge_at_dia = new Overhead_service_charges_dia();
                    $service_charge_at_dia->mfp_procurement_id = $procurement->id;
                    $service_charge_at_dia->tribal_consolidated_id = $consolidated_id;
                    $service_charge_at_dia->mfp_id = $row['mfp_id'] ?? null;
                    $service_charge_at_dia->dia_id = $row['dia_id'] ?? null;
                    $service_charge_at_dia->estimated_value_of_procurement = $row['procurement_estimated_value'] ?? null;
                    $service_charge_at_dia->service_charges_percentage = $row['service_charges_percentage'] ?? null;
                    $service_charge_at_dia->service_charge_value = $row['service_charge'] ?? null;
                    $service_charge_at_dia->created_by = $user_id;
                    $service_charge_at_dia->updated_by = $user_id;
                    $service_charge_at_dia->save();
                }
            }

            //To save other costs
            if (isset($data['other_costs']) && !empty($data['other_costs'])) {
                Overhead_other_costs::where('mfp_procurement_id', $procurement->id)->delete();
                foreach ($data['other_costs'] as $key => $row) {
                    $other_costs = new Overhead_other_costs();
                    $other_costs->mfp_procurement_id = $procurement->id;
                    $other_costs->tribal_consolidated_id = $consolidated_id;;
                    $other_costs->mfp_id = $row['mfp_id'] ?? null;
                    $other_costs->other_costs = $row['other_cost'] ?? null;
                    $other_costs->remarks = $row['remarks'];
                    $other_costs->created_by = $user_id;
                    $other_costs->updated_by = $user_id;
                    $other_costs->save();
                }
            }

            


            $Overhead_collection_level=Overhead_collection_level::where('mfp_procurement_id',$procurement->id)->sum('total_cost_of_packaging_material');
            $Overhead_labour_charges=Overhead_labour_charges::where('mfp_procurement_id',$procurement->id)->sum('total_estimated_cost');
            $Overhead_weighment_charges=Overhead_weighment_charges::where('mfp_procurement_id',$procurement->id)->sum('total_estimated_cost');
            $Overhead_transportation_charges=Overhead_transportation_charges::where('mfp_procurement_id',$procurement->id)->sum('estimated_total_cost_of_transportation');
            $Overhead_service_charges=Overhead_service_charges::where('mfp_procurement_id',$procurement->id)->sum('service_charge_in_total_value_of_procurement');
            $Overhead_warehouse_labour_charges=Overhead_warehouse_labour_charges::where('mfp_procurement_id',$procurement->id)->sum('total_estimated_cost');
            $Overhead_warehouse_charges=Overhead_warehouse_charges::where('mfp_procurement_id',$procurement->id)->sum('total_estimated_cost');
            $Overhead_estimated_wastages=Overhead_estimated_wastages::where('mfp_procurement_id',$procurement->id)->sum('estimated_driage_rs');
            $Overhead_service_charges_dia=Overhead_service_charges_dia::where('mfp_procurement_id',$procurement->id)->sum('service_charge_value');
            $Overhead_other_costs=Overhead_other_costs::where('mfp_procurement_id',$procurement->id)->sum('other_costs');


            $total_overhead_paid_value=$Overhead_collection_level + $Overhead_labour_charges + $Overhead_weighment_charges+$Overhead_transportation_charges+$Overhead_service_charges+$Overhead_warehouse_labour_charges+$Overhead_warehouse_charges+$Overhead_estimated_wastages+$Overhead_service_charges_dia+$Overhead_other_costs;
            $procurement->total_overhead_paid_value=$total_overhead_paid_value;
            $procurement->save();   


            /*
            get total released to PA
            then check if total amount is not greater than total released amount of PA
            */
            //$total_released_to_procurement_agent_by_dia=$procurement->getDiaReleasedToProcurementsAgent->sum('total_released_to_procurement_agent');
            $total_released_to_procurement_agent_by_dia=FundHelper::getFundAvailableAtPa();

            $total_amount_released_to_pa=$procurement->actual_tribal_amount_paid + $procurement->total_mfp_storage_value+$procurement->total_overhead_paid_value;

			//$total_amount_released_to_pa=$procurement->actual_tribal_amount_paid + $procurement->total_mfp_storage_value+$procurement->total_overhead_paid_value;
            
            $balance_can_pay=$total_released_to_procurement_agent_by_dia - $total_amount_released_to_pa;

            $actual_tribal_amount_paid=$procurement->actual_tribal_amount_paid;
            $total_mfp_storage_value=$procurement->total_mfp_storage_value;
            $total_overhead_paid_value=$procurement->total_overhead_paid_value;

            

            $commission_data=FundHelper::getCommission($total_amount_released_to_pa);

            $commission_amount=$commission_data['commission_amount'];
            $commission_rate=$commission_data['commission_rate'];
            
            
            //echo $total_released_to_procurement_agent_by_dia;die;
            //echo $max_can_expend;die;

            $remaining_amount=$total_amount_released_to_pa-$commission_amount;

            //echo $total_amount_released_to_pa;die;
            /*if($procurement->total_overhead_paid_value > $total_fund_available)
            {
                throw new \Exception("You are using in overhead $total_overhead_paid_value,You have used in actual tribal detail $actual_tribal_amount_paid,You have used in MFP storage $total_mfp_storage_value which is greater than Available amount i.e $total_fund_available");
            }*/
            $total_fund=$total_amount_released_to_pa+$total_released_to_procurement_agent_by_dia;
            $max_can_expend=$total_fund-(($total_fund*$commission_rate)/100);
           // throw new \Exception('$max_can_expend':$max_can_expend)  
            //echo $max_can_expend;die;
            if($total_amount_released_to_pa > $max_can_expend)
            {
                throw new \Exception("You are using in overhead $total_overhead_paid_value,You have used in actual tribal detail $actual_tribal_amount_paid,You have used in MFP storage $total_mfp_storage_value.You can not release more than $max_can_expend because your commision amount will be $commission_amount");   
            }
            
            $transaction = new Mfp_procurement_transaction();
            $transaction->transaction_id = time();
            $transaction->consolidated_id = $consolidated_id;
            $transaction->mfp_procurement_id = $procurement->id;
            //$transaction->commission_amount = $commission_amount;
            //$transaction->commission_rate = $commission_rate;
            $transaction->created_by = $user_id;
            $transaction->updated_by = $user_id;
            $transaction->save();
            
            DB::commit();

            return Mfp_procurement::where([
                'id' => $procurement->id
            ])->firstOrFail();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

   

    /**
     * Validates for creating a record.
     *
     * @param Array $data
     * @return mixed
     */
    public function validateCreate($data)
    {
        $required = 'nullable';
        if (isset($data['submit_type']) && $data['submit_type'] == 'submit') {
            $required = 'required';
        }

        $messages = $this->validation_messages($data);
        //$max=$this->getMaxQty($data);
        //dd($max);
        return Validator::make(
            $data,
            [
                'form_id' => 'nullable|exists:mfp_procurement,ref_id',
                'cons_id' =>  'required',
                // 'submit_type'=> 'required',
                'collection_level.*.mfp_id' => [
                    $required, 'exists:mfp_master,id'
                ],
                'collection_level.*.qty' => [
                    $required, 'numeric'
                ],
                'collection_level.*.corresponding_haat.*' => [
                   'required', 'exists:haat_bazaar_master,id'
                ],
                // 'collection_level.*.warehouse' => [
                //     $required, 'exists:warehouse_master,id'
                // ],
                'collection_level.*.capacity' => [
                    $required, 'numeric'
                ],
                'collection_level.*.procurement_center' => [
                    $required,
                ],
                'collection_level.*.packing_material_type' => [
                    $required, 'exists:packing_master,id'
                ],
                // 'collection_level.*.standard_packing' => [
                //     $required,
                // ],
                // 'collection_level.*.category' => [
                //     $required,
                // ],
                'collection_level.*.size' => [
                    $required,
                ],
                'collection_level.*.total_packing_bags' => [
                    $required, 'numeric'
                ],
                'collection_level.*.unit_cost' => [
                    $required, 'numeric'
                ],
                'collection_level.*.total_cost_of_packaging_material' => [
                    $required, 'numeric'
                ],
                //weightment charges
                 'weightment_charges.*.mfp' => [
                    $required,'exists:mfp_master,id',
                ],
                'weightment_charges.*.type' => [
                    $required,'in:H,P'
                ],
                'weightment_charges.*.haat_id' => [
                    'nullable','required_if:weightment_charges.*.type,H','exists:haat_bazaar_master,id'
                ],
                'weightment_charges.*.procurement_center_id' => [
                    'nullable','required_if:weightment_charges.*.type,P'
                ],
                'weightment_charges.*.total_estimated_cost' => [
                    $required,'numeric',
                ],
                //labour charges
                'labour_charges.*.mfp' => [
                    $required, 'exists:mfp_master,id', 
                ],
                'labour_charges.*.haat' => [
                    $required,
                ],
                'labour_charges.*.unit_manday_rate' => [
                    $required, 'numeric',
                ],
                'labour_charges.*.estimated_mandays' => [
                    $required, 'numeric',
                ],
                'labour_charges.*.total_estimated_cost' => [
                    $required, 'numeric',
                ],

                //transportation charges
                'transportation_charges.*.mfp' => [
                    $required, 'exists:mfp_master,id', 
                ],
                'transportation_charges.*.haat' => [
                    $required,
                ],
                'transportation_charges.*.approx_distance' => [
                    $required, 'numeric',
                ],
                'transportation_charges.*.type_of_transport' => [
                    $required, 'numeric',
                ],
                // 'transportation_charges.*.qty' => [
                //     $required, 'numeric',
                // ],
                'transportation_charges.*.charges_per_quintal' => [
                    $required, 'numeric',
                ],
                'transportation_charges.*.total_transportation_cost' => [
                    $required, 'numeric',
                ],
                //service charges
                'service_charges.*.mfp' => [
                    $required, 'exists:mfp_master,id', 
                ],
                'service_charges.*.qty_of_mfp' => [
                    $required, 'numeric',
                ],
                'service_charges.*.primary_level_agency' => [
                    $required, 'numeric',
                ],
                'service_charges.*.estimated_value_of_mfp_procurement' => [
                    $required, 'numeric',
                ],
                'service_charges.*.estimated_service_charges' => [
                    $required, 'numeric',
                ],
                'service_charges.*.share_service_charge' => [
                    $required, 'numeric',
                ],
                //warehouse labour charges
                'warehouse_labour_charges.*.mfp' => [
                    $required, 'exists:mfp_master,id', 
                ],
                'warehouse_labour_charges.*.warehouse' => [
                    $required,
                ],
                'warehouse_labour_charges.*.qty' => [
                    $required, 'numeric',
                ],
                'warehouse_labour_charges.*.unit_rate' => [
                    $required, 'numeric',
                ],
                'warehouse_labour_charges.*.total_estimated_cost' => [
                    $required, 'numeric',
                ],
                //overheads warehouse charges 
                'warehouse_charges.*.mfp' => [
                    $required, 'exists:mfp_master,id', 
                ],
                'warehouse_charges.*.warehouse' => [
                    $required,
                ],
                'warehouse_charges.*.unit' => [
                    $required, 'numeric'
                ],
                'warehouse_charges.*.unit_storage_rate' => [
                    $required, 'numeric',
                ],
                'warehouse_charges.*.estimated_quantity' => [
                    $required, 'numeric',
                ],
                'warehouse_charges.*.total_estimated_cost' => [
                    $required, 'numeric',
                ],
                'warehouse_charges.*.estimated_duration_of_storage' => [
                    $required, 'numeric',
                ],
                'warehouse_charges.*.from_date' => [
                    $required, 'date_format:d/m/Y',
                ],
                'warehouse_charges.*.to_date' => [
                    $required, 'date_format:d/m/Y',
                ],
                //overheads estimated wastages
                'estimated_wastages.*.mfp' => [
                    $required, 'exists:mfp_master,id', 
                ],
                'estimated_wastages.*.warehouse' => [
                    $required,
                ],
                'estimated_wastages.*.procurement_quantity' => [
                    $required, 'numeric'
                ],
                'estimated_wastages.*.procurement_value' => [
                    $required, 'numeric'
                ],
                'estimated_wastages.*.estimated_driage_percentage' => [
                    $required,'numeric'
                ],
                'estimated_wastages.*.estimated_driage_value' => [
                    $required, 'numeric'
                ],
                //service charges at dia
                'service_charge_at_dia.*.mfp_id' => [
                    $required, 'exists:mfp_master,id', 
                ],
                'service_charge_at_dia.*.dia_id' => [
                    $required,
                ],
                'service_charge_at_dia.*.procurement_estimated_value' => [
                    $required, 'numeric',
                ],
                'service_charge_at_dia.*.service_charges_percentage' => [
                    $required, 'numeric',
                ],
                'service_charge_at_dia.*.service_charge' => [
                    $required, 'numeric',
                ],
                //overheads other costs
                'other_costs.*.mfp_id' => [
                    $required, 'exists:mfp_master,id', 
                ],
                'other_costs.*.other_cost' => [
                    $required,'numeric',
                ],
                'other_costs.*.remarks' => [
                    $required,
                ],




            ],
            $messages

        );
    }

    public function validation_messages($data)
    {
        //$max = $this->getMaxQty($data);
        $messages = array();
        
        $j = 0;
        if (!empty($data['transportation_charges'])) {
            foreach ($data['transportation_charges'] as $key => $row) {
                ++$j;
                $row_message = " in " . $this->ordinal_suffix($j) . " record";
                $messages['transportation_charges.' . $key . '.qty.required'] = "Please enter qty in transportation charges $row_message";
                // $messages['transportation_charges.' . $key . '.qty.max'] = "Transportation charges qunatity  $row_message may not greater than $max";
              
            }
        }
        $k = 0;
        if (!empty($data['labour_charges'])) {
            foreach ($data['labour_charges'] as $key => $row) {
                ++$k;
                $row_message = " in " . $this->ordinal_suffix($k) . " record";
                $messages['labour_charges.' . $key . '.mfp.required'] = "Please select MFP in labour charges $row_message";
                $messages['labour_charges.' . $key . '.mfp.distinct'] = "Please select unique MFP in labour charges $row_message";
              
            }
        }

        $l = 0;
        if (!empty($data['warehouse_labour_charges'])) {
            foreach ($data['warehouse_labour_charges'] as $key => $row) {
                ++$l;
                $row_message = " in " . $this->ordinal_suffix($l) . " record";
                $messages['warehouse_labour_charges.' . $key . '.mfp.required'] = "Please select MFP in warehouse labour charges $row_message";
                $messages['warehouse_labour_charges.' . $key . '.mfp.distinct'] = "Please select unique MFP in warehouse labour charges $row_message";
              
            }
        }
        $m = 0;
        if (!empty($data['warehouse_charges'])) {
            foreach ($data['warehouse_charges'] as $key => $row) {
                ++$m;
                $row_message = " in " . $this->ordinal_suffix($m) . " record";
                $messages['warehouse_charges.' . $key . '.mfp.required'] = "Please select MFP in warehouse charges $row_message";
                $messages['warehouse_charges.' . $key . '.mfp.distinct'] = "Please select unique MFP in warehouse charges $row_message";
                $messages['warehouse_charges.' . $key . '.unit_storage_rate.numeric'] = "Please enter numeric value for unit storage rate in warehouse charges $row_message";
                $messages['warehouse_charges.' . $key . '.estimated_quantity.numeric'] = "Please enter numeric value for estimated quantity in warehouse charges $row_message";
                $messages['warehouse_charges.' . $key . '.total_estimated_cost.numeric'] = "Please enter numeric value for total estimated cost in warehouse charges $row_message";
              
            }
        }
        $n = 0;
        if (!empty($data['estimated_wastages'])) {
               foreach ($data['estimated_wastages'] as $key => $row) {
                ++$n;
                $row_message = " in " . $this->ordinal_suffix($n) . " record";
                $messages['estimated_wastages.' . $key . '.mfp.required'] = "Please select MFP in estimated wastages $row_message";
                $messages['estimated_wastages.' . $key . '.mfp.distinct'] = "Please select unique MFP in estimated wastages $row_message";
                $messages['estimated_wastages.' . $key . '.estimated_driage_percentage.numeric'] = "Please enter numeric value in estimated wastages at DIA $row_message";
                $messages['estimated_wastages.' . $key . '.estimated_driage_value.numeric'] = "Please enter numeric value in estimated wastages at DIA $row_message";
              
            }
        }
        $p = 0 ;
        if (!empty($data['service_charge_at_dia'])) {
               foreach ($data['service_charge_at_dia'] as $key => $row) {
                ++$p;
                $row_message = " in " . $this->ordinal_suffix($p) . " record";
                $messages['service_charge_at_dia.' . $key . 'mfp_id.required'] = "Please select MFP in sevice charges at DIA $row_message";
                $messages['service_charge_at_dia.' . $key . '.service_charges_percentage.numeric'] = "Please enter numeric value in sevice charges at DIA $row_message";
            }
        }

        $q = 0 ;
        if (!empty($data['other_costs'])) {
               foreach ($data['other_costs'] as $key => $row) {
                ++$q;
                $row_message = " in " . $this->ordinal_suffix($q) . " record";
                $messages['other_costs.' . $key . '.mfp_id.required'] = "Please select MFP in other costs $row_message";
                $messages['other_costs.' . $key . '.other_cost.numeric'] = "Please enter numeric value in other costs $row_message";
            }
        }

        return $messages;
    }



    // public function getMaxQty($data){
    //     foreach ($data['transportation_charges'] as $key => $row) 
    //     {   
    //         $form_id = $data['form_id'];
    //         $mfp_id = $row['mfp'];
    //         $procurement = Mfp_procurement::where('ref_id', $form_id)->firstOrFail();
    //         $qty =  Mfp_seasonality_commodity::where('mfp_procurement_id',$procurement->id)->where('mfp_id', $mfp_id)->get()->sum('qty');    
    //          return $qty;
    //     }
    // }
    
    
    
    
    public function getSeasionalityQuarterWise($item)
    {
        $data = array();

        $quarter_arr = array(
            1 => 'Quarter 1',
            2 => 'Quarter 1',
            3 => 'Quarter 1',
            4 => 'Quarter 2',
            5 => 'Quarter 2',
            6 => 'Quarter 2',
            7 => 'Quarter 3',
            8 => 'Quarter 3',
            9 => 'Quarter 3',
            10 => 'Quarter 4',
            11 => 'Quarter 4',
            12 => 'Quarter 4',
        );
        $quarter_data = array();
        if (isset($item['mfp_seasonality']) && !empty($item['mfp_seasonality'])) {
            foreach ($item['mfp_seasonality'] as $key => $row) {
                if (isset($row['haat_id']) && !empty($row['haat_id'])) {
                    $haat_id = $row['haat_id'];
                    if (isset($row['haat_data']['get_haat_bazaar_detail']['get_part_one']['rpm_name']) && !empty($row['haat_data']['get_haat_bazaar_detail']['get_part_one']['rpm_name'])) {
                        $haat_name[$haat_id] = $row['haat_data']['get_haat_bazaar_detail']['get_part_one']['rpm_name'];
                        if (isset($row['commodity_data']) && !empty($row['commodity_data'])) {

                            foreach ($row['commodity_data'] as $key => $commodity) {
                                if (isset($commodity['mfp_id']) && !empty($commodity['mfp_id'])) {
                                    $mfp_id = $commodity['mfp_id'];
                                    if (isset($commodity['getMfp']['get_mfp_name']['title']) && !empty($commodity['getMfp']['get_mfp_name']['title'])) {
                                        $mfp_name[$mfp_id] = $commodity['getMfp']['get_mfp_name']['title'];
                                        $qty = $commodity['qty'];
                                        $value = $commodity['value'];
                                        $months = $commodity['month'];
                                        if (!empty($months)) {
                                            foreach ($months as $key => $month) {
                                                $month_id = $month['month'];
                                                $quarter = $quarter_arr[$month_id];
                                                if (isset($quarter_data[$haat_id][$mfp_id][$quarter]['qty'])) {

                                                    $quarter_data[$haat_id][$mfp_id][$quarter]['qty'] = $quarter_data[$haat_id][$mfp_id][$quarter]['qty'] + $qty;
                                                } else {
                                                    $quarter_data[$haat_id][$mfp_id][$quarter]['qty'] = $qty;
                                                }
                                                if (isset($quarter_data[$haat_id][$mfp_id][$quarter]['value'])) {

                                                    $quarter_data[$haat_id][$mfp_id][$quarter]['value'] = $quarter_data[$haat_id][$mfp_id][$quarter]['value'] + $value;
                                                } else {
                                                    $quarter_data[$haat_id][$mfp_id][$quarter]['value'] = $value;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $data = array();
        if (!empty($quarter_data)) {
            foreach ($quarter_data as $haat_key => $haat) {


                foreach ($haat as $mfp_key => $mfp) {
                    foreach ($mfp as $quarter_key => $value) {
                        $data[] = array(
                            'haat_id' => $haat_key,
                            'haat_name' => $haat_name[$haat_key],
                            'mfp_id' => $mfp_key,
                            'mfp_name' => $mfp_name[$mfp_key],
                            'quarter' => $quarter_key,
                            'qty' => $value['qty'],
                            'value' => $value['value'],
                        );
                    }
                }
            }
        }

        return $data;
    }

    public function getEstimatedValueOfProcurement($ref_id, $mfp_id)
    {
        $procurement = Mfp_procurement::where('ref_id', $ref_id)->firstOrFail();

        $qty =  Mfp_procurement_commodity::where('mfp_procurement_id', $procurement->id)->where('commodity_id', $mfp_id)->get()->sum('currentqty');

        $msp_price = Mfp::where('id', $mfp_id)->first()->msp_price;
        //change msp price from kg to mt
        return $qty * ($msp_price*1000); 
    }

    public function getProcurementQtyValue($ref_id, $mfp_id)
    {
        $procurement = Mfp_procurement::where('ref_id', $ref_id)->firstOrFail();
        $qty =  Mfp_procurement_commodity::where('mfp_procurement_id', $procurement->id)->where('commodity_id', $mfp_id)->get()->sum('currentqty');
        
        $msp_price = Mfp::where('id', $mfp_id)->first()->msp_price;
        //echo $msp_price;die;
        $data['qty'] = $qty;
        $data['value'] = $qty  * ($msp_price*1000);
        return $data;
    }


    public function getResourceData($item)
    {
        $item=json_encode($item);
        $array=  collect(json_decode($item,true));
        return $array->toArray(); 
    }

    public function getCostOfPackagingMaterial($id)
    {
        $user = Auth ::user();
        $final_array = array();
        $qty_arr = array();
        $procurement = Mfp_procurement::where('ref_id', $id)->firstOrFail();
        //Get released mfp details for this proposal
        $proposal_realease_details= Mfp_procurement_dia_release::with(['commodity_details'])->where(['mfp_procurement_id'=>$procurement->id,'procurement_agent'=>$user->id])->get();
        $realeasedMfp = [];
        //dd($proposal_realease_details);
        foreach($proposal_realease_details as $released_row){
            foreach($released_row->commodity_details as $mfp_details){
                $realeasedMfp[] = $mfp_details->mfp_id;
            }
        }
        //dd($realeasedMfp);
        $item = MfpSeasionalityQuarterWiseResource::make($procurement);
        //dd($item);
        $item = $this->getResourceData($item);
       
        if (isset($item['mfp_seasonality']) && !empty($item['mfp_seasonality'])) {
            foreach ($item['mfp_seasonality'] as $key => $row) {
                if (isset($row['haat_id']) && !empty($row['haat_id'])) {
                    $haat_id = $row['haat_id'];
                    if (isset($row['haat_data']['get_haat_bazaar_detail']['get_part_one']['rpm_name']) && !empty($row['haat_data']['get_haat_bazaar_detail']['get_part_one']['rpm_name'])) {
                        $haat_name[$haat_id] = $row['haat_data']['get_haat_bazaar_detail']['get_part_one']['rpm_name'];
                      
                        if (isset($row['commodity_data']) && !empty($row['commodity_data'])) {

                            foreach ($row['commodity_data'] as $key => $commodity) {
                                if (isset($commodity['mfp_id']) && !empty($commodity['mfp_id'])) {
                                    $mfp_id = $commodity['mfp_id'];
                                        $qty = $commodity['qty'];
                                        $months = $commodity['month'];
                                        $mfp_haat[$mfp_id][] = $haat_id;
                                        if (!empty($months)) {
                                            foreach ($months as $key => $month) {
                                                if (isset($qty_arr[$mfp_id])) {
                                                    $qty_arr[$mfp_id] = $qty_arr[$mfp_id]+ $qty;
                                                } else {
                                                    $qty_arr[$mfp_id] = $qty;
                                                }
                                            }
                                        }
                                
                                }
                            }
                        }
                    }
                }
            }
        }

        $storage_plan_data = Mfp_procurement_storage::where('mfp_procurement_id', $procurement->id)->get();
        //get Mfp wise haats


        if (!empty($storage_plan_data)) {
            foreach ($storage_plan_data as $key => $plan) {
                if(in_array($plan->mfp_name,$realeasedMfp)){
                    $collection_data = Mfp_procurement_collection_level::where(['mfp_procurement_id' => $procurement->id, 'mfp_id' => $plan->mfp_name])->first();
                    $procure_data = Mfp_procurement_dia_release_commodity::where(['mfp_procurement_id' => $procurement->id, 'procurement_agent' => Auth::user()->id, 'mfp_id' => $plan->mfp_name])->get(); 
    
                     $data=array(); 
                    foreach ($procure_data as $value) {
                        if(isset($data[$value['mfp_id']]))
                        {
                            $data[$value['mfp_id']]['qty']   = $data[$value['mfp_id']]['qty']+$value['qty'];
                            $data[$value['mfp_id']]['value']   = $data[$value['mfp_id']]['value']+$value['value'];
                        }else{
                            $data[$value['mfp_id']]=array( 
                            'qty' => $value['qty'],
                            'value' => $value['value'],
                            );
                        }         
                    }  
                    $final_array[] = array(
                        'mfp_id' => $plan->mfp_name,
                        'mfp_qty' => $data[$plan->mfp_name]['qty']?? 0,
                        'qty' =>  $qty_arr[$plan->mfp_name] ?? 0,
                        'haat' => $mfp_haat[$plan->mfp_name] ?? 0,
                        'capacity' => $collection_data->capacity ?? $plan->storage_capacity,
                        'procurement_center' => $collection_data->procurement_center ?? null,
                        'packing_material_type' => $collection_data->packing_material_type ?? null,
                        'size' => $collection_data->size ?? null,
                        'total_packing_bags' => $collection_data->total_packing_bags ?? 0,
                        'unit_cost' => $collection_data->unit_cost ?? 0,
                        'total_cost_of_packaging_material' => $collection_data->total_cost_of_packaging_material ?? 0,
                    );
                }
              
            }
        }
        return $final_array;
    }

    public function getListing($request){
        $columns = array(
            0 => 'id',
        );
        DB::connection()->enableQueryLog();
        $limit = isset($request['length']) ? $request['length'] : 10;
        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 'id';
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC';
        $query = $this->actualOverheadQuery->viewAllQuery();
        $query = $query->orderBy($order,$dir);
        if (isset($request['proposal_id']) && $request['proposal_id']!='') {
            $query->where('proposal_id', 'LIKE', "%".$request['proposal_id']."%");
        }
       
        if (isset($request['page']) && !empty($request['page'])) {
            return $query->paginate($limit);
        } else {
            return $query->get();
        }
       
    }

    public function switchStatus($id){
        $model = Actual_overhead::where([
            'id' => $id
        ])->firstOrFail();
        $model->switchStatus();
        $model->save();
        return $model->status;
    }

    
}
