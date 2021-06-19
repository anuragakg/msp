<?php

namespace App\Services\Proposals;
use Carbon\Carbon;
use App\Models\Masters\Mfp;
use App\Models\Shg\ShgGatherers;
use App\Models\Proposals\Mfp_procurement;
use App\Models\Proposals\Mfp_storage_actual;
use App\Models\Proposals\Mfp_storage_actual_other;
use App\Models\Proposals\Mfp_storage_actual_haat;
use App\Models\Mfp_procurement_dia_release_commodity;
use App\Models\Actualdetail\Mfp_procurement_actual_detail;
use App\Models\Actualdetail\Mfp_procurement_actual_detail_commodity;
use App\Services\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Proposals\Mfp_procurement_commodity;
use App\Queries\ActualdetailQuery;
use App\Models\Proposals\Mfp_procurement_consolidated_transaction;
use App\Models\Proposals\Mfp_procurement_transaction_status_log;
use App\Models\Masters\StateRoleSubLevel;
use App\Models\Proposals\Mfp_procurement_consolidated_tribal_transaction;
use App\Models\Proposals\Mfp_procurement_transaction;
use App\Models\User;
use App\Models\Shg\ShgBankDetails;
use App\Notifications\MfpProcurementTransactionConsolidatedNextLevel;

use FundHelper;

use DB;

class MfpProcurementActualDetailService extends Service
{
    private $actualdetailQuery;
    

    public function __construct(ActualdetailQuery $actualdetailQuery = null)
    {
        $this->actualdetailQuery = $actualdetailQuery;
    }
    public function getTribalDetailFromIdProof($request)
    {
        return ShgGatherers::where(['id_type'=>$request['id_type'],'id_value'=>$request['id_value']])->first();
    }

    public function getTribalDetailFromName($request)
    {
        return ShgGatherers::where('name_of_tribal','like', $request['name_of_tribal']. '%' )->limit('50')->orderBy('name_of_tribal','ASC')->get();
    }

    public function getProcurementAgentProposals($id)
    {
        $user=Auth::user();
        return Mfp_procurement::where('ref_id',$id)->whereIn('has_released_to_procurement_agent',[1,2])
        ->whereHas('getDiaReleasedProcurements', function (Builder $query) use ($user) {
        })
        ->first();
    }
    public function getProcurementAgentProposalsMfp($id)
    {
        $user=Auth::user();
        $procurement=Mfp_procurement::where('ref_id',$id)->first();
        $mfp_ids=Mfp_procurement_dia_release_commodity::where(['mfp_procurement_id'=>$procurement->id,'procurement_agent'=>$user->id])->distinct('mfp_id')->pluck('mfp_id');
        
        return Mfp::whereIn('id',$mfp_ids)->get();

    }
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getAll($request)
    {
        $columns = array(
            0 => 'mfp_procurement_actual_detail.id',
            //1 => 'state_id',
            //6 => 'storage_capacity',
        );
        $limit = isset($request['length']) ? $request['length'] : 10;


        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 'id';
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC';
        $query = $this->actualdetailQuery->viewAllQuery();
        $query = $query->orderBy($order, $dir);

        $query->join('mfp_procurement', function($join) {
                  $join->on('mfp_procurement_actual_detail.mfp_procurement_id', '=', 'mfp_procurement.id');
                });

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            $search = $request['search']['value'];
            $query->where(DB::raw("CONCAT(`proposal_id`,`name_of_tribal`)"), 'LIKE', "%".$search."%");
        }
        
