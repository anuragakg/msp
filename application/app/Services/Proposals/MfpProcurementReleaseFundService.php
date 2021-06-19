<?php

namespace App\Services\Proposals;

use App\Models\Actiondetail\Mfp_procurement_actual_detail_commodity;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Masters\Mfp;
use App\Models\Proposals\Mfp_procurement_consolidated;
use App\Models\Proposals\Mfp_procurement;
use App\Models\Mfp_procurement_sanctioned;
use App\Models\Mfp_procurement_fund_released;
use App\Models\Mfp_procurement_fund_released_history;
use App\Models\Mfp_procurement_fund_received_history;


use App\Models\Mfp_procurement_dia_release;
use App\Models\Mfp_procurement_dia_release_summary;
use App\Models\Mfp_procurement_dia_release_bank;
use App\Models\Mfp_procurement_dia_release_commodity;

use App\Models\Proposals\Mfp_procurement_scrutiny_level_history;
use App\Models\Proposals\Mfp_procurement_status_log;
use App\Models\Proposals\Mfp_storage_actual_other;
use App\Services\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Notifications\MfpProcurementFundReleased;
use App\Notifications\MfpProcurementFundReceived;
use App\Notifications\MfpProcurementDiaReleased;
use App\Queries\ProcurementQuery;
use App\Queries\FundReceivedProcurementAgentQuery;
use App\Queries\ProcurementAgentListQuery;
use App\Queries\DiaCommissionListQuery;
use App\Queries\SiaCommissionListQuery;
use DateTime;
use DB;
use FundHelper;
use Illuminate\Support\Facades\Date;

class MfpProcurementReleaseFundService extends Service
{
    private $procurementQuery;
    private $fundReceivedProcurementAgentQuery;
    private $procurementAgentListQuery;
    private $diaCommissionListQuery;
    private $siaCommissionListQuery;

    public function __construct(ProcurementQuery $procurementQuery = null, FundReceivedProcurementAgentQuery $FundReceivedProcurementAgentQuery = null, ProcurementAgentListQuery $ProcurementAgentListQuery = null,DiaCommissionListQuery $diaCommissionListQuery=null,SiaCommissionListQuery $siaCommissionListQuery=null)
    {
        $this->procurementQuery = $procurementQuery;
        $this->fundReceivedProcurementAgentQuery = $FundReceivedProcurementAgentQuery;
        $this->procurementAgentListQuery = $ProcurementAgentListQuery;
        $this->diaCommissionListQuery = $diaCommissionListQuery;
        $this->siaCommissionListQuery = $siaCommissionListQuery;
    }

