<?php

namespace App\Services\Proposals;

use App\Models\Masters\Mfp;
use App\Models\Proposals\Mfp_procurement;
use App\Models\Proposals\Mfp_procurement_disposal;
use App\Models\Proposals\Mfp_procurement_disposal_warehouse;
use App\Models\Proposals\Mfp_procurement_disposal_warehouse_months;
use App\Models\Proposals\Mfp_coverage;
use App\Models\Proposals\Mfp_procurement_commodity;
use App\Models\Proposals\Mfp_procurement_estimated_losses;
use App\Models\Proposals\Mfp_procurement_collection_level;
use App\Models\Proposals\Mfp_procurement_warehouse_labour_charges;
use App\Models\Proposals\Mfp_procurement_labour_charges;
use App\Models\Proposals\Mfp_procurement_weightment_charges;
use App\Models\Proposals\Mfp_procurement_transportation_charges;
use App\Models\Proposals\Mfp_procurement_service_charges;
use App\Models\Proposals\Mfp_procurement_warehouse_charges;
use App\Models\Proposals\Mfp_procurement_estimated_wastages;
use App\Models\Proposals\Mfp_procurement_service_charges_at_dia;
use App\Models\Proposals\Mfp_procurement_other_costs;
use App\Models\Proposals\Mfp_procurement_collection_level_haat;
use App\Models\Proposals\Mfp_seasonality_commodity;
use App\Services\Service;
use App\Queries\ProcurementQuery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use DB;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Validation\ValidationException;
class MfpProcurementDisposalService extends Service
{
    private $procurementQuery;

    public function __construct(ProcurementQuery $procurementQuery = null)
    {
        $this->procurementQuery = $procurementQuery;
    }