        if(isset($request['proposal_id']) && !empty($request['proposal_id']))
        {
            $query->where('proposal_id',$request['proposal_id']);   
        }
        if(isset($request['id_type']) && !empty($request['id_type']))
        {
            $query->where('id_type',$request['id_type']);   
        }
        if(isset($request['id_value']) && !empty($request['id_value']))
        {
            $query->where('id_value',$request['id_value']);   
        }
        if(isset($request['name_of_tribal']) && !empty($request['name_of_tribal']))
        {
            $query->where(DB::raw("CONCAT(`name_of_tribal`)"), 'LIKE', "%".$request['name_of_tribal']."%");   
        }
        if(isset($request['from']) && !empty($request['from']))
        {
            $date = str_replace('/', '-', $request['from']);
            $from=date('Y-m-d', strtotime($date));
            $query->where('procurement_date','>=',$from);   
        }
        if(isset($request['to']) && !empty($request['to']))
        {
            $date = str_replace('/', '-', $request['to']);
            $to=date('Y-m-d', strtotime($date));
            $query->where('procurement_date','<=',$to);   
        }
        $query->select('mfp_procurement_actual_detail.*');
        if (isset($request['page']) && !empty($request['page'])) {
            return $query->paginate($limit);
        } else {
            //$query=$query->where('status','1');
            return $query->get();
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
        $messages=$this->validateMessages($data);
        return Validator::make(
            $data,
            [
                'tribals.*.id_type' => [
                    'required', 'exists:mysql2.id_proof_master,id',
                ],
                'tribals.*.id_value' => [
                    'required', 'exists:mysql2.shg_gatherers,id_value','distinct',
                ],
                'tribals.*.name_of_tribal' => ['required'],
                'tribals.*.shg_id' => [
                    'required', 'exists:mysql2.shg_gatherers,id',
                ],
                
                'tribals.*.bank_account_no' => ['required','numeric'],
                'tribals.*.village' => ['required'],
                'tribals.*.bank_ifsc' => ['required'],
                'tribals.*.address' => ['required'],
                'tribals.*.type' => ['required','in:1,2'],
                'tribals.*.procurement_date' => ['required','date_format:d/m/Y'],
                'tribals.*.proposal_id' => ['required','exists:mfp_procurement,ref_id'],
                'tribals.*.mfp_details.*.mfp_id' => ['required', 'exists:mfp_master,id'],
                'tribals.*.mfp_details.*.qty' => ['required', 'numeric'],
                'tribals.*.mfp_details.*.value' => ['required', 'numeric'],
                'tribals.*.amount_paid' => ['required', 'numeric','decimal_value'],
                'tribals.*.amount_payable' => ['required', 'numeric','decimal_value'],
            ],$messages
        );
    }
    public function validateMessages($data)
    {
        $i = 0;
        $messages = array();
        if(isset($data['tribals']) && !empty($data['tribals']))
        {
            foreach ($data['tribals'] as $tribal_key => $mfp) 
            {
                ++$i;
                $row_message = " in " . $this->ordinal_suffix($i) . " record";
                $messages['tribals.' . $tribal_key . '.id_type.required'] = "Please select id type in $row_message";

                $messages['tribals.' . $tribal_key . '.id_value.required'] = "Please select id value in $row_message";
                $messages['tribals.' . $tribal_key . '.id_value.exists'] = "Please select valid value in $row_message";
                $messages['tribals.' . $tribal_key . '.id_value.distinct'] = "Please select unique id value in $row_message";
                $messages['tribals.' . $tribal_key . '.name_of_tribal.required'] = "Please select valid name of tribal in $row_message";
                $messages['tribals.' . $tribal_key . '.shg_id.required'] = "Please select valid tribal in $row_message";
                $messages['tribals.' . $tribal_key . '.shg_id.required'] = "Please select valid tribal in $row_message";
                $messages['tribals.' . $tribal_key . '.shg_id.exists'] = "Please select valid tribal in $row_message";
                $messages['tribals.' . $tribal_key . '.bank_account_no.required'] = "Please select bank account no in $row_message";
                $messages['tribals.' . $tribal_key . '.bank_account_no.numeric'] = "Please select valid bank account no in $row_message";
                $messages['tribals.' . $tribal_key . '.village.required'] = "Please select village no in $row_message";
                $messages['tribals.' . $tribal_key . '.bank_ifsc.required'] = "Please select bank ifsc no in $row_message";

                $messages['tribals.' . $tribal_key . '.address.required'] = "Please select address in $row_message";
                $messages['tribals.' . $tribal_key . '.type.required'] = "Please select type in $row_message";
                $messages['tribals.' . $tribal_key . '.type.in'] = "Please select type in haat or procurement center $row_message";

                $messages['tribals.' . $tribal_key . '.procurement_date.required'] = "Please select  procurement date $row_message";

                $messages['tribals.' . $tribal_key . '.procurement_date.required'] = "Please select procurement date  in d/m/Y format $row_message";

                $messages['tribals.' . $tribal_key . '.proposal_id.required'] = "Please select proposal_id $row_message";
                $messages['tribals.' . $tribal_key . '.proposal_id.required'] = "Please select proposal_id $row_message";
                $messages['tribals.' . $tribal_key . '.amount_paid.required'] = "Please enter amount paid $row_message";
                $messages['tribals.' . $tribal_key . '.amount_paid.numeric'] = "Please enter amount paid numeric $row_message";
                $messages['tribals.' . $tribal_key . '.amount_paid.decimal_value'] = "amount paid should not contain more than 15 digits before decimal and more than 4 digits after decimal $row_message";
                $messages['tribals.' . $tribal_key . '.amount_payable.required'] = "Please enter amount payable $row_message";
                $messages['tribals.' . $tribal_key . '.amount_payable.numeric'] = "Please enter amount payable  numeric $row_message";
                $messages['tribals.' . $tribal_key . '.amount_payable.decimal_value'] = "amount payable should not contain more than 15 digits before decimal and more than 4 digits after decimal $row_message";

                if (!empty($mfp['mfp_details'])) {
                    $y=0;
                    foreach ($mfp['mfp_details'] as $key => $row) {
                        ++$y;
                        $mfp_row_message = " in " . $this->ordinal_suffix($y) . " record";
                        
                        $messages['tribals.' . $tribal_key . '.mfp_details.'.$key.'.mfp_id.required'] = "select mfp $row_message  ";
                        $messages['tribals.' . $tribal_key . '.mfp_details.'.$key.'.mfp_id.distinct'] = "Please select distinct mfp  $row_message";

                        $messages['tribals.' . $tribal_key . '.mfp_details.'.$key.'.qty.required'] = "Please select qty  $row_message";
                        $messages['tribals.' . $tribal_key . '.mfp_details.'.$key.'.qty.numeric'] = "Please select qty numeric $row_message";
                        $messages['tribals.' . $tribal_key . '.mfp_details.'.$key.'.value.required'] = "Please select value $row_message";
                        $messages['tribals.' . $tribal_key . '.mfp_details.'.$key.'.value.numeric'] = "Please select value numeric $row_message";

                    }
                }
                    
            }
        }
        
        
        return $messages;
    }
    public function validateMfpStorage($data)
    {
        return Validator::make(
            $data,
            [
                'id' => ['required','exists:mfp_procurement,ref_id'],
                'consolidated_id' => ['required','exists:mfp_procurement_actual_detail,consolidated_id'],
                'year_id' => ['required','exists:financial_year_master,id'],
                'mfp_storage_form.*.mfp_id' => ['required', 'exists:mfp_master,id'],
                'mfp_storage_form.*.mfp_qty' => ['required', 'numeric'],
                'mfp_storage_form.*.other.*.warehouse_id' => ['required', 'numeric'],
                'mfp_storage_form.*.other.*.haat_id.*' => ['required', 'numeric'],
                'mfp_storage_form.*.other.*.qty' => ['required', 'numeric'],
                'mfp_storage_form.*.other.*.value' => ['required', 'numeric'], 
            ],
             [
            'mfp_storage_form.*.other.*.haat_id.*.required' => 'Corresponding Haats field is required.',
            ] 
        );
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
            $total_fund_available=FundHelper::getFundAvailableAtPa();

            $user = Auth::user();
            $user_id=$user->id;
            $user_role=$user->role;
            if(isset($data['tribals']) && !empty($data['tribals']))
            {
                foreach ($data['tribals'] as $tribal_key => $mfp) 
                {
                    $detail=new Mfp_procurement_actual_detail();
                    $detail->ref_id = (string) Str::uuid();
                    $detail->id_type=$mfp['id_type'];
                    $detail->id_value=$mfp['id_value'];
                    $detail->shg_id=$mfp['shg_id'];
                    $detail->name_of_tribal=$mfp['name_of_tribal'];
                    $detail->bank_account_no=$mfp['bank_account_no'];
                    $detail->village=$mfp['village'];
                    $detail->bank_ifsc=$mfp['bank_ifsc'];
                    $detail->address=$mfp['address'];
                    $detail->type=$mfp['type'];
                    $detail->amount_paid=$mfp['amount_paid'];
                    $detail->amount_payable=$mfp['amount_payable'];
                    $detail->procurement_date=Carbon::createFromFormat('d/m/Y', $mfp['procurement_date']);
                    $detail->created_by=$user_id;        
                    $procurement=Mfp_procurement::where('ref_id',$mfp['proposal_id'])->first();
                    $detail->mfp_procurement_id=$procurement->id;
                    $detail->save();
                    
                    //update bank account in vdvk shg gatherer bank detail
                    $shgBankDetails=ShgBankDetails::where('shg_id',$mfp['shg_id'])->first();
                    $shgBankDetails->account_no=$mfp['bank_account_no'];
                    $shgBankDetails->save();

                    if(isset($mfp['mfp_details']) && !empty($mfp['mfp_details']))
                    {
                        $mfp_unique_arr=array();
                        foreach ($mfp['mfp_details'] as $key => $mfp_detail) 
                        {
                            
                            $quantity_relesed_against_proposalby_pa=Mfp_procurement_actual_detail_commodity::join('mfp_procurement_actual_detail', function($join) {
                              $join->on('mfp_procurement_actual_detail_commodity.action_detail_id', '=', 'mfp_procurement_actual_detail.id');
                            })
                            ->where('mfp_procurement_actual_detail.mfp_procurement_id',$procurement->id)
                            ->where('mfp_procurement_actual_detail_commodity.mfp_id',$mfp_detail['mfp_id'])
                            ->sum('mfp_procurement_actual_detail_commodity.qty');

                            if(!empty($mfp_detail['mfp_id']))
                            {
                                if(in_array($mfp_detail['mfp_id'], $mfp_unique_arr))
                                {
                                    throw new \Exception("please select distinct MFP for tribal ".$mfp['name_of_tribal']);
                                }
                                $mfp_unique_arr[]=$mfp_detail['mfp_id'];    
                            }
                            
                            $commodity=new Mfp_procurement_actual_detail_commodity();
                            $commodity->action_detail_id=$detail->id;
                            $commodity->mfp_id=$mfp_detail['mfp_id'];        
                            $commodity->qty=$mfp_detail['qty'];        
                            $commodity->value=$mfp_detail['value'];        
                            $commodity->created_by=$user_id;        
                            $commodity->save();

                            

                            $quantity_relesed_by_dia=Mfp_procurement_dia_release_commodity::where(['mfp_procurement_id'=>$procurement->id,'procurement_agent'=>$user->id,'mfp_id'=>$mfp_detail['mfp_id']])->sum('qty');
                            
                            $total_qty=$quantity_relesed_against_proposalby_pa+$mfp_detail['qty'];
                            
                            $balance_qty_can_release=$quantity_relesed_by_dia-$quantity_relesed_against_proposalby_pa;
                            $mfp_name = $this->get_mfp_name($mfp_detail['mfp_id']);
                            if($total_qty > $quantity_relesed_by_dia)
                            {
                                throw new \Exception("You can not release quantity more than $balance_qty_can_release for $mfp_name");
                                
                            }

                        }
                    }
                }
            }
            
            

            $actual_tribal_amount_paid=Mfp_procurement_actual_detail::where('mfp_procurement_id',$procurement->id)->sum('amount_paid');
            $procurement->actual_tribal_amount_paid=$actual_tribal_amount_paid;
            $procurement->save();


            /*
            get total released to PA
            then check if total amount is not greater than total released amount of PA
            */
            //$total_released_to_procurement_agent_by_dia=$procurement->getDiaReleasedToProcurementsAgent->sum('total_released_to_procurement_agent');



            $total_released_to_procurement_agent_by_dia=FundHelper::getFundAvailableAtPa();


            //$total_amount_released_to_pa=$procurement->actual_tribal_amount_paid + $procurement->total_mfp_storage_value+$procurement->total_overhead_paid_value;
			
			$total_amount_released_to_pa=$procurement->actual_tribal_amount_paid;

            


            $balance_can_pay=$total_released_to_procurement_agent_by_dia - $total_amount_released_to_pa;

            $actual_tribal_amount_paid=$procurement->actual_tribal_amount_paid;
            $total_mfp_storage_value=$procurement->total_mfp_storage_value;
            $total_overhead_paid_value=$procurement->total_overhead_paid_value;
            if($total_amount_released_to_pa > $total_fund_available)
            {
                throw new \Exception("You are using in actual tribal detail $actual_tribal_amount_paid,You have used in mfp storage $total_mfp_storage_value,You have used in overhead $total_overhead_paid_value which is greater than Available amount i.e $total_fund_available");
            }


            //==Add User Activity
            $activity='added tribal detail form of reference number '.$detail->ref_id;
            $module='mfp_procurement_tribal_detail_form';
            $this->addUserActivity($activity,$module);
            DB::commit();
            return $detail;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function getOne($id)
    {
        return Mfp_procurement_actual_detail::where('ref_id',$id)->first();
    }
     public function getMfpStoragedata($id){
        return Mfp_storage_actual::where(['ref_id'=>$id])->first();
    }
    public function addMfpStorageDetails($data)
    {
       DB::beginTransaction();
        try {
            $total_fund_available=FundHelper::getFundAvailableAtPa();
            $user = Auth::user();
            $user_id=$user->id;
            
            $procurement = Mfp_procurement::where('ref_id',$data['id'])->first();
            $procurement_actual_detail = Mfp_procurement_actual_detail::where('consolidated_id',$data['consolidated_id'])->first();
            $procurement_actual_detail->is_procurement_details_submitted = 1;
            $procurement_actual_detail->save();

            if(isset($data['mfp_storage_form']) && !empty($data['mfp_storage_form']))
            {
                foreach ($data['mfp_storage_form'] as $key => $mfp) {                    
                    $storage = new Mfp_storage_actual();                          
                    $storage->ref_id = $data['id'];      
                    $storage->year_id = $data['year_id'];        
                    $storage->mfp_id = $mfp['mfp_id'];        
                    $storage->mfp_qty = $mfp['mfp_qty'];    
                    $storage->created_by = $user_id;    
                    $storage->mfp_procurement_id = $procurement->id;
                    $storage->tribal_consolidated_id = $data['consolidated_id'];
                    $storage->save();

                    foreach ($mfp['other'] as $key => $value) {
                        $otherdata = new Mfp_storage_actual_other();
                        $otherdata->mfp_action_detail_id = $storage->id;
                        $otherdata->warehouse_id = $value['warehouse_id'];        
                        //$otherdata->haat_id = $value['haat_id'];        
                        $otherdata->qty = $value['qty'];  
                        $otherdata->value = $value['value'];                          
                        $otherdata->mfp_procurement_id = $procurement->id;
                        $otherdata->created_by = $user_id; 
                        $otherdata->save();
                           foreach ($value['haat_id'] as $key => $val) {
                                $otherhaat = new Mfp_storage_actual_haat();
                                $otherhaat->mfp_storage_actua_other_id = $otherdata->id;
                                $otherhaat->haat_id = $val; 
                                $otherhaat->save();    
                         }
                    }
                }
            }
            $total_mfp_storage_value=Mfp_storage_actual_other::where('mfp_procurement_id',$procurement->id)->sum('value');
            $procurement->total_mfp_storage_value=$total_mfp_storage_value;
            $procurement->save();

            /*
            get total released to PA
            then check if total amount is not greater than total released amount of PA
            */
            //$total_released_to_procurement_agent_by_dia=$procurement->getDiaReleasedToProcurementsAgent->sum('total_released_to_procurement_agent');
            $total_released_to_procurement_agent_by_dia=FundHelper::getFundAvailableAtPa();

           // $total_amount_released_to_pa=$procurement->actual_tribal_amount_paid + $procurement->total_mfp_storage_value+$procurement->total_overhead_paid_value;
			
			$total_amount_released_to_pa=$procurement->total_mfp_storage_value;

            $balance_can_pay=$total_released_to_procurement_agent_by_dia - $total_amount_released_to_pa;

            
            $actual_tribal_amount_paid=$procurement->actual_tribal_amount_paid;
            $total_mfp_storage_value=$procurement->total_mfp_storage_value;
            $total_overhead_paid_value=$procurement->total_overhead_paid_value;
            if($total_amount_released_to_pa > $total_fund_available)
            {
                throw new \Exception("You are using in mfp storage $total_mfp_storage_value,You have used in actual tribal detail $actual_tribal_amount_paid,You have used in overhead $total_overhead_paid_value which is greater than Available amount i.e $total_fund_available");
            }
            //==Add User Activity
            $activity='added Mfp Storage detail ';
            $module='mfp_procurement_tribal_detail_form';
            $this->addUserActivity($activity,$module);
            DB::commit();
            return $storage;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

    }

 public function updateMfpStorageDetails($id,$data)
    { //echo $data['id']; die('dd');
       DB::beginTransaction();
        try {
            $total_fund_available=FundHelper::getFundAvailableAtPa();
            $user = Auth::user();
            $user_id=$user->id;
            $user_role=$user->role;

            if(isset($data['mfp_storage_form']) && !empty($data['mfp_storage_form']))
            {
                 Mfp_storage_actual_other::where('mfp_action_detail_id', $id)->forceDelete();
                 Mfp_storage_actual::where('ref_id', $data['id'])->forceDelete();
                foreach ($data['mfp_storage_form'] as $key => $mfp) {                    
                    $storage = new Mfp_storage_actual();       
                   $storage->ref_id = $data['id'];        
                    $storage->year_id = $data['year_id'];        
                    $storage->mfp_id = $mfp['mfp_id'];        
                    $storage->mfp_qty = $mfp['mfp_qty'];    
                    $storage->created_by = $user_id;
                    $storage->save();

                    foreach ($mfp['other'] as $key => $value) { 
                        $otherdata = new Mfp_storage_actual_other();
                        $otherdata->mfp_action_detail_id = $storage->id;
                        $otherdata->warehouse_id = $value['warehouse_id'];        
                        $otherdata->haat_id = $value['haat_id'];        
                        $otherdata->qty = $value['qty'];  
                        $otherdata->value = $value['value'];  
                        $otherdata->created_by = $user_id; 
                        $otherdata->save();
                    }
                }
            }
            //==Add User Activity
            $activity='updated Mfp Storage detail ';
            $module='mfp_procurement_tribal_detail_form';
            $this->addUserActivity($activity,$module);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

    }

    public function getMfpStorageDetails($id)
    {  
        return Mfp_storage_actual::where('ref_id',$id)->get();
    }

    public function getTransactionDetails($request){
        $columns = array(
            0 => 'id',
        );
        $limit = isset($request['length']) ? $request['length'] : 10;
        
        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 'id';

        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC';
      
        $query = $this->actualdetailQuery->viewAllTransactionQuery();
       
        
        if (isset($request['proposal_id']) && !empty($request['proposal_id'])) {
            $query->where('mfp_procurement_id',$request['proposal_id']);
           
        }
        
        $query = $query->orderBy($order, $dir);
        if (isset($request['page']) && !empty($request['page'])) {
            return $query->paginate($limit);
        } else {
            return $query->get();
           
        }    
    }

    public function validateTribalTransactionIds($data){
        return Validator::make($data, [
            'tribal_transaction'=>'required|exists:mfp_procurement_actual_detail,id',
        ]
    
    );
    }
    public function validateTransactionIds($data){
        return Validator::make($data, [
            'transactions'=>'required|exists:mfp_procurement_transaction,transaction_id',
        ]
    
    );
    }


    /**
     * Conslidate procurement transactions
     * 
     */

    public function consolidate_procurement_transaction($request, $district, $year_id)
    {
        $user = Auth::user();
        $user_id = $user->id;
        
        $user_info = User::where([
            'id' => $user_id
        ])->with([
            'getUserDetails'
        ])->first();
         
        $user_data = $user_info->toArray();
        $user_details = $user_data['get_user_details'];
        $user_district = $user_details['district'];
        $user_created_by = $user_details['created_by'];
        if (isset($request['transactions']) && !empty($request['transactions'])) {
            DB::beginTransaction();
            try {
                //==============create consolidate===========
                $mfp_procurement_consolidated = new Mfp_procurement_consolidated_transaction();
                $mfp_procurement_consolidated->created_by = $user_id;
                $mfp_procurement_consolidated->updated_by = $user_id;
                $mfp_procurement_consolidated->save();

                $reference_number = $user_district . '_' . $mfp_procurement_consolidated->id;
                $consolidated = Mfp_procurement_consolidated_transaction::findOrFail($mfp_procurement_consolidated->id);
                $consolidated->reference_number = $reference_number;
                $consolidated->district = $user_district;
                $consolidated->year_id = $year_id;
                $consolidated->save();
                //==========================Maintain logs for transactions =================
                foreach ($request['transactions'] as $key => $transaction) {
                    $procurement_transaction = Mfp_procurement_transaction::where('transaction_id', $transaction)->first();
                   
                   
                    //get next User of this transaction from scrutiny
                    $procurement = Mfp_procurement::with('getUserDetails')->where('id',$procurement_transaction->mfp_procurement_id)->first();
                    //dd($procurement);
                    $proposal_user_state = $procurement->getUserDetails->state;
                   
                    //Get Min sublevel of DIA role 
                    $next_level = StateRoleSubLevel::where(['state_id'=>$proposal_user_state,'role_id'=> 6])->min('sublevel_id');
                    
                    $next_user = User::whereHas('getUserDetails', function (Builder $query) use ($next_level,$proposal_user_state) {
                        $query->where('role',6);
                        $query->where('state', $proposal_user_state);    
                        $query->where('level_id', $next_level);
                        
                    })->first();
                    
                    $next_user = User::where('id',$next_user->id)->first();

                    $logs = new Mfp_procurement_transaction_status_log();
                    $logs->transaction_id = $procurement_transaction->transaction_id;
                    $logs->reference_id = $district;
                    $logs->assigned_by = $user_id;
                    $logs->assigned_to = $next_user->id;
                    $logs->status = 0;
                    $logs->is_assigned_next_level = '1';
                    $logs->consolidated_id = $consolidated->id;
                    $logs->created_by = $user_id;
                    $logs->updated_by = $user_id;
                    $logs->save();

                   //update transaction consolidated id
                   $procurement_transaction->transaction_consolidated_id = $mfp_procurement_consolidated->id;
                   //$procurement_transaction->current_status = 0;
                   $procurement_transaction->district_id = $user_district;
                   $procurement_transaction->year_id = $year_id;
                   $procurement_transaction->save();
          
                }
                $to = User::findOrFail($next_user->id);
                //==Add User Activity
                $activity = 'Send proposal to next level user'.$to->user_name.' transaction id - '.$procurement_transaction->id;
                $module = 'mfp_procurement_aproval';
                 $this->addUserActivity($activity,$module);

                 $consolidated->assigned_to = $next_user->id;
                 $consolidated->assigned_by = $user_id;
                 $consolidated->save();

                //===Send Notification========

                $from = User::findOrFail($next_user->id);
                $to->notify(new MfpProcurementTransactionConsolidatedNextLevel($consolidated,$from));
                //throw new \Exception("Error Processing Request");
                
                DB::commit();
                return $procurement_transaction;
            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }
        }
    }

    public function getConsolidatedTransactionList($request){
        $columns = array(
            0 => 'mfp_procurement_consolidated_transaction.id',
        );
        $limit = isset($request['length']) ? $request['length'] : 10;
        
        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 'id';
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC';
        $user = Auth::user();
        $query = Mfp_procurement_consolidated_transaction::with(['getMfpProcurementTransaction']);
        $query = $query->where('reference_number','!=','');
        //show dia user only those record which was assigned to him
        if($user->role == 6){
            $query->orWhere('assigned_to','=',$user->id);
        }
        if (isset($request['status']) && $request['status'] != '') 
        {
            $query = $query->where('current_status',$request['status']);
        }
        if (isset($request['district']) && !empty($request['district'])) 
        {
            $query = $query->where('district',$request['district']);
        }
      

        if($user->role == 7){
            $query  = $query->where('created_by' ,$user->id)  ;
        }

        if($user->role == 1||$user->role == 2||$user->role == 3||$user->role == 4||$user->role == 5){
            $query = $query->where('current_status',1);
        }
      
        $query = $query->orderBy($order, $dir);
        if (isset($request['page']) && !empty($request['page'])) {
            return $query->paginate($limit);
        } else {
            return $query->get();
        }            
    }

    public function approveRevertRejectTransaction($request){
        if($request){
            DB::beginTransaction();
            try {
                if (!empty($request['transaction_id'])) {
                    $user = Auth::user();   
                    $user_id = $user->id;
                    $procurement_transaction_status_log = Mfp_procurement_transaction_status_log::where(['consolidated_id'=>$request['transaction_id'],'assigned_to'=>$user_id])->orderBy('id','desc')->first();
                    //if request is reverted 
                    if($request['transaction_status'] == 2){
                        
                        //reset consolidated id in main table
                        $procurement_transaction = Mfp_procurement_transaction::where('transaction_consolidated_id',$request['transaction_id'])->first();

                        $status_log['consolidated_id']= $procurement_transaction['consolidated_id'];
                        $status_log['status'] = 2;
                        $status_log['created_by'] = $user_id;
                        $status_log['updated_by'] = $user_id;
                        $status_log['assigned_to']= $procurement_transaction['created_by'];
                        $status_log['assigned_by']=$user_id;
                        
                        $newstatuslog = new Mfp_procurement_transaction_status_log($status_log);
                        $newstatuslog->save();  //assigned to previous user
                 
                        // //reset consolidated id in status log table
                        // $procurement_transaction_status_log->assigned_to = $procurement_transaction['assigned_by'];
                        // $procurement_transaction_status_log->assigned_by = $user_id;
                       
                        //reset final consolidation table
                        $consolidated_transaction = Mfp_procurement_consolidated_transaction::where('id',$request['transaction_id'])->first();
                        $consolidated_transaction->reference_number = null;
                        $consolidated_transaction->current_status = $request['transaction_status'];
                        $consolidated_transaction->remarks = $request['remarks'];
                        $consolidated_transaction->assigned_to = $procurement_transaction['created_by'];
                        $consolidated_transaction->assigned_by = $user_id;
                       
                        $consolidated_transaction->save();

                         //reset id
                         $procurement_transaction->transaction_consolidated_id = null;
                         $procurement_transaction->save();

                    }

                    //if request is rejected
                    if($request['transaction_status'] == 3){
                        
                        //reset consolidated id in main table
                        $procurement_transaction = Mfp_procurement_transaction::where('transaction_consolidated_id',$request['transaction_id'])->first();
                        
                        $status_log['consolidated_id']= $procurement_transaction['consolidated_id'];
                        $status_log['status'] = 2;
                        $status_log['created_by'] = $user_id;
                        $status_log['updated_by'] = $user_id;
                        $status_log['assigned_to']= $procurement_transaction['created_by'];
                        $status_log['assigned_by']=$user_id;
                        
                        $newstatuslog = new Mfp_procurement_transaction_status_log($status_log);
                        $newstatuslog->save();  //assigned to previous user
                 

                        
                        //reset final consolidation table
                        $consolidated_transaction = Mfp_procurement_consolidated_transaction::where('id',$request['transaction_id'])->first();
                        $consolidated_transaction->reference_number = null;
                        $consolidated_transaction->current_status = $request['transaction_status'];
                        $consolidated_transaction->remarks = $request['remarks'];
                        $consolidated_transaction->assigned_to = $procurement_transaction['assigned_by'];
                        $consolidated_transaction->assigned_by = $user_id;
                        $consolidated_transaction->save();

                        //reset id
                        $procurement_transaction->transaction_consolidated_id = null;
                        $procurement_transaction->save();
                    }

                    if($request['transaction_status'] == 1){
                         //in transaction table
                        $consolidated_transaction = Mfp_procurement_consolidated_transaction::where('id',$request['transaction_id'])->first();
                        $proposal_data = $consolidated_transaction->getMfpProcurementTransaction;

                        if(!empty($proposal_data))
                        {
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
                                        $total_mfp = $release_fund->total_mfp;
                                        $total_qty = $release_fund->total_quantity;
                                        $total_val = $release_fund->total_value;
                                        $received_fund = $received_fund + $release_fund->total_released_to_procurement_agent;
                                        //$remarks = isset($this->getMfpTransaction->statusLog->remarks)?$this->getMfpTransaction->statusLog->remarks:'N/A';
                                    }else{
                                        $total_mfp = $release_fund->total_mfp;
                                        $total_qty = $release_fund->total_quantity;
                                        $total_val = $release_fund->total_value;
                                        $received_fund = $received_fund + $release_fund->total_released_to_procurement_agent;
                                        //$transaction_status = $proposal_row->statusLog->status;
                                        
                                    }
                                }
                                
                                
                            
                            }
                            $total_fund_utilized = $tribal_costs + $storage_costs +$packing_material_cost + $labour_charges + $weightment_charges + $service_charges + $transportation_charges + $warehouse_labour_charges + $warehouse_charges + $estimated_wastages +$service_charges_dia+ $other_costs;
                            
                            $procurement_agent_role_id=7;
                            $commission_data=FundHelper::getCommission($total_fund_utilized,$procurement_agent_role_id);
                            
                            $commission_amount=$commission_data['commission_amount'];
                            $max_aggregate_commission=$commission_data['max_aggregate_commission'];
                            $commission_rate=$commission_data['commission_rate'];
                            $remaining_amount=$total_fund_utilized-$commission_amount;

                            $consolidated_transaction->commission_amount=$commission_amount;
                            $consolidated_transaction->commission_rate=$commission_rate;
                            $consolidated_transaction->remaining_amount=$remaining_amount;
                        }
                        $consolidated_transaction->current_status = $request['transaction_status'];
                        $consolidated_transaction->remarks = $request['remarks'];
                        $consolidated_transaction->save(); 
                    }
                   
                 
                    //if request is approved
                    $procurement_transaction_status_log->status = $request['transaction_status'];
                    $procurement_transaction_status_log->remarks = $request['remarks'];
                    $procurement_transaction_status_log->updated_by = $user_id;
                    $procurement_transaction_status_log->save();
                    DB::commit();
                    return $procurement_transaction_status_log;
                }
            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }
            
        }

    }