    public function getAll($request)
    {
        $user_id = Auth::user()->id;
        $columns = array(
            0 => 'mfp_procurement_fund_released.id',

        );
        $limit = isset($request['length']) ? $request['length'] : 10;


        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 'id';
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC';
        $query = Mfp_procurement_fund_released::where('assigned_to', $user_id);
        $query = $query->leftJoin('mfp_procurement_consolidation', function ($join) {
            $join->on('mfp_procurement_fund_released.consolidated_id', '=', 'mfp_procurement_consolidation.id');
        });
        $query = $query->orderBy($order, $dir);

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            $search = $request['search']['value'];
            $query = $query->where(DB::raw("CONCAT(`file_number`,`mfp_procurement_consolidation`.`reference_number`)"), 'LIKE', "%" . $search . "%");
        }
        if (isset($request['status']) && $request['status'] != '') {
            $query = $query->where('is_released', $request['status']);
        }
          if (isset($request['file_number']) && !empty($request['file_number'])) { 
             $query->where(DB::raw("CONCAT(`file_number`)"), 'LIKE', "%".$request['file_number']."%");
        }
        $query = $query->select('mfp_procurement_fund_released.*');
        if (isset($request['page']) && !empty($request['page'])) {
            return $query->paginate($limit);
        } else {
            //$query=$query->where('status','1');
            return $query->get();
        }
    }
    public function getReleaseDetails($id)
    {
        $user_id = Auth::user()->id;
        return Mfp_procurement_fund_released::where(['assigned_to' => $user_id, 'id' => $id])->first();
    }


    public function validateCreate($data)
    {
        return Validator::make(
            $data,
            [
                'id' => 'required|exists:mfp_procurement_fund_released,id',
                'bank_name' => 'required|exists:mysql2.bank_master,id',
                'release_percent' => 'required|numeric',
                'account_number' => 'required|numeric|digits_between:5,20|not_in:0',
                'release_amount' => 'required|numeric|min:0|decimal_value',
                'transaction_date' => 'required|date_format:d/m/Y',
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

            $user = Auth::user();
            $user_id = $user->id;
            $user_role = $user->role;
            $release = Mfp_procurement_fund_released::where(['id' => $data['id'], 'assigned_to' => $user_id])->first();

            if (!empty($release)) {
                $bank_name = $data['bank_name'];
                $release_percent = $data['release_percent'];
                $account_number = $data['account_number'];

                $release_amount = $data['release_amount'];
                
                $commission_data=FundHelper::getCommission($release_amount);

                $commission_amount=$commission_data['commission_amount'];
                $commission_rate=$commission_data['commission_rate'];
                $release_amount=$release_amount-$commission_amount;
                $total_release = $release->released_amount + $release_amount;
                $total_commission=$release->commission_amount+$commission_amount;
                $total_released_amount=$total_release+$total_commission;
                $max_can_release = $release->max_can_release;
                if ($total_released_amount > $max_can_release) {
                    throw new \Exception("You can not release more than $total_release");
                }
                $release->released_amount = $total_release;
                $release->commission_amount = $total_commission;
                $release->save();

                $total_amount_released=$release->released_amount+$release->commission_amount;
                $max_can_release=$release->max_can_release;
                $release->balance_amount=$max_can_release-$total_amount_released;
                if($total_amount_released==$max_can_release)    
                {
                    $release->is_released=1;
                }else if($release->released_amount>0){
                    $release->is_released=2;
                }else{
                    $release->is_released=0;
                }
                $release->save();
                FundHelper::checkAccessCommision($release);
                //add logs in another table
                $release_history = new Mfp_procurement_fund_released_history();
                $release_history->release_id = $release->id;
                $release_history->consolidated_id = $release->consolidated_id;
                $release_history->bank_name = $data['bank_name'];
                $release_history->release_percent = $data['release_percent'];
                $release_history->release_amount = $release_amount;
                $release_history->commission_amount = $commission_amount;
                $release_history->commission_rate = $commission_rate;
                $release_history->account_number = $data['account_number'];
                $release_history->transaction_date = Carbon::createFromFormat('d/m/Y', $data['transaction_date']);
                $release_history->created_by = $user_id;
                $release_history->save();


                
                $account_number=$data['account_number'];
                $fund_data['debit']=$release_amount;
                $fund_data['credit']=$commission_amount;
                $fund_data['user_id']=$user_id;
                $fund_data['particulars']="Fund released to account number $account_number and commission received Rs.$commission_amount by rate $commission_rate % ";
                
                FundHelper::addFundTransactions($fund_data);

                /*
                *1.get next user for release amount
                    a)get scrutiny level from history
                    b)get upper level user from status logs
                */
                //=======a)get scrutiny level from history of any sigle mfp procurement ==========
                $procurement = Mfp_procurement::where('consolidated_id', $release->consolidated_id)->first();
                $current_scrutiny_history = Mfp_procurement_scrutiny_level_history::where(['mfp_procurement_id' => $procurement->id, 'role_id' => $user_role])->orderBy('id', 'DESC')->first();

                $previous_role_scrutiny_history = Mfp_procurement_scrutiny_level_history::where('id', '<', $current_scrutiny_history->id)
                    ->where('mfp_procurement_id', $procurement->id)
                    ->where('role_id', '!=', $user_role)
                    ->orderBy('id', 'DESC')
                    ->first();

                /*$logs=Mfp_procurement_status_log::where(['assigned_to'=>$user_id,'consolidated_id'=>$release->consolidated_id,'is_assigned_next_level'=>'1','status'=>'1'])->orderBy('id','desc')->first();*/

                $logs = Mfp_procurement_status_log::leftJoin('users', function ($join) {
                    $join->on('mfp_procurement_status_log.assigned_to', '=', 'users.id');
                })
                    ->where('users.role', $previous_role_scrutiny_history->role_id)
                    ->where(['mfp_procurement_status_log.mfp_procurement_id' => $procurement->id, 'mfp_procurement_status_log.is_assigned_next_level' => '1', 'mfp_procurement_status_log.status' => 1])
                    ->orderBy('mfp_procurement_status_log.id', 'desc')
                    ->select('mfp_procurement_status_log.*')
                    ->first();



                $consolidated_id = $release->consolidated_id;

                $consolidated_row = Mfp_procurement_consolidated::where(['id' => $consolidated_id])->first();
                $total_sancioned = Mfp_procurement_sanctioned::where(['consolidated_id' => $consolidated_id])->sum('sanctioned_amount');


                if ($previous_role_scrutiny_history->role_id != 6) {
                    $next_user_id = $logs->assigned_to;
                    $lookup = [
                        'consolidated_id' => $consolidated_id,
                        'assigned_to' => $next_user_id,
                    ];
                    $already_existed = Mfp_procurement_fund_released::where($lookup)->first();
                    if (empty($already_existed)) {
                        Mfp_procurement_fund_released::insert(
                            [

                                'consolidated_id' => $consolidated_id,
                                'assigned_to' => $next_user_id,
                                'approved_amount' => $consolidated_row->approved_amount,
                                'sanctioned_amount' => $total_sancioned,
                                'max_can_release' => $release_amount,
                                'is_released' => 0,
                            ]
                        );
                    } else {
                        $already_existed->sanctioned_amount = $total_sancioned;
                        $already_existed->max_can_release = $already_existed->max_can_release + $release_amount;
                        $already_existed->is_released = 0;
                        $already_existed->save();
                    }
                    $fund_data=array();
                    $fund_data['credit']=$release_amount;
                    $fund_data['debit']=0;
                    $fund_data['user_id']=$next_user_id;
                    $fund_data['particulars']="Fund received  ";
                    FundHelper::addFundTransactions($fund_data);
                    //add notification
                    $fund_released = Mfp_procurement_fund_released::where($lookup)->first();
                    $to = User::findOrFail($next_user_id);
                    $from = User::findOrFail($user_id);
                    $to->notify(new MfpProcurementFundReleased($fund_released, $from, $data['release_amount']));
                } else {
                    //===distribute 
                    $consolidation_row = Mfp_procurement_consolidated::findOrFail($consolidated_id);
                    $approved_amount = $consolidation_row->approved_amount;
                    $procurements = Mfp_procurement::where(['consolidated_id' => $consolidated_id, 'status' => 1])->get();


                    foreach ($procurements as $key => $procurement) {
                        $summary = $procurement->getSummary;
                        $total_fund_require = isset($summary->total_fund_require) ? $summary->total_fund_require : 0;

                        $released_amount = ($total_fund_require / $approved_amount) * $release_amount;
                        $mfp_procurement = Mfp_procurement::findOrFail($procurement->id);
                        if ($mfp_procurement->has_released_to_procurement_agent == 1 || $mfp_procurement->has_released_to_procurement_agent == 2) {
                            $mfp_procurement->has_released_to_procurement_agent = 2;
                        }
                        $mfp_procurement->is_released = 1;
                        $mfp_procurement->released_amount = $mfp_procurement->released_amount + $released_amount;
                        $mfp_procurement->save();

                        $fund_received = new Mfp_procurement_fund_received_history();
                        $fund_received->mfp_procurement_id = $procurement->id;
                        $fund_received->release_percent = $data['release_percent'];
                        $fund_received->released_amount = $released_amount; //$data['release_amount'];

                        $fund_received->bank_name = $data['bank_name'];
                        $fund_received->account_number = $data['account_number'];
                        $fund_received->transaction_date = Carbon::createFromFormat('d/m/Y', $data['transaction_date']);
                        $fund_received->created_by = $user_id;
                        $fund_received->save();


                        $fund_data=array();
                        $fund_data['credit']=$release_amount;
                        $fund_data['debit']=0;
                        $fund_data['user_id']=$mfp_procurement->created_by;
                        $fund_data['particulars']="Fund received  for proposal id".$mfp_procurement->proposal_id;
                        FundHelper::addFundTransactions($fund_data);
                        $to = User::findOrFail($procurement->created_by);
                        $from = User::findOrFail($user_id);
                        $to->notify(new MfpProcurementFundReceived($mfp_procurement, $from, $released_amount));
                    }

                   
                }

                //================================================================================
            }
            //==Add User Activity
            $consolidated = Mfp_procurement_consolidated::where('id', $release->consolidated_id)->first();
            $activity = 'Fund release Rs.' . $release_amount . ' of consolidation id ' . $consolidated->reference_number;
            $module = 'mfp_procurement_fund_release';
            $this->addUserActivity($activity, $module);
            DB::commit();
            return $release;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function getReleasedFundDetails($id)
    {
        $user_id = Auth::user()->id;
        return Mfp_procurement_fund_released::where(['id' => $id])->first();
    }
    public function getMfpProcurementFundReceivedList($request)
    {
        $user_id = Auth::user()->id;
        $columns = array(
            0 => 'id',
            1 => 'proposal_id',

        );
        $limit = $request['length'];


        $order = $columns[$request['order'][0]['column']];
        $dir = $request['order'][0]['dir'];

        $query = $this->procurementQuery->viewAllQuery($request);
        $query->where('is_released', 1);
        $query->where('mfp_procurement.created_by', $user_id);
        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            $search = $request['search']['value'];
            $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%" . $search . "%");
        }
        if (isset($request['status']) && $request['status'] != '') {
            $query->where('has_released_to_procurement_agent', $request['status']);
        }
        if (isset($columns[$request['order'][0]['column']]) && !empty($columns[$request['order'][0]['column']])) {
            $query->orderBy($order, $dir);
        }
        return $query->paginate($limit);
    }
    public function getMfpProcurementReceivedFundLogs($id)
    {
        return Mfp_procurement_fund_received_history::where('mfp_procurement_id', $id)->get();
    }
    public function getMfpProcurementReceivedCommission($id)
    {
        return Mfp_procurement_dia_release_bank::where('mfp_procurement_id', $id)->get();
    }
    public function getAllMfpProcurementCommission($request)
    {
        $user_id = Auth::user()->id;
        $columns = array(
            0 => 'id',
        );
        $limit = isset($request['length']) ? $request['length'] : 10;


        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 'id';
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC';
        $query = $this->diaCommissionListQuery->viewAllQuery($request);
        $query = $query->orderBy($order, $dir);

        
        if (isset($request['page']) && !empty($request['page'])) {
            return $query->paginate($limit);
        } else {
            return $query->get();
        }
    }
    public function getSiaMfpProcurementCommission($request)
    {
        $user_id = Auth::user()->id;
        $columns = array(
            0 => 'id',
        );
        $limit = isset($request['length']) ? $request['length'] : 10;


        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 'id';
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC';
        $query = $this->siaCommissionListQuery->viewAllQuery($request);
        $query = $query->orderBy($order, $dir);
       /* if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            $search = $request['search']['value'];
            $query->where(DB::raw("CONCAT(`consolidated_id`)"), 'LIKE', "%" . $search . "%");
        }*/
        
        if (isset($request['page']) && !empty($request['page'])) {
            return $query->paginate($limit);
        } else {
            return $query->get();
        }
    }
    public function getMfpProcurementReceivedFundData($id)
    {
        return Mfp_procurement::where('ref_id', $id)->first();
    }


    public function getProcurementAgentList()
    {
        $agent = $this->procurementAgentListQuery->viewAllQuery();
        return $agent->get();
        //return User::where(['role'=>7,'created_by'=>$user_id])->get();
    }
    public function validateCreateDiaReleaseFund($data)
    {
        $messages = $this->validation_messages($data);
        return Validator::make(
            $data,
            [
                'id' => 'required|exists:mfp_procurement,ref_id',
                'procurement_agent.*' => 'required|exists:users,id|distinct',
                'mfp_details.*.mfp_id.*' => 'required|exists:mfp_master,id',
                'mfp_details.*.qty.*' => 'required|numeric|decimal_value_qty',
                'mfp_details.*.value.*' => 'required|numeric|decimal_value',

                'total_msp_count.*' => 'required|numeric',
                'total_quantity.*' => 'required|numeric',
                'total_value.*' => 'required|numeric|decimal_value',

                'fund_release.*.bank_id.*' => 'required|exists:mysql2.bank_master,id',
                'fund_release.*.account_no.*' => 'required|numeric|digits_between:5,20|not_in:0',
                'fund_release.*.release_amount.*' => 'required|numeric|decimal_value',
                'fund_release.*.transaction_date.*' => 'required|date_format:d/m/Y',
            ],
            $messages
        );
    }
    public function validation_messages($data)
    {
        $i = 0;
        //dd($data);
        if (isset($data['procurement_agent']) && !empty($data['procurement_agent'])) {
            foreach ($data['procurement_agent'] as $agent_key => $value) {
                //Mfp_procurement_dia_release_commodity
                if (isset($data['mfp_details'][$agent_key]['mfp_id']) && !empty($data['mfp_details'][$agent_key]['mfp_id'])) {
                    foreach ($data['mfp_details'][$agent_key]['mfp_id'] as $mfp_key => $mfp) {
                        $messages['mfp_details.' . $agent_key . '.mfp_id.' . $mfp_key . '.distinct'] = "Please select unique mfp ";
                        $messages['mfp_details.' . $agent_key . '.value.' . $mfp_key . '.decimal_value'] = "value should not contain more than 6 digits before decimal and more than 4 digits after decimal ";
                    }
                }
                //Bank
                if (isset($data['fund_release'][$agent_key]['bank_id']) && !empty($data['fund_release'][$agent_key]['bank_id'])) {
                    foreach ($data['fund_release'][$agent_key]['bank_id'] as $bank_key => $bank) {
                        $messages['fund_release.' . $agent_key . '.bank_id.' . $bank_key . '.required'] = "Please select bank ";
                        $messages['fund_release.' . $agent_key . '.account_no.' . $bank_key . '.numeric'] = "Please select valid account no ";
                        $messages['fund_release.' . $agent_key . '.release_amount.' . $bank_key . '.numeric'] = "Please enter number in release amount ";
                        $messages['fund_release.' . $agent_key . '.release_amount.' . $bank_key . '.decimal_value'] = "release_amount should not contain more than 15 digits before decimal and more than 4 digits after decimal ";
                        $messages['fund_release.' . $agent_key . '.account_no.' . $bank_key . '.digits_between'] = "Please enter account number digits length 5-20";
                        $messages['fund_release.' . $agent_key . '.account_no.' . $bank_key . '.not_in'] = "Please enter valid account number ";
                    }
                }
            }
        }
        //dd($messages);
        // if(isset($data['mfp_details']) && !empty($data['mfp_details']))
        // {
        //     foreach ($data['mfp_details'] as $key => $mfp) 
        //     {
        //         ++$i;
        //         $row_message = " in " . $this->ordinal_suffix($i) . " record";
        //         dd($mfp);
        //         foreach($mfp as $key1=>$mfpRow){

        //             $messages['mfp_details.' . $key . '.mfp_id'.$key1.'distinct'] = "Please select unique mfp $row_message";
        //             $messages['mfp_details.' . $key . '.qty'.$key1.'numeric'] = "Please enter number in quantity $row_message";
        //             $messages['mfp_details.' . $key . '.value'.$key1.'numeric'] = "Please enter number in value $row_message";
        //         }


        //     }
        // }
        return $messages;
    }
    public function addDiaReleaseFundToProcurementAgent($data, $procurement, $seasonalibility)
    {
        DB::beginTransaction();
        try {

            $user = Auth::user();
            $user_id = $user->id;
            $user_role = $user->role;
            $seasonalibility_arr = array();
            if (!empty($seasonalibility)) {
                foreach ($seasonalibility as $key => $seasonal) {

                    $mfp_id = $seasonal['mfp_id'];
                    $seasonalibility_arr[$mfp_id] = array(
                        'mfp_id' => $seasonal['mfp_id'],
                        'mfp_name' => $seasonal['mfp_name'],
                        'qty' => $seasonal['qty'],
                        'master_value' => $seasonal['master_value'],
                    );
                }
            }

            if (!empty($procurement)) {
                $mfp_quantity_posted = array();
                if (isset($data['procurement_agent']) && !empty($data['procurement_agent'])) {
                    foreach ($data['procurement_agent'] as $agent_key => $value) {
                        //Mfp_procurement_dia_release_commodity
                        if (isset($data['mfp_details'][$agent_key]['mfp_id']) && !empty($data['mfp_details'][$agent_key]['mfp_id'])) {
                            foreach ($data['mfp_details'][$agent_key]['mfp_id'] as $mfp_key => $mfp) {
                                if (isset($mfp_quantity_posted[$mfp])) {
                                    $mfp_quantity_posted[$mfp] = $mfp_quantity_posted[$mfp] + $data['mfp_details'][$agent_key]['qty'][$mfp_key];
                                } else {
                                    $mfp_quantity_posted[$mfp] = $data['mfp_details'][$agent_key]['qty'][$mfp_key];
                                }
                            }
                        }
                    }
                    if (!empty($mfp_quantity_posted)) {
                        foreach ($mfp_quantity_posted as $key => $posted) {
                            if (isset($seasonalibility_arr[$key])) {
                                if ($mfp_quantity_posted[$key] > $seasonalibility_arr[$key]['qty']) {
                                    $maxquantity = $seasonalibility_arr[$key]['qty'];
                                    $mfp_name = ucwords($seasonalibility_arr[$key]['mfp_name']);
                                    throw new \Exception("You can not add quantity more than $maxquantity of MFP $mfp_name");
                                }
                            }
                        }
                    }
                }
                //Mfp_procurement_dia_release
                if (isset($data['procurement_agent']) && !empty($data['procurement_agent'])) {
                    foreach ($data['procurement_agent'] as $agent_key => $value) {
                        $release = new Mfp_procurement_dia_release();
                        $procurement_agent = $value;
                        $release->mfp_procurement_id = $procurement->id;
                        $release->procurement_agent = $procurement_agent;
                        $release->total_mfp = $data['total_msp_count'][$agent_key];
                        $release->total_quantity = $data['total_quantity'][$agent_key];
                        $release->total_value = $data['total_value'][$agent_key];
                        $release->created_by = $user_id;
                        $release->save();


                        $lookup = [
                            'mfp_procurement_id' => $procurement->id,
                            'procurement_agent' => $procurement_agent,
                        ];
                        $summary = Mfp_procurement_dia_release_summary::updateOrCreate(
                            $lookup,
                            [
                                'mfp_procurement_id' => $procurement->id,
                                'procurement_agent' => $procurement_agent,
                                'created_by' => $user_id,
                            ]
                        );

                        /*$release->mfp_procurement_id=$procurement->id;
                        $release->procurement_agent=$data['procurement_agent'];
                        $release->total_mfp=$data['total_msp_count'];
                        $release->total_quantity=$data['total_quantity'];
                        $release->total_value=$data['total_value'];
                        $release->created_by=$user_id;
                        $release->save();*/
                        // dd($data);
                        $already_released_amount = Mfp_procurement_dia_release_bank::where('mfp_procurement_id', $procurement->id)->sum('release_amount');
                        $already_commissioned_amount = Mfp_procurement_dia_release_bank::where('mfp_procurement_id', $procurement->id)->sum('commission_amount');
                        //Mfp_procurement_dia_release_bank
                        $total_release = 0;$total_commission=0;
                        if (isset($data['fund_release'][$agent_key]['bank_id']) && !empty($data['fund_release'][$agent_key]['bank_id'])) {
                            foreach ($data['fund_release'][$agent_key]['bank_id'] as $bank_key => $bankdata) {
                                
                                //$total_release += $data['fund_release'][$agent_key]['release_amount'][$bank_key];
                                $release_amount=$data['fund_release'][$agent_key]['release_amount'][$bank_key];
                                $commission_data=FundHelper::getCommission($release_amount);

                                $commission_amount=$commission_data['commission_amount'];
                                $commission_rate=$commission_data['commission_rate'];
                                
                                $release_amount=$release_amount-$commission_amount;
                                $total_release +=$release_amount;
                                $bank = new Mfp_procurement_dia_release_bank();
                                $bank->mfp_procurement_dia_release_id = $release->id;
                                $bank->mfp_procurement_id = $procurement->id;
                                $bank->procurement_agent = $procurement_agent;
                                $bank->bank_id = $bankdata;
                                $bank->account_no = $data['fund_release'][$agent_key]['account_no'][$bank_key];
                                $bank->release_amount = $release_amount;
                                $bank->commission_amount = $commission_amount;
                                $bank->commission_rate = $commission_rate;
                                $transaction_date = Carbon::createFromFormat('d/m/Y', $data['fund_release'][$agent_key]['transaction_date'][$bank_key]);
                                $bank->transaction_date = $transaction_date;
                                //if(strtotime($transaction_date))
                                if (strtotime($transaction_date) < strtotime($procurement->approval_date)) {
                                    $approval_date = date('d-m-Y', strtotime($procurement->approval_date));
                                    throw new \Exception("Transaction date shoud not be less than proposal approval date - $approval_date");
                                }

                                $bank->created_by = $user_id;

                                $bank->save();

                                $fund_data=array();
                                $fund_data['credit']=$commission_amount;
                                $fund_data['debit']=$release_amount;
                                $fund_data['user_id']=$user_id;
                                $fund_data['particulars']="Fund released to procurement agent for proposal id ".$procurement->proposal_id." and commission received $commission_rate%";
                                FundHelper::addFundTransactions($fund_data);

                                $fund_data=array();
                                $fund_data['credit']=$release_amount;
                                $fund_data['debit']=0;
                                $fund_data['user_id']=$procurement_agent;
                                $fund_data['particulars']="Fund received proposal id ".$procurement->proposal_id;
                                FundHelper::addFundTransactions($fund_data);

                                
                            }
                        }


                        $release->total_released_to_procurement_agent = $total_release;
                        
                        $release->save();

                        $released_amount = Mfp_procurement_dia_release_bank::where('mfp_procurement_id', $procurement->id)->sum('release_amount');
                        $total_commission_amount = Mfp_procurement_dia_release_bank::where('mfp_procurement_id', $procurement->id)->sum('commission_amount');

                        $balance_can_release = $procurement->released_amount - ($already_released_amount+$already_commissioned_amount);
                        $total_release_amount=$released_amount+$total_commission_amount;
                        if ($total_release_amount > $procurement->released_amount) {
                            //throw new \Exception("Earlier You have already released $already_released_amount.You can not release more than $balance_can_release"); 
                            throw new \Exception("You can not release more than $balance_can_release");
                        }
                        if ($total_release_amount == $procurement->released_amount) {
                            $procurement->has_released_to_procurement_agent = 1; //fully released
                        } else {
                            $procurement->has_released_to_procurement_agent = 2; //partially released
                        }
                        $procurement->released_amount_procurement_agent = $total_release_amount; //partially released
                        $procurement->commission_amount = $total_commission_amount; //partially released
                        $procurement->save();
                        //Check access Commission for DIA
                        FundHelper::checkDiaAccessCommision($procurement);
                        
                        //Mfp_procurement_dia_release_commodity
                        $unique_mfp = [];
                        if (isset($data['mfp_details'][$agent_key]['mfp_id']) && !empty($data['mfp_details'][$agent_key]['mfp_id'])) {
                            foreach ($data['mfp_details'][$agent_key]['mfp_id'] as $mfp_key => $mfp) {
                                $unique_mfp[] = $mfp;

                                $total_mfp_qty_already_released = Mfp_procurement_dia_release_commodity::where(['mfp_procurement_id' => $procurement->id, 'mfp_id' => $mfp])->sum('qty');

                                $commodity = new Mfp_procurement_dia_release_commodity();
                                $commodity->mfp_procurement_dia_release_id = $release->id;
                                $commodity->mfp_procurement_id = $procurement->id;
                                $commodity->procurement_agent = $procurement_agent;
                                $commodity->mfp_id = $mfp;
                                $commodity->qty = $data['mfp_details'][$agent_key]['qty'][$mfp_key];
                                $commodity->value = $data['mfp_details'][$agent_key]['value'][$mfp_key];
                                $commodity->created_by = $user_id;
                                $commodity->save();

                                /*
                                Check total quantity of commodity
                                */
                                $total_mfp_qty = Mfp_procurement_dia_release_commodity::where(['mfp_procurement_id' => $procurement->id, 'mfp_id' => $mfp])->sum('qty');
                                if ($total_mfp_qty > $seasonalibility_arr[$mfp]['qty']) {
                                    $maxquantity = $seasonalibility_arr[$mfp]['qty'];
                                    $mfp_name = ucwords($seasonalibility_arr[$mfp]['mfp_name']);
                                    throw new \Exception("You have already released $total_mfp_qty_already_released quantity of MFP $mfp_name.You can not add quantity more than $maxquantity of MFP $mfp_name");
                                }
                            }
                        }

                        if (count($unique_mfp) > count(array_unique($unique_mfp))) {
                            throw new \Exception("Please select unique mfp");
                        }
                        $already_released_amount_to_pa = Mfp_procurement_dia_release_bank::where(['mfp_procurement_id' => $procurement->id, 'procurement_agent' => $procurement_agent])->sum('release_amount');

                        $getCommodityData = Mfp_procurement_dia_release_commodity::where(['mfp_procurement_id' => $procurement->id, 'procurement_agent' => $procurement_agent]);

                        $total_quantity = $getCommodityData->sum('qty');
                        $total_value = $getCommodityData->sum('value');
                        $total_commodity = $getCommodityData->distinct('mfp_id')->count('mfp_id');
                        if (empty($summary->ref_id)) {
                            $summary->ref_id = (string) Str::uuid();
                        }
                        $summary->total_value = $total_value;
                        $summary->total_mfp = $total_commodity;
                        $summary->total_quantity = $total_quantity;
                        $summary->total_released_to_procurement_agent = $already_released_amount_to_pa;
                        $summary->save();
                        //send notification to procurement agent
                        $to = User::findOrFail($procurement_agent);
                        $from = User::findOrFail($user_id);
                        $to->notify(new MfpProcurementDiaReleased($procurement, $from, $total_release));


                        //==Add User Activity
                        $activity = 'Fund release by DIA of Rs.' . $total_release . ' of proposal id ' . $procurement->proposal_id . ' to procurement agent ' . $to->user_name;
                        $module = 'mfp_procurement_fund_release';
                        $this->addUserActivity($activity, $module);
                    }
                }
            } else {
                throw new \Exception("You are not allowed to perform this action for this proposal id");
            }
            DB::commit();
            return $release;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function getFundReceivedProcurementAgent($request)
    {
        $user_id = Auth::user()->id;
        $columns = array(
            0 => 'id',
            1 => 'proposal_id',

        );
        $limit = $request['length'];

        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 0;
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : '';

        $query = $this->fundReceivedProcurementAgentQuery->viewAllQuery($request);
        $query->whereHas('getMfps', function (Builder $query) use ($request) {
            if (isset($request['mfp_id']) && !empty($request['mfp_id'])) {
                $query->where('mfp_id', $request['mfp_id']);
            }
        });

        if (isset($columns[$request['order'][0]['column']]) && !empty($columns[$request['order'][0]['column']])) {
            $query->orderBy($order, $dir);
        }
        return $query->paginate($limit);
    }


    public function getFundReceivedProcurementAgentDetail($request)
    {
        $user_id = Auth::user()->id;

        $summary = Mfp_procurement_dia_release_summary::where('ref_id', $request['ref_id'])->first();
        $data['mfp_procurement_id'] = $summary->mfp_procurement_id;
        $data['procurement_agent'] = $summary->procurement_agent;
        $user = User::where('id', $summary->procurement_agent)->first();
        $data['procurement_agent_name'] = $user->user_name;
        return $data;
        //$summary['procurement_agent']
        // dd($summary);




    }
    public function getReleaseCommodityCount($mfp_procurement_id, $procurement_agent, $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'proposal_id',

        );
        $limit = $request['length'];
        $query = Mfp_procurement_dia_release::whereHas('commodity_details', function (Builder $query) use ($request) {
            if (isset($request['mfp_id']) && !empty($request['mfp_id'])) {
                $query->where('mfp_id', $request['mfp_id']);
            }
        })
            ->where(['mfp_procurement_id' => $mfp_procurement_id, 'procurement_agent' => $procurement_agent]);

        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 0;
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : '';


        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 0;
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : '';


        if (isset($columns[$request['order'][0]['column']]) && !empty($columns[$request['order'][0]['column']])) {
            $query->orderBy($order, $dir);
        }
        return $query->paginate($limit);
    }
    public function getFundReleaseDetail($id)
    {
        return Mfp_procurement_dia_release::where('id', $id)->first();
    }
    public function getMfpProcurementPAFundReceivedList($request)
    {
        $user_id = Auth::user()->id;
        $columns = array(
            0 => 'id',
            1 => 'proposal_id',

        );
        $limit = $request['length'];

        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 0;
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : '';

        $query = $this->fundReceivedProcurementAgentQuery->viewAllQuery($request);
        // if(isset($request['search']['value']) && !empty($request['search']['value']))
        // {
        //     $search = $request['search']['value'];         
        //     $query->where(DB::raw("CONCAT(`proposal_id`)"), 'LIKE', "%".$search."%");
        // }
        if (isset($columns[$request['order'][0]['column']]) && !empty($columns[$request['order'][0]['column']])) {
            $query->orderBy($order, $dir);
        }
        return $query->paginate($limit);
    }
    public function getMfpProcurementAgentMfpList($id)
    {
        $getCommodityData = Mfp_procurement_dia_release_commodity::where(['procurement_agent' => $id])->distinct('mfp_id')->pluck('mfp_id');
        return Mfp::whereIn('id', $getCommodityData)->get();
    }

    public function getMfpProcurementReceivedFund($id)
    { //echo $id; die('dd');
        return Mfp_procurement::where('ref_id', $id)->first();
    }

    public function getWarehouseTransactionList($request)
    {
        $user_id = Auth::user()->id;
        $columns = array(
            0 => 'id',
            //1=> 'warehouse_id',

        );
        $limit = $request['length'];
        DB::enableQueryLog();
        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 0;
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : '';
        //where('created_by',$user_id)->    
        $query = Mfp_storage_actual_other::whereHas('getActualStorage', function (Builder $query) use ($request) {
            if (isset($request['mfp']) && !empty($request['mfp'])) {
                $query->where('mfp_id', $request['mfp']);
            }
            if (isset($request['warehouse']) && !empty($request['warehouse'])) {
                $query->where('warehouse_id', $request['warehouse']);
            }
            if (isset($request['haat']) && !empty($request['haat'])) {
                $query->where('haat_id', $request['haat']);
            }
            if (isset($request['proposal_id']) && !empty($request['proposal_id'])) {
                $query->where('mfp_procurement_id', $request['proposal_id']);
            }
            if (isset($request['status']) && !empty($request['status'])) {
                if ($request['status'] == 2) {
                    $query->where('is_uploaded', '!=', 1);
                } else {
                    $query->where('is_uploaded', $request['status']);
                }
            }

            if ((isset($request['from_date']) && !empty($request['from_date'])) && (isset($request['to_date']) && !empty($request['to_date']))) {
                $from_date = Carbon::createFromFormat('d/m/Y', $request['from_date']);
                $from_date->format('Y-m-d');
                $from_date = date('Y-m-d', strtotime($from_date));
                $to_date = Carbon::createFromFormat('d/m/Y', $request['to_date']);
                $to_date->format('Y-m-d');
                $to_date = date('Y-m-d', strtotime($to_date));

                //dd($from_date);
                //$from_date = date('Y-m-d',strtotime($request['from_date']));
                //$to_date = date('Y-m-d',strtotime($request['to_date']));
                $query->whereRaw("DATE(uploaded_on) BETWEEN " . "'$from_date'" . " AND " . "'$to_date'");
            }
        });



        if (isset($columns[$request['order'][0]['column']]) && !empty($columns[$request['order'][0]['column']])) {
            $query->orderBy($order, $dir);
        }
        return $query->paginate($limit);
    }

    public function getReleasedDetailsToProcurementagent($ref_id){
        $user_id = Auth::user()->id;
        //Get released mfp details for this proposal
        $procurement = Mfp_procurement::where('ref_id',$ref_id)->first();
        $proposal_realease_details = Mfp_procurement_dia_release::with(['commodity_details.getMfpName.getMfpName'])->where(['mfp_procurement_id'=>$procurement->id,'procurement_agent'=>$user_id])->get();
        return $proposal_realease_details;
    }
}