    /**
     * Creates a new item in table
     *
     * @param Array $data
     * @return mixed
     */
    public function createItem($data)
    {
        DB::beginTransaction();
        try {

            $user_id = Auth::user()->id;
            if (isset($data['submit_type']) && $data['submit_type'] == 'submit') {
                $is_draft = '0';
            } else {
                $is_draft = '1';
            }
            $procurement = Mfp_procurement::where('ref_id', $data['form_id'])->firstOrFail();
            Mfp_procurement_disposal::where('mfp_procurement_id', $procurement->id)->delete();
            Mfp_procurement_disposal_warehouse::where('mfp_procurement_id', $procurement->id)->delete();
            Mfp_procurement_disposal_warehouse_months::where('mfp_procurement_id', $procurement->id)->delete();
            if (isset($data['mfp_disposal_form']) && !empty($data['mfp_disposal_form'])) {

                foreach ($data['mfp_disposal_form'] as $key => $row) {

                    $mfp_disposal = new Mfp_procurement_disposal();

                    $mfp_disposal->mfp_procurement_id = $procurement->id;
                    $mfp_disposal->mfp_id = isset($row['mfp_id']) ? $row['mfp_id'] : null;
                    $mfp_disposal->created_by = $user_id;
                    $mfp_disposal->updated_by = $user_id;
                    $mfp_disposal->save();

                    $warehouse_data = array();
                    if (isset($row['warehouse_id']) && !empty($row['warehouse_id'])) {

                        foreach ($row['warehouse_id'] as $warehouse_key => $warehouse) {

                            $mfp_procurement_disposal_warehouse = Mfp_procurement_disposal_warehouse();

                            $mfp_procurement_disposal_warehouse->mfp_procurement_id = $procurement->id;
                            $mfp_procurement_disposal_warehouse->mfp_procurement_disposal_id = $mfp_disposal->id;
                            $mfp_procurement_disposal_warehouse->warehouse_id = $warehouse;
                            $mfp_procurement_disposal_warehouse->qty = isset($row['qty'][$warehouse_key]) ? $row['qty'][$warehouse_key] : null;
                            $mfp_procurement_disposal_warehouse->value = isset($row['value'][$warehouse_key]) ? $row['value'][$warehouse_key] : null;
                            $mfp_procurement_disposal_warehouse->created_by = $user_id;
                            $mfp_procurement_disposal_warehouse->updated_by = $user_id;
                            $mfp_procurement_disposal_warehouse->save();
                            if (isset($row['month'][$warehouse_key]) && !empty($row['month'][$warehouse_key])) {

                                foreach ($row['month'][$warehouse_key] as $key => $month) {
                                    $mfp_procurement_disposal_warehouse_months = new Mfp_procurement_disposal_warehouse_months();

                                    $mfp_procurement_disposal_warehouse_months->mfp_procurement_id = $procurement->id;

                                    $mfp_procurement_disposal_warehouse_months->mfp_procurement_disposal_id = $mfp_disposal->id;

                                    $mfp_procurement_disposal_warehouse_months->mfp_procurement_disposal_warehouse_id = $mfp_procurement_disposal_warehouse->id;
                                    $mfp_procurement_disposal_warehouse_months->month = $month;

                                    $mfp_procurement_disposal_warehouse_months->created_by = $user_id;

                                    $mfp_procurement_disposal_warehouse_months->updated_by = $user_id;

                                    $mfp_procurement_disposal_warehouse_months->save();
                                }
                            }
                        }
                    }
                }
            }


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
     * Get a single item from database
     *
     * @param number $id
     * @return mixed
     */
    public function getOne($id)
    {
        return Mfp_procurement::where('ref_id', $id)->firstOrFail();
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

            $user_id = Auth::user()->id;
            $procurement = Mfp_procurement::where('ref_id', $data['form_id'])->firstOrFail();
            if (isset($data['submit_type']) && $data['submit_type'] == 'submit') {
                $is_draft = '0';
                $procurement->is_step3_complete = 1;  
                $procurement->save();  
            } else {
                $is_draft = '1';
            }
            $mfp_seasonality_commodity=Mfp_seasonality_commodity::where(['mfp_procurement_id' => $procurement->id])->get();
            $mfp_seasonality_mfp_qty=array();
            if(!empty($mfp_seasonality_commodity))
            {
                foreach ($mfp_seasonality_commodity as $key => $seasonality) {
                    if(isset($mfp_seasonality_mfp_qty[$seasonality->mfp_id]))
                    {
                           $mfp_seasonality_mfp_qty[$seasonality->mfp_id]=$mfp_seasonality_mfp_qty[$seasonality->mfp_id]+$seasonality->qty;     
                    }else{
                        $mfp_seasonality_mfp_qty[$seasonality->mfp_id]=$seasonality->qty;
                    }
                }    
            }
            Mfp_procurement_disposal::where('mfp_procurement_id', $procurement->id)->delete();
            Mfp_procurement_disposal_warehouse::where('mfp_procurement_id', $procurement->id)->delete();
            Mfp_procurement_disposal_warehouse_months::where('mfp_procurement_id', $procurement->id)->delete();
            if (isset($data['mfp_disposal_form']) && !empty($data['mfp_disposal_form'])) {
                foreach ($data['mfp_disposal_form'] as $key => $row) {

                    $mfp_disposal = new Mfp_procurement_disposal();

                    $mfp_disposal->mfp_procurement_id = $procurement->id;
                    $mfp_id=isset($row['mfp_id']) ? $row['mfp_id'] : null;
                    $mfp_disposal->mfp_id = isset($row['mfp_id']) ? $row['mfp_id'] : null;
                    $mfp_disposal->created_by = $user_id;
                    $mfp_disposal->updated_by = $user_id;
                    $mfp_disposal->save();

                    $warehouse_data = array();
                    $mfp_disposal_mfp_qty=array();
                    if (isset($row['warehouse_id']) && !empty($row['warehouse_id'])) {
                        foreach ($row['warehouse_id'] as $warehouse_key => $warehouse) {

                            if(isset($mfp_disposal_mfp_qty[$mfp_id]))
                            {
                                $mfp_disposal_mfp_qty[$mfp_id]=$mfp_disposal_mfp_qty[$mfp_id]+$row['qty'][$warehouse_key];     
                            }else{
                                $mfp_disposal_mfp_qty[$mfp_id]=$row['qty'][$warehouse_key];
                            }    
                            $mfp_procurement_disposal_warehouse = new Mfp_procurement_disposal_warehouse();

                            $mfp_procurement_disposal_warehouse->mfp_procurement_id = $procurement->id;
                            $mfp_procurement_disposal_warehouse->mfp_procurement_disposal_id = $mfp_disposal->id;
                            $mfp_procurement_disposal_warehouse->warehouse_id = $warehouse;
                            $mfp_procurement_disposal_warehouse->qty = isset($row['qty'][$warehouse_key]) ? $row['qty'][$warehouse_key] : null;
                            $mfp_procurement_disposal_warehouse->value = isset($row['value'][$warehouse_key]) ? $row['value'][$warehouse_key] : null;
                            $mfp_procurement_disposal_warehouse->created_by = $user_id;
                            $mfp_procurement_disposal_warehouse->updated_by = $user_id;
                            $mfp_procurement_disposal_warehouse->save();
                            if (isset($row['month'][$warehouse_key]) && !empty($row['month'][$warehouse_key])) {

                                foreach ($row['month'][$warehouse_key] as $key => $month) {
                                    $mfp_procurement_disposal_warehouse_months = new Mfp_procurement_disposal_warehouse_months();

                                    $mfp_procurement_disposal_warehouse_months->mfp_procurement_id = $procurement->id;

                                    $mfp_procurement_disposal_warehouse_months->mfp_procurement_disposal_id = $mfp_disposal->id;

                                    $mfp_procurement_disposal_warehouse_months->mfp_procurement_disposal_warehouse_id = $mfp_procurement_disposal_warehouse->id;
                                    $mfp_procurement_disposal_warehouse_months->month = $month;

                                    $mfp_procurement_disposal_warehouse_months->created_by = $user_id;

                                    $mfp_procurement_disposal_warehouse_months->updated_by = $user_id;

                                    $mfp_procurement_disposal_warehouse_months->save();
                                }
                            }
                        }
                    }
                    
                    if(isset($mfp_disposal_mfp_qty[$mfp_id]) && isset($mfp_seasonality_mfp_qty[$mfp_id]))
                    {
                        if($mfp_disposal_mfp_qty[$mfp_id] > $mfp_seasonality_mfp_qty[$mfp_id])
                        {
                            
                            $quantity=$mfp_seasonality_mfp_qty[$mfp_id];
                            $mfp_data=Mfp::where('id',$mfp_id)->first();
                            $mfp_name=$mfp_data->getMfpName->title;
                            $quantity_errors[]="Please do not enter quantity of $mfp_name more than $quantity in MFP Disposal Plan (Tentative) section";
                            //throw new \Exception("Please do not enter quantity of $mfp_name more than $quantity in MFP Disposal Plan (Tentative) section");      
                        }    
                    }
                }
            }
            //===============Estimated Losses=======================
            $mfp_est_losses_mfp_qty=array();
            if (isset($data['estimated_losses']) && !empty($data['estimated_losses'])) {
                
                foreach ($data['estimated_losses'] as $key => $row) {
                    $mfp_coverage = Mfp_coverage::where(['id' => $row['row_id'], 'mfp_id' => $row['mfp_id']])->firstOrFail();
                    $mfp_coverage->previous_year_estimated_qty = $row['previous_year_estimated_qty'];
                    $mfp_coverage->previous_year_estimated_value = $row['previous_year_estimated_value'];
                    $mfp_coverage->previous_year_actual_qty = $row['previous_year_actual_qty'];
                    $mfp_coverage->previous_year_actual_estimated_qty = $row['previous_year_actual_estimated_qty'];
                    $mfp_coverage->current_year_estimated_qty = $row['current_year_estimated_qty'];
                    $mfp_coverage->current_year_estimated_value = $row['current_year_estimated_value'];
                    $mfp_coverage->save();
                    $mfp_id=$row['mfp_id'];
                    
                    if(isset($mfp_seasonality_mfp_qty[$mfp_id]))
                        {
                            if($row['current_year_estimated_qty'] > $mfp_seasonality_mfp_qty[$mfp_id])
                            {
                                
                                $quantity=$mfp_seasonality_mfp_qty[$mfp_id];
                                $mfp_data=Mfp::where('id',$mfp_id)->first();
                                $mfp_name=$mfp_data->getMfpName->title;
                                $quantity_errors[]="Please do not enter quantity of $mfp_name more than $quantity in estimated losses section";
                                //throw new \Exception("Please do not enter quantity of $mfp_name more than $quantity in estimated losses section");      
                            }
                        }
                    if( $data['submit_type'] == 'submit'){
                         //save current year data
                        $estimated_loss_history = new Mfp_procurement_estimated_losses();
                        $estimated_loss_history->mfp_procurement_id = $procurement->id;
                        $estimated_loss_history->year_id = $procurement->year_id;
                        $estimated_loss_history->mfp_id = $row['mfp_id'];
                        $estimated_loss_history->qty = $row['current_year_estimated_qty'];
                        $estimated_loss_history->value = $row['current_year_estimated_value'];
                        $estimated_loss_history->created_by = $user_id;
                        $estimated_loss_history->updated_by = $user_id;
                        $estimated_loss_history->save();
                        
                        //save last year data
                        $estimated_loss_history = new Mfp_procurement_estimated_losses();
                        $estimated_loss_history->mfp_procurement_id = $procurement->id;
                        $estimated_loss_history->year_id = $procurement->year_id - 1;
                        $estimated_loss_history->mfp_id = $row['mfp_id'];
                        $estimated_loss_history->qty = $row['previous_year_estimated_qty'];
                        $estimated_loss_history->value = $row['previous_year_estimated_value'];
                        $estimated_loss_history->created_by = $user_id;
                        $estimated_loss_history->updated_by = $user_id;
                        $estimated_loss_history->save();
                    }
                   
                }
            }

            
            //=====================Save Packaging cost material=================================
            if (isset($data['collection_level']) && !empty($data['collection_level'])) {
                Mfp_procurement_collection_level::where(['mfp_procurement_id' => $procurement->id])->delete();
                Mfp_procurement_collection_level_haat::where(['mfp_procurement_id' => $procurement->id])->delete();
                
                foreach ($data['collection_level'] as $key => $row) {

                    $collection_level = new Mfp_procurement_collection_level();
                    $collection_level->mfp_procurement_id = $procurement->id;
                    $collection_level->mfp_id = $row['mfp_id'] ?? null;
                    $collection_level->qty = $row['qty'] ?? null;
                    $collection_level->warehouse = $row['warehouse'] ?? null;
                    $collection_level->capacity = $row['capacity'] ?? null;
                    $collection_level->procurement_center = $row['procurement_center'] ?? null;
                    $collection_level->packing_material_type = $row['packing_material_type'] ?? null;
                    $collection_level->standard_packing = $row['standard_packing'] ?? null;
                    $collection_level->category = $row['category'] ?? null;
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
                            $collection_level_haat = new Mfp_procurement_collection_level_haat();
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
            //======================================================
            //To save labour charges
            if (isset($data['labour_charges']) && !empty($data['labour_charges'])) {
                Mfp_procurement_labour_charges::where('mfp_procurement_id', $procurement->id)->delete();
                $labour_charges_data=array();
                foreach ($data['labour_charges'] as $key => $row) {
                    if(isset($row['mfp']) && $row['mfp'] !='' && isset($row['haat']) && $row['haat']!='')
                    {
                        if(isset($labour_charges_data[$row['mfp']]) && in_array($row['haat'], $labour_charges_data[$row['mfp']]))
                        {
                            $mfp_data=Mfp::where('id',$row['mfp'])->first();
                            $mfp_name=$mfp_data->getMfpName->title;
                            throw new \Exception("Duplicate entry of MFP $mfp_name in labour charges section");  
                        }else{
                            $labour_charges_data[$row['mfp']][]=$row['haat'];
                        }
                    }
                }
                foreach ($data['labour_charges'] as $key => $row) {
                    $labour_charges = new Mfp_procurement_labour_charges();
                    $labour_charges->mfp_procurement_id = $procurement->id;;
                    $labour_charges->mfp_id = isset($row['mfp'])?$row['mfp']: null;
                    $labour_charges->haat_id = $row['haat'] ?? null;
                    $labour_charges->unit_manday_rate = $row['unit_manday_rate'] ?? null;
                    $labour_charges->estimated_mandays = $row['estimated_mandays'] ?? null;
                    $labour_charges->total_estimated_cost = $row['total_estimated_cost'] ?? null;
                    $labour_charges->is_draft = $is_draft;
                    $labour_charges->created_by = $user_id;
                    $labour_charges->updated_by = $user_id;
                    $labour_charges->save();
                }
            }
            //To save weightment charges
            if (isset($data['weightment_charges']) && !empty($data['weightment_charges'])) {
                Mfp_procurement_weightment_charges::where('mfp_procurement_id', $procurement->id)->delete();
                $weightment_data=array();
                foreach ($data['weightment_charges'] as $key => $row) 
                {
                    if($row['mfp']!='' && $row['type']!=''){
                        
                        if(isset($weightment_data[$row['mfp']][$row['type']]))
                        {
                            if($row['type']=='H' && in_array($row['haat_id'], $weightment_data[$row['mfp']][$row['type']] ))
                            {
                                $mfp_data=Mfp::where('id',$row['mfp'])->first();
                                $mfp_name=$mfp_data->getMfpName->title;
                                throw new \Exception("Duplicate entry of MFP $mfp_name in weightment charges section");  
                            }
                            if($row['type']=='P' && in_array($row['procurement_center_id'], $weightment_data[$row['mfp']][$row['type']] ))
                            {
                                $mfp_data=Mfp::where('id',$row['mfp'])->first();
                                $mfp_name=$mfp_data->getMfpName->title;
                                throw new \Exception("Duplicate entry of MFP $mfp_name in weightment charges section");  
                            }
                        }else{
                            if($row['type']=='H' && $row['haat_id']!='')
                            {
                                $weightment_data[$row['mfp']][$row['type']][]=$row['haat_id'];    
                            }
                            if($row['type']=='P' && $row['procurement_center_id']!='')
                            {
                                $weightment_data[$row['mfp']][$row['type']][]=$row['procurement_center_id'];    
                            }
                            
                        }
                        
                        
                    }
                    
                }

                foreach ($data['weightment_charges'] as $key => $row) {
                    $weightment_charges = new Mfp_procurement_weightment_charges();
                    $weightment_charges->mfp_procurement_id = $procurement->id;;
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
                Mfp_procurement_transportation_charges::where('mfp_procurement_id', $procurement->id)->delete();
                $transport_data=array();
                $transportation_charges_mfp_qty = array();
                foreach ($data['transportation_charges'] as $key => $row) 
                {
                    $mfp_id = $row['mfp'];
                    if(isset($transportation_charges_mfp_qty[$mfp_id]))
                    {
                        $transportation_charges_mfp_qty[$mfp_id] = $transportation_charges_mfp_qty[$mfp_id]+$row['qty'];     
                    }else{
                        $transportation_charges_mfp_qty[$mfp_id] = $row['qty'];
                    }    
                    if($row['mfp']!='' && $row['haat']!='' && $row['type_of_transport']!='')
                    {
                        if(isset($transport_data[$row['mfp']][$row['haat']]) && in_array($row['type_of_transport'], $transport_data[$row['mfp']][$row['haat']]))
                        {
                            $mfp_data=Mfp::where('id',$row['mfp'])->first();
                            $mfp_name=$mfp_data->getMfpName->title;
                            throw new \Exception("Duplicate entry of MFP $mfp_name in transportation charges section");  
                        }else{
                            $transport_data[$row['mfp']][$row['haat']][]=$row['type_of_transport'];    
                        }    
                    }
                 
                    if(isset($transportation_charges_mfp_qty[$mfp_id]) && isset($mfp_seasonality_mfp_qty[$mfp_id]))
                    {
                        if($transportation_charges_mfp_qty[$mfp_id] > $mfp_seasonality_mfp_qty[$mfp_id])
                        {
                            
                            $quantity = $mfp_seasonality_mfp_qty[$mfp_id];
                            $mfp_data = Mfp::where('id',$mfp_id)->first();
                            $mfp_name = $mfp_data->getMfpName->title;
                            $quantity_errors[] = "Please do not enter quantity of $mfp_name more than $quantity in Transportation charges";
                        }    
                    }
                    
                    
                }
                foreach ($data['transportation_charges'] as $key => $row) {
                    $transportation_charges = new Mfp_procurement_transportation_charges();
                    $transportation_charges->mfp_procurement_id = $procurement->id;;
                    $transportation_charges->mfp_id = $row['mfp'] ?? null;
                    $transportation_charges->haat_id = $row['haat'] ?? null;
                    $transportation_charges->approx_distance = $row['approx_distance'] ?? null;
                    $transportation_charges->type_of_transport = $row['type_of_transport'] ?? null;
                    $transportation_charges->qty = $row['qty'] ?? null;
                    $transportation_charges->charges_per_qunital = $row['charges_per_quintal'] ?? null;
                    $transportation_charges->estimated_total_cost_of_transportation = $row['total_transportation_cost'] ?? null;
                    $transportation_charges->is_draft = $is_draft;
                    $transportation_charges->created_by = $user_id;
                    $transportation_charges->updated_by = $user_id;
                    $transportation_charges->save();
                   
                }
                
            }
            //To save service charges
            if (isset($data['service_charges']) && !empty($data['service_charges'])) {
                Mfp_procurement_service_charges::where('mfp_procurement_id', $procurement->id)->delete();
                $service_charge_data=array();
                $service_charge_mfp=array();
                foreach ($data['service_charges'] as $key => $row) 
                {
                    if($row['mfp']!='' && $row['primary_level_agency']!='')
                    {   
                        if(isset($service_charge_data[$row['mfp']]) && in_array($row['primary_level_agency'], $service_charge_data[$row['mfp']]))
                        {
                            $mfp_data=Mfp::where('id',$row['mfp'])->first();
                            $mfp_name=$mfp_data->getMfpName->title;
                            throw new \Exception("Duplicate entry of MFP $mfp_name in service charges section");  
                        }else{
                            $service_charge_data[$row['mfp']][]=$row['primary_level_agency'];  
                        }
                        

                    }

                     $mfp_id=$row['mfp'];

                    if(isset($mfp_id)!='' && $row['qty_of_mfp']!='')
                    {
                        if(isset($service_charge_mfp[$mfp_id]))
                        {
                            $service_charge_mfp[$mfp_id] +=$row['qty_of_mfp'];
                        }else{
                            $service_charge_mfp[$mfp_id]=$row['qty_of_mfp'];
                        }
                        $mfp_id=$row['mfp'];
                        if(isset($mfp_seasonality_mfp_qty[$mfp_id]) )
                        {
                            if($service_charge_mfp[$mfp_id] > $mfp_seasonality_mfp_qty[$mfp_id])
                            {
                                $quantity=$mfp_seasonality_mfp_qty[$mfp_id];
                                $mfp_data=Mfp::where('id',$mfp_id)->first();
                                $mfp_name=$mfp_data->getMfpName->title;
                                $quantity_errors[]="Please do not enter quantity of $mfp_name more than $quantity in Service Charges section";
                                throw new \Exception("Please do not enter quantity of $mfp_name more than $quantity in Service Charges section");      
                            }
                        }
                    }
                    
                }
                foreach ($data['service_charges'] as $key => $row) {
                    $service_charges = new Mfp_procurement_service_charges();
                    $service_charges->mfp_procurement_id = $procurement->id;;
                    $service_charges->mfp_id = $row['mfp'] ?? null;
                    $service_charges->qty_of_mfp = $row['qty_of_mfp'] ?? null;
                    $service_charges->primary_level_agency = $row['primary_level_agency'] ?? null;
                    $service_charges->estimated_value_of_mfp_procurement = $row['estimated_value_of_mfp_procurement'] ?? null;
                    $service_charges->estimated_service_charge_primary_level_agency = $row['estimated_service_charges'] ?? null;
                    $service_charges->service_charge_in_total_value_of_procurement = $row['share_service_charge'] ?? null;
                    $service_charges->is_draft = $is_draft;
                    $service_charges->created_by = $user_id;
                    $service_charges->updated_by = $user_id;

                    

                    $service_charges->save();
                }
            }

            //To save ware house labour charges
            if (isset($data['warehouse_labour_charges']) && !empty($data['warehouse_labour_charges'])) {
                Mfp_procurement_warehouse_labour_charges::where('mfp_procurement_id', $procurement->id)->delete();
                $warehouse_labour_data=array();
                foreach ($data['warehouse_labour_charges'] as $key => $row) 
                {
                    if($row['mfp']!='' && $row['warehouse']!='')
                    {
                        if(isset($warehouse_labour_data[$row['mfp']]) && in_array($row['warehouse'], $warehouse_labour_data[$row['mfp']]))
                        {
                            $mfp_data=Mfp::where('id',$row['mfp'])->first();
                            $mfp_name=$mfp_data->getMfpName->title;
                            throw new \Exception("Duplicate entry of MFP $mfp_name in ware house labour charges section");     
                        }else{
                            $warehouse_labour_data[$row['mfp']][]=$row['warehouse'];    
                        }
                    }
                    
                    
                }
                $warehouse_labour_mfp=array();
                foreach ($data['warehouse_labour_charges'] as $key => $row) {
                    $warehouse_labour_charges = new Mfp_procurement_warehouse_labour_charges();
                    $warehouse_labour_charges->mfp_procurement_id = $procurement->id;;
                    $warehouse_labour_charges->mfp_id = $row['mfp'] ?? null;
                    $warehouse_labour_charges->warehouse_id = $row['warehouse'] ?? null;
                    $warehouse_labour_charges->qty = $row['qty'] ?? null;
                    $mfp_id=$row['mfp'];
                    if(isset($mfp_seasonality_mfp_qty[$mfp_id]) && $row['qty']!='')
                    {
                        if(isset($warehouse_labour_mfp[$mfp_id]))
                        {
                            $warehouse_labour_mfp[$mfp_id] +=$row['qty'];
                        }else{
                            $warehouse_labour_mfp[$mfp_id]=$row['qty'];    
                        }
                        
                        if($warehouse_labour_mfp[$mfp_id] > $mfp_seasonality_mfp_qty[$mfp_id])
                        {
                            $quantity=$mfp_seasonality_mfp_qty[$mfp_id];
                            $mfp_data=Mfp::where('id',$mfp_id)->first();
                            $mfp_name=$mfp_data->getMfpName->title;
                            $quantity_errors[]="Please do not enter quantity of $mfp_name more than $quantity in ware house labour charges section";
                            //throw new \Exception("Please do not enter quantity of $mfp_name more than $quantity in ware house labour charges section");      
                        }
                    }
                    $warehouse_labour_charges->unit_rate = $row['unit_rate'] ?? null;
                    $warehouse_labour_charges->total_estimated_cost = $row['total_estimated_cost'] ?? null;
                    $warehouse_labour_charges->is_draft = $is_draft;
                    $warehouse_labour_charges->created_by = $user_id;
                    $warehouse_labour_charges->updated_by = $user_id;
                    $warehouse_labour_charges->save();
                }
            }

            //To save ware house charges
            if (isset($data['warehouse_charges']) && !empty($data['warehouse_charges'])) {

                Mfp_procurement_warehouse_charges::where('mfp_procurement_id', $procurement->id)->delete();
                $warehouse_labour_data=array();
                foreach ($data['warehouse_charges'] as $key => $row) 
                {
                    if($row['mfp']!='' && $row['warehouse']!='')
                    {
                        if(isset($warehouse_labour_data[$row['mfp']]) && in_array($row['warehouse'], $warehouse_labour_data[$row['mfp']]))
                        {
                            $mfp_data=Mfp::where('id',$row['mfp'])->first();
                            $mfp_name=$mfp_data->getMfpName->title;
                            throw new \Exception("Duplicate entry of MFP $mfp_name in ware house charges section");     
                        }else{
                            $warehouse_labour_data[$row['mfp']][]=$row['warehouse'];    
                        }
                    }
                    
                    
                }
                $warehouse_charges_mfp=array();
                foreach ($data['warehouse_charges'] as $key => $row) {
                    $mfp_id=$row['mfp'];
                    if(isset($mfp_seasonality_mfp_qty[$mfp_id]) && $row['estimated_quantity']!='')
                    {
                        if(isset($warehouse_charges_mfp[$mfp_id]))
                        {
                            $warehouse_charges_mfp[$mfp_id] +=$row['estimated_quantity'];
                        }else{
                            $warehouse_charges_mfp[$mfp_id]=$row['estimated_quantity'];     
                        }
                        
                        if($warehouse_charges_mfp[$mfp_id] > $mfp_seasonality_mfp_qty[$mfp_id])
                        {
                            $quantity=$mfp_seasonality_mfp_qty[$mfp_id];
                            $mfp_data=Mfp::where('id',$mfp_id)->first();
                            $mfp_name=$mfp_data->getMfpName->title;
                            $quantity_errors[]="Please do not enter estimated quantity of $mfp_name more than $quantity in ware house charges section";
                            //throw new \Exception("Please do not enter estimated quantity of $mfp_name more than $quantity in ware house charges section");      
                        }
                    }
                    $warehouse_charges = new Mfp_procurement_warehouse_charges();
                    $warehouse_charges->mfp_procurement_id = $procurement->id;;
                    $warehouse_charges->mfp_id = $row['mfp'] ?? null;
                    $warehouse_charges->warehouse_id = $row['warehouse'] ?? null;
                    $warehouse_charges->unit_id = $row['unit'] ?? null;
                    $warehouse_charges->unit_storage_rate = $row['unit_storage_rate'] ?? null;
                    $warehouse_charges->estimated_quantity = $row['estimated_quantity'] ?? null;
                    $warehouse_charges->total_estimated_cost = $row['total_estimated_cost'] ?? null;
                    $warehouse_charges->estimation_duration_of_storage = $row['estimated_duration_of_storage'] ?? null;
                    $warehouse_charges->is_draft = $is_draft;
                    $warehouse_charges->created_by = $user_id;
                    $warehouse_charges->updated_by = $user_id;
                    
                    $warehouse_charges->save();
                }
            }
            //To save estimated wastages
            if (isset($data['estimated_wastages']) && !empty($data['estimated_wastages'])) {
                Mfp_procurement_estimated_wastages::where('mfp_procurement_id', $procurement->id)->delete();
                $wastagesQty = [];$warehouse_labour_data=array();
                foreach ($data['estimated_wastages'] as $key => $row) {
                    if(isset($row['mfp']) && $row['mfp']!='' && $row['warehouse']!='')
                    {
                        if(isset($warehouse_labour_data[$row['mfp']]) && in_array($row['warehouse'], $warehouse_labour_data[$row['mfp']]))
                        {
                            $mfp_data=Mfp::where('id',$row['mfp'])->first();
                            $mfp_name=$mfp_data->getMfpName->title;
                            throw new \Exception("Duplicate entry of MFP $mfp_name in estimated wastages section");     
                        }else{
                            $warehouse_labour_data[$row['mfp']][]=$row['warehouse'];    
                        }
                    }

                    if(isset($row['mfp']) && !array_key_exists($row['mfp'],$wastagesQty)){
                        $wastagesQty[$row['mfp']] =  $row['procurement_quantity'];
                    }else{
                        if(isset($row['mfp']) && isset($wastagesQty[$row['mfp']]))
                        {
                            $wastagesQty[$row['mfp']] =   $wastagesQty[$row['mfp']] + $row['procurement_quantity'];    
                        }
                        
                    }
                    
				    if(isset($row['mfp']) && isset($wastagesQty[$row['mfp']]) && isset($mfp_seasonality_mfp_qty[$row['mfp']])){
                    if($wastagesQty[$row['mfp']] > $mfp_seasonality_mfp_qty[$row['mfp']])
                        {
                            $quantity = $mfp_seasonality_mfp_qty[$row['mfp']];
                            $mfp_data = Mfp::where('id',$row['mfp'])->first();
                            $mfp_name = $mfp_data->getMfpName->title;
                            $quantity_errors[]="Please do not enter procurement quantity of $mfp_name more than $quantity in estimated wastages section";
                            //throw new \Exception("Please do not enter procurement quantity of $mfp_name more than $quantity in estimated wastages section");      
                        }
					}
                }
                foreach ($data['estimated_wastages'] as $key => $row) {
                    $estimated_wastages = new Mfp_procurement_estimated_wastages();
                    $estimated_wastages->mfp_procurement_id = $procurement->id;;
                    $estimated_wastages->mfp_id = $row['mfp'] ?? null;
                    $estimated_wastages->warehouse_id = $row['warehouse'] ?? null;
                    $estimated_wastages->procurement_quantity = $row['procurement_quantity'] ?? null;
                    $estimated_wastages->procurement_value = $row['procurement_value'] ?? null;
                    $estimated_wastages->estimated_driage_percentage = $row['estimated_driage_percentage'] ?? null;
                    $estimated_wastages->estimated_driage_rs = $row['estimated_driage_value'] ?? null;
                    $estimated_wastages->is_draft = $is_draft;
                    $estimated_wastages->created_by = $user_id;
                    $estimated_wastages->updated_by = $user_id;
                    $estimated_wastages->save();
                }
            }

            //To save estimated wastages
            if (isset($data['service_charge_at_dia']) && !empty($data['service_charge_at_dia'])) {
                Mfp_procurement_service_charges_at_dia::where('mfp_procurement_id', $procurement->id)->delete();
                foreach ($data['service_charge_at_dia'] as $key => $row) {
                    $service_charge_at_dia = new Mfp_procurement_service_charges_at_dia();
                    $service_charge_at_dia->mfp_procurement_id = $procurement->id;;
                    $service_charge_at_dia->mfp_id = $row['mfp_id'] ?? null;
                    $service_charge_at_dia->dia_id = $row['dia_id'] ?? null;
                    $service_charge_at_dia->estimated_value_of_procurement = $row['procurement_estimated_value'] ?? null;
                    $service_charge_at_dia->service_charges_percentage = $row['service_charges_percentage'] ?? null;
                    $service_charge_at_dia->service_charge_value = $row['service_charge'] ?? null;
                    $service_charge_at_dia->is_draft = $is_draft;
                    $service_charge_at_dia->created_by = $user_id;
                    $service_charge_at_dia->updated_by = $user_id;
                    $service_charge_at_dia->save();
                }
            }

            //To save other costs
            if (isset($data['other_costs']) && !empty($data['other_costs'])) {
                Mfp_procurement_other_costs::where('mfp_procurement_id', $procurement->id)->delete();
                foreach ($data['other_costs'] as $key => $row) {
                    $other_costs = new Mfp_procurement_other_costs();
                    $other_costs->mfp_procurement_id = $procurement->id;;
                    $other_costs->mfp_id = $row['mfp_id'] ?? null;
                    $other_costs->other_costs = $row['other_cost'] ?? null;
                    $other_costs->remarks = $row['remarks'];
                    $other_costs->is_draft = $is_draft;
                    $other_costs->created_by = $user_id;
                    $other_costs->updated_by = $user_id;
                    $other_costs->save();
                }
            }
            if(!empty($quantity_errors))
            {
                $quantity_errors=implode(',<br>', $quantity_errors);
                throw new \Exception($quantity_errors);  
                
            }
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
     * Delete an item from database
     *
     * @param integer $id
     * @return boolean
     */
    public function deleteItem($id)
    {
        $item = ServiceModel::findOrFail($id);
        $item->deleteDistricts();

        return $item->delete();
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
        $max = $this->getMaxQty($data);
        $maxDisposal = $this->getMaxQtyDisposal($data);
        $maxQtyWastages = $this->getMaxQtyWastages($data);
        //dd($max);
        return Validator::make(
            $data,
            [
                'form_id' => 'nullable|exists:mfp_procurement,ref_id',
                'submit_type'=> 'required',
                'mfp_disposal_form.*.mfp_id' => [
                    $required, 'exists:mfp_master,id', 'distinct',
                ],
                'mfp_disposal_form.*.warehouse_id.*' => [
                    $required, 'exists:warehouse_master,id', 
                ],
                'mfp_disposal_form.*.qty.*' => [
                    //$required, 'numeric','max:'.$maxDisposal,
                    $required, 'numeric',
                ],
                'mfp_disposal_form.*.value.*' => [
                    $required, 'numeric',
                ],
                'mfp_disposal_form.*.month.*.*' => [
                    $required, 'in:1,2,3,4,5,6,7,8,9,10,11,12',
                ],
                'estimated_losses.*.row_id' => [
                    $required,
                ],
                'estimated_losses.*.mfp_id' => [
                    $required, 'exists:mfp_master,id'
                ],
                'estimated_losses.*.previous_year_estimated_qty' => [
                    $required, 'numeric'
                ],
                'estimated_losses.*.previous_year_estimated_value' => [
                    $required, 'numeric'
                ],
                'estimated_losses.*.previous_year_actual_qty' => [
                    $required, 'numeric'
                ],
                'estimated_losses.*.previous_year_actual_estimated_qty' => [
                    $required, 'numeric'
                ],
                'estimated_losses.*.current_year_estimated_qty' => [
                    $required, 'numeric'
                ],
                'estimated_losses.*.current_year_estimated_value' => [
                    $required, 'numeric'
                ],
                'collection_level.*.mfp_id' => [
                    $required, 'exists:mfp_master,id'
                ],
                'collection_level.*.qty' => [
                    $required, 'numeric'
                ],
                'collection_level.*.corresponding_haat.*' => [
                   'required', 'exists:haat_bazaar_master,id'
                ],
                'collection_level.*.warehouse' => [
                    $required, 'exists:warehouse_master,id'
                ],
                'collection_level.*.capacity' => [
                    $required, 'numeric'
                ],
                'collection_level.*.procurement_center' => [
                    $required,
                ],
                'collection_level.*.packing_material_type' => [
                    $required, 'exists:packing_master,id'
                ],
                'collection_level.*.standard_packing' => [
                    $required,
                ],
                'collection_level.*.category' => [
                    $required,
                ],
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
                'transportation_charges.*.qty' => [
                    //$required, 'numeric','max:'.$max,
                    $required, 'numeric',
                ],
                'transportation_charges.*.charges_per_quintal' => [
                    $required, 'numeric',
                ],
                'transportation_charges.*.total_transportation_cost' => [
                    $required, 'numeric'
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
                //overheads estimated wastages
                'estimated_wastages.*.mfp' => [
                    $required, 'exists:mfp_master,id',
                ],
                'estimated_wastages.*.warehouse' => [
                    $required,
                ],
                'estimated_wastages.*.procurement_quantity' => [
                    //$required, 'numeric','max:'.$maxQtyWastages
                    $required, 'numeric',
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
                    $required, 'exists:mfp_master,id', 'distinct',
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
                    $required, 'exists:mfp_master,id', 'distinct',
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
        $i = 0;
        
        $max = $this->getMaxQty($data);
        $maxDisposal = $this->getMaxQtyDisposal($data);
        $maxQtyWastages = $this->getMaxQtyWastages($data);
        $messages = array();
        if (!empty($data['mfp_disposal_form'])) {
            foreach ($data['mfp_disposal_form'] as $key => $row) {
                ++$i;
                $row_message = " in " . $this->ordinal_suffix($i) . " record";
                foreach ($row['qty'] as $key1 => $row1) {
                   
                    //mfp disposal form messages
                    $messages['mfp_disposal_form.' . $key . '.mfp_id.required'] = "Please select MFP in MFP disposal plan $row_message";
                    $messages['mfp_disposal_form.' . $key . '.mfp_id.distinct'] = "Please select diferent MFP in MFP disposal plan $row_message";
                    $messages['mfp_disposal_form.' . $key . '.qty.'.$key1.'required'] = "Please enter quantity in MFP disposal plan $row_message";
                    $messages['mfp_disposal_form.' . $key . '.qty.'.$key1.'numeric'] = "Please enter quantity only number or decimal in MFP disposal plan $row_message";
                    //$messages['mfp_disposal_form.'.$key.'.qty.'.$key1.'.max'] = "Disposal charges qunatity $row_message may not greater than $maxDisposal";
                    $messages['mfp_disposal_form.' . $key . '.value.'.$key1.'required'] = "Please enter value in MFP disposal plan $row_message"; 
                    $messages['mfp_disposal_form.' . $key . '.value.'.$key1.'numeric'] = "Please enter value only number or decimal in MFP disposal plan $row_message";
                    //echo $row_message;
                    $messages['mfp_disposal_form.'.$key.'.warehouse_id.'.$key1.'.required']  = "Please select warehouse in MFP disposal plan $row_message";
                    $messages['mfp_disposal_form.'.$key.'.warehouse_id.'.$key1.'.distinct']  = "Please select unique warehouse in MFP disposal plan $row_message";
                    $messages['mfp_coverage.' . $key . '.mfp_id.distinct'] = "Please select unique MFP in MFP disposal plan $row_message";
                    $messages['mfp_coverage.' . $key . '.warehouse_id.required'] = "Please select warehouse MFP disposal plan $row_message";
                    $messages['mfp_coverage.' . $key . '.warehouse_id.months'] = "Please select months MFP disposal plan $row_message";
                  
                }
               
            }
        }
        $j = 0;
        if (!empty($data['transportation_charges'])) {
            foreach ($data['transportation_charges'] as $key => $row) {
                ++$j;
                $row_message = " in " . $this->ordinal_suffix($j) . " record";
                $messages['transportation_charges.' . $key . '.mfp.required'] = "Please select MFP in transportation charges $row_message";
                $messages['transportation_charges.' . $key . '.haat.required'] = "Please select haat in transportation charges $row_message";
                $messages['transportation_charges.' . $key . '.approx_distance.required'] = "Please enter approx distance in transportation charges $row_message";
                $messages['transportation_charges.' . $key . '.type_of_transport.required'] = "Please select type of transport in transportation charges $row_message";
                $messages['transportation_charges.' . $key . '.qty.required'] = "Please enter qty in transportation charges $row_message";
                $messages['transportation_charges.' . $key . '.qty.max'] = "Transportation charges qunatity $row_message may not greater than $max";
                $messages['transportation_charges.' . $key . '.charges_per_quintal.required'] = "Please enter charges per quintal in transportation charges $row_message";
                $messages['transportation_charges.' . $key . '.total_transportation_cost.required'] = "Please enter total transportation charges  in transportation charges $row_message";
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
                $messages['estimated_wastages.' . $key . '.warehouse.required'] = "Please select warehouse in estimated wastages $row_message";
                $messages['estimated_wastages.' . $key . '.warehouse.distinct'] = "Please select different warehouse in estimated wastages $row_message";
                $messages['estimated_wastages.' . $key . '.procurement_quantity.required'] = "Please select MFP in estimated wastages $row_message";
                $messages['estimated_wastages.' . $key . '.procurement_quantity.max'] = "Estimated Wastages quantity $row_message may not greater than $maxQtyWastages";
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



    public function getMaxQty($data){
        foreach ($data['transportation_charges'] as $key => $row) 
        {   
            $form_id = $data['form_id'];
            $mfp_id = $row['mfp'];
            $procurement = Mfp_procurement::where('ref_id', $form_id)->firstOrFail();
            $qty =  Mfp_seasonality_commodity::where('mfp_procurement_id',$procurement->id)->where('mfp_id', $mfp_id)->get()->sum('qty');    
            return $qty;
        }
    }
    public function getMaxQtyDisposal($data){
        foreach ($data['mfp_disposal_form'] as $key => $row) 
        {   
            $form_id = $data['form_id'];
            $mfp_id = $row['mfp_id'];
            $procurement = Mfp_procurement::where('ref_id', $form_id)->firstOrFail();
            $qty =  Mfp_seasonality_commodity::where('mfp_procurement_id',$procurement->id)->where('mfp_id', $mfp_id)->get()->sum('qty');    
            return $qty;
        }
    }
    public function getMaxQtyWastages($data){
        foreach ($data['estimated_wastages'] as $key => $row) 
        {   
            $form_id = $data['form_id'];
            $qty=0;
            if(isset($row['mfp']))
            {
                $mfp_id = $row['mfp'];
                $procurement = Mfp_procurement::where('ref_id', $form_id)->firstOrFail();
                $qty =  Mfp_seasonality_commodity::where('mfp_procurement_id',$procurement->id)->where('mfp_id', $mfp_id)->get()->sum('qty');        
            }
            
            return $qty;
        }
    }
    /**
     * Validates for updating a record in databse
     *
     * @param integer $id
     * @param Array $data
     * @return mixed
     */
    public function validateUpdate($id, $data)
    {
        $required = 'nullable';
        if (isset($data['submit_type']) && $data['submit_type'] == 'submit') {
            $required = 'required';
        }

        $messages = $this->validation_messages($data);
        return Validator::make(
            $data,
            [
                'form_id' => 'nullable|exists:mfp_procurement,ref_id',

                'mfp_disposal_form.*.mfp_id' => [
                    $required, 'exists:mfp_master,id', 'distinct',
                ],
                'mfp_disposal_form.*.warehouse_id.*' => [
                    'nullable', 'exists:warehouse_master,id', 'distinct',
                ],
                'mfp_disposal_form.*.warehouse_id.*' => [
                    'nullable', 'exists:warehouse_master,id', 'distinct',
                ],
                'mfp_disposal_form.*.months.*' => [
                    'nullable', 'in:1,2,3,4,5,6,7,8,9,10,11,12',
                ],
            ],
            $messages
        );
    }

    /**
     * Switch the status of the given user id.
     *
     * @param integer $id
     * @return string|integer
     */
    public function switchStatus($id)
    {
        $model = ServiceModel::where([
            'id' => $id
        ])->firstOrFail();
        $model->switchStatus();
        $model->save();
        return $model->status;
    }

    public function deleteMfpCoverage($request)
    {
        DB::beginTransaction();
        try {
            $id = $request['id'];
            Mfp_coverage::where('id', $id)->delete();
            Mfp_coverage_haat_block::where('mfp_coverage_id', $id)->delete();
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }
    public function deleteSeasonality($request)
    {
        DB::beginTransaction();
        try {
            $id = $request['id'];
            Mfp_seasonality::where('id', $id)->delete();
            Mfp_seasonality_commodity::where('mfp_seasonality_id', $id)->delete();
            Mfp_seasonality_commodity_month::where('mfp_seasonality_id', $id)->delete();
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }
    public function deleteMfpCoverageBlockHaat($request)
    {
        DB::beginTransaction();
        try {
            $id = $request['id'];
            Mfp_coverage_haat_block::where('id', $id)->delete();
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }
    public function deleteCommodityHaat($request)
    {
        DB::beginTransaction();
        try {
            $id = $request['id'];
            Mfp_seasonality_commodity::where('id', $id)->delete();
            Mfp_seasonality_commodity_month::where('mfp_seasonality_commodity_id', $id)->delete();
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }
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
}