     public function deleteMfpStorageDetails($request)
    {
        DB::beginTransaction();
        try {
            $id = $request['id'];    
            Mfp_storage_actual_other::where('mfp_action_detail_id', $id)->delete(); 
            Mfp_storage_actual::where('id', $id)->delete(); 
            //==Add User Activity
            $activity='deleted Actual mfp Storage haat block ';
            $module='mfp_procurement';
            $this->addUserActivity($activity,$module);
            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            return false;
        }
    }

    public function get_mfp_name($mfp_id){
        $mfp= Mfp::where('id',$mfp_id)->first();   
        return $mfp->getMfpName->title;
    }

    public function consolidate_tribal_transaction($request){
        $user = Auth::user();
        $user_id = $user->id;
        
        $user_info = User::where([
            'id' => $user_id
        ])->with([
            'getUserDetails'
        ])->first();
         
        $user_data = $user_info->toArray();
        $user_details = $user_data['get_user_details'];
        $user_district = $user_details['district'];
        
        if (isset($request['tribal_transaction']) && !empty($request['tribal_transaction'])) {
            DB::beginTransaction();
            try {
            
                //==============create consolidate===========
                $mfp_procurement_consolidated = new Mfp_procurement_consolidated_tribal_transaction();
              
                $mfp_procurement_consolidated->created_by = $user_id;
                $mfp_procurement_consolidated->updated_by = $user_id;
                $mfp_procurement_consolidated->save();
                $reference_number = $user_district . '_' . $mfp_procurement_consolidated->id;
                $consolidated = Mfp_procurement_consolidated_tribal_transaction::findOrFail($mfp_procurement_consolidated->id);
                $consolidated->reference_number = $reference_number;
                $consolidated->save();
            
                //==========================Maintain logs for transactions =================
                foreach ($request['tribal_transaction'] as $key => $transaction) {
                    $procurement_transaction = Mfp_procurement_actual_detail::where('id', $transaction)->first();
                    $procurement_transaction->consolidated_id = $consolidated->id;
                    $procurement_transaction->save();            
                }
                DB::commit();
                return $procurement_transaction;
            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }
        }    
    }

    public function validateReceipt($data){
        return Validator::make(
            $data,
            [
                'receipt' => 'nullable|mimes:pdf|max:20480',
                'actual_storage_other_id' => [
                    'required', 'exists:mfp_procurement_actual_mfp_storage_other,id',
                ]
                
            ]
        );
    }

    public function upload_receipt($data){
        DB::beginTransaction();
       
        try {
            $user_id = Auth::user()->id;    
            $warehouse_data = Mfp_storage_actual_other::where('id',$data['actual_storage_other_id'])->first();
            $warehouse_data->is_uploaded = 1;
            $warehouse_data->uploaded_by = $user_id;
            $warehouse_data->uploaded_on = date('Y-m-d H:i:s');
            $warehouse_data->receipt_path = isset($data['receipt'])?$data['receipt']:'';
            $warehouse_data->save();
            DB::commit();
            return true;

        }catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

    }

    public function getFundAvailableAtPa()
    {
        return FundHelper::getFundAvailableAtPa();       
    }

}