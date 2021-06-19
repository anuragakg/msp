<?php

namespace App\Services\Proposals;
use Carbon\Carbon;
use App\Models\Proposals\Mfp_procurement;
use App\Models\User;
use App\Models\Proposals\Mfp_procurement_consolidated;
use App\Models\Mfp_procurement_sanctioned;
use App\Models\Proposals\Mfp_procurement_status_log;
use App\Models\SanctionLetter;
use App\Models\Mfp_procurement_fund_released;
use App\Services\Service;
use App\Queries\SanctionQuery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use App\Models\Masters\StateRoleSubLevel;
use Helper;
use DB;

class MfpProcurementSanctionService extends Service
{
    private $procurementQuery;
    private $planService;

    public function __construct(SanctionQuery $sanctionQuery=null)
    {
        $this->sanctionQuery = $sanctionQuery;
    }
    public function getAll($request)
    {
        $columns = array(
            0 => 'id',
            1 => 'file_number',
            2 => 'transaction_id',
            6 => 'sanctioned_amount',
            8 => 'created_at',
        );
        $limit = isset($request['length']) ? $request['length'] : 10;


        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 'id';
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC';
        $query = $this->sanctionQuery->viewAllQuery($request);
        $query = $query->orderBy($order, $dir);

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            $search = $request['search']['value'];
            $query->where(DB::raw("CONCAT(`file_number`,`transaction_id`,`sanctioned_amount`)"), 'LIKE', "%".$search."%");
        }
        if (isset($request['page']) && !empty($request['page'])) {
            return $query->paginate($limit);
        } else {
            //$query=$query->where('status','1');
            return $query->get();
        }
    }
    public function getConsolidateDetails($id)
    {
        return Mfp_procurement_sanctioned::findOrFail($id);
    }
    public function validateCreate($data)
    {
        $model = new Mfp_procurement_consolidated();
        $sanction=Mfp_procurement_sanctioned::where('id',$data['id'])->first();
        return Validator::make(
            $data,
            [
                'id' => 'required|exists:mfp_procurement_sanction,id',
                'file_number' => ['required','string','max:50',
                    Rule::unique($model->getTable())->ignore($sanction->consolidated_id)
                ],
                'sanction_date' => 'required|date_format:d/m/Y',
                'sanctioned_amount' => 'required|numeric|decimal_value',
                'transaction_id' => ['required','string','max:50','unique:mfp_procurement_sanction_letter'],
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
            
            $user_id = Auth::user()->id;
            
            $sanction=Mfp_procurement_sanctioned::where('id',$data['id'])->first();
            if(!empty($sanction))
            {
                $balance_amount=$sanction->balance_amount;
                $sanctioned_amount=$sanction->sanctioned_amount;
                $approved_amount=$sanction->approved_amount;
                
                /*$procurement = Mfp_procurement::where('id', $data['id'])->first();
                $proposal_date=date('Y-m-d', strtotime($procurement->created_at)); 
                $trans_date=date('Y-m-d', strtotime($data['transaction_date']));
                 if ($proposal_date > $trans_date) {
                      throw new \Exception("Transaction date should not be before date from the Proposal filled date");
                 } */

                // if($sanction->balance_amount < $data['sanctioned_amount'])
                // {
                //     throw new \Exception("Sanctioned amount should not be greater than balance amount RS. $balance_amount");   
                // }
                //check maximum_sanction_percent of Balance amount
                $total_sanctioned_amount=$sanctioned_amount + $data['sanctioned_amount'];

                $maximum_can_sanctioned=($approved_amount*$sanction->maximum_sanction_percent)/100;
				$maximum_can_sanctioned = Helper::decimalNumberFormat($maximum_can_sanctioned);
				$total_sanctioned_amount = Helper::decimalNumberFormat($total_sanctioned_amount);
				
                if( $total_sanctioned_amount > $maximum_can_sanctioned )
                {
                    throw new \Exception("Sanctioned amount $total_sanctioned_amount can not be greater than 75% of approved amount i.e $maximum_can_sanctioned");   
                }
				
                $consolidation_balance_amount=$maximum_can_sanctioned-$total_sanctioned_amount;
                if($consolidation_balance_amount==0)
                {
                    $sanction->is_sanctioned=1;
                }else{
                    $sanction->is_sanctioned=2;//partially sanctioned
                }
                
                $sanction->transaction_id = $data['transaction_id'];
                $sanction->transaction_date = Carbon::createFromFormat('d/m/Y', $data['transaction_date']);
                $sanction->balance_amount=$balance_amount-$data['sanctioned_amount'];
                $sanction->sanctioned_amount=$total_sanctioned_amount;
                //dd($sanction->balance_amount);
                $sanction->save();

                $SanctionLetter = new SanctionLetter();
                $SanctionLetter->sanctioned_amount = $data['sanctioned_amount'];

                $SanctionLetter->file_number = $data['file_number'];
                $SanctionLetter->sanction_date = Carbon::createFromFormat('d/m/Y', $data['sanction_date']);
                $SanctionLetter->transaction_id = $data['transaction_id'];
                $SanctionLetter->transaction_date = Carbon::createFromFormat('d/m/Y', $data['transaction_date']);

                $SanctionLetter->consolidated_id = $sanction->consolidated_id;
                $SanctionLetter->created_by = $user_id;
                $SanctionLetter->updated_by = $user_id;
                $SanctionLetter->save();

                
                /*
                    1.Assigned to nodal officer
                    2.check if already existed before insert
                    3.send notification
                */
                $logs= Mfp_procurement_status_log::leftJoin('users', function($join) {
                  $join->on('mfp_procurement_status_log.assigned_to', '=', 'users.id');
                })
                ->leftJoin('user_roles', function($join) {
                  $join->on('users.role', '=', 'user_roles.id');
                })
                ->where('users.role',4)//nodal officer
                ->where(['consolidated_id'=>$sanction->consolidated_id])->orderBy('mfp_procurement_status_log.id','desc')->first();

                $total_sancioned=Mfp_procurement_sanctioned::where(['consolidated_id'=>$sanction->consolidated_id])->sum('sanctioned_amount');
                
                $consolidated_row=Mfp_procurement_consolidated::where(['id'=>$sanction->consolidated_id])->first();
                $consolidated_row->file_number = $data['file_number'];
               // $consolidated_row->sanction_date = date('Y-m-d',strtotime($data['sanction_date']));
                $consolidated_row->sanction_date = Carbon::createFromFormat('d/m/Y', $data['sanction_date']);
              
                /*$consolidated_row->transaction_id = $data['transaction_id'];
                $consolidated_row->transaction_date = date('Y-m-d',strtotime($data['transaction_date']));*/

                $consolidated_row->sanctioned_amount=$total_sancioned;
                $consolidated_row->balance_amount=$consolidated_row->approved_amount-$total_sancioned;
                $consolidated_row->save();
                if(empty($logs))
                {
                    $state=$sanction->getConsolidation->state;
                    
                   $nodelLevel = StateRoleSubLevel::where('state_id',$state)->where('role_id',4)->max('sublevel_id');
					
				   $user=User::whereHas('getUserDetails', function (Builder $query) use ($state,$nodelLevel) {
                        $query->where('role', 4);
                        $query->where('state', $state);
                        $query->where('level_id', $nodelLevel);
                        
                    })->first();
					if(empty($user)){
						throw new \Exception("No user is find for nodal level ");   
					}
					$assigned_to=$user->id;
                                     
                }else{
					$assigned_to=$logs->assigned_to;
				}
                
                    $lookup=[
                        'consolidated_id'=>$sanction->consolidated_id,
                        'assigned_to'=>$assigned_to,
                    ];

                    $already_existed=Mfp_procurement_sanctioned::where($lookup)->first();
                    if(empty($already_existed))
                    {
                        $maximum_sanction_percent=25;//nodal level
                        $balance_amount=($sanction->approved_amount*$maximum_sanction_percent)/100;
                        $balance_amount = Helper::decimalNumberFormat($balance_amount);
                        $logs= Mfp_procurement_sanctioned::insert(
                            [
                                'is_state_share'=>1,
                                'consolidated_id'=>$sanction->consolidated_id,
                                'assigned_to'=>$assigned_to,
                                'approved_amount'=>$sanction->approved_amount,
                                'balance_amount'=>$balance_amount,
                                'maximum_sanction_percent'=>$maximum_sanction_percent,
                                'is_sanctioned'=>0,
                            ]
                        );
                    }
                

            }
            //==Add User Activity
            $consolidated=Mfp_procurement_consolidated::where('id',$sanction->consolidated_id)->first();
            $activity='Sanction Rs.'.$data['sanctioned_amount'].' of consolidation id '.$consolidated->reference_number;
            $module='mfp_procurement_fund_sanctioned';
            $this->addUserActivity($activity,$module);
            DB::commit();
            return $sanction;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function validateStateSanctionLetter($data)
    {
        $model = new Mfp_procurement_consolidated();
        $sanction=Mfp_procurement_sanctioned::where('id',$data['id'])->first();
        return Validator::make(
            $data,
            [
                'id' => 'required|exists:mfp_procurement_sanction,id',
                'sanctioned_amount' => 'required|numeric|decimal_value',
                'transaction_id' => ['required','string','max:50','unique:mfp_procurement_sanction_letter'],
                'transaction_date' => 'required|date_format:d/m/Y',
            ]
        );
    }

    public function addStateSanctionLetter($data)
    {
        DB::beginTransaction();
        try {
            
            $user_id = Auth::user()->id;
            
            $sanction=Mfp_procurement_sanctioned::where('id',$data['id'])->first();
            if(!empty($sanction))
            {
                $balance_amount=$sanction->balance_amount;
                $sanctioned_amount=$sanction->sanctioned_amount;
                $approved_amount=$sanction->approved_amount;
                
                if($sanction->balance_amount < $data['sanctioned_amount'])
                {
                    throw new \Exception("Sanctioned amount should not be greater than balance amount RS. $balance_amount");   
                }
                //check maximum_sanction_percent of Balance amount
                $total_sanctioned_amount=$sanctioned_amount + $data['sanctioned_amount'];

                $maximum_can_sanctioned=($approved_amount*$sanction->maximum_sanction_percent)/100;
				$maximum_can_sanctioned = Helper::decimalNumberFormat($maximum_can_sanctioned);
                if( $total_sanctioned_amount > $maximum_can_sanctioned )
                {
                    throw new \Exception("Sanctioned amount can not be greater than 25% of approved amount i.e $maximum_can_sanctioned");   
                }

                
                $consolidation_balance_amount=$maximum_can_sanctioned-$total_sanctioned_amount;
                if($consolidation_balance_amount==0)
                {
                    $sanction->is_sanctioned=1;
                }else{
                    $sanction->is_sanctioned=2;//partially sanctioned
                }
                $sanction->transaction_id = $data['transaction_id'];
                $sanction->transaction_date = Carbon::createFromFormat('d/m/Y', $data['transaction_date']);
                $sanction->balance_amount=$balance_amount-$data['sanctioned_amount'];
                $sanction->sanctioned_amount=$total_sanctioned_amount;
                $sanction->save();

                $consolidated_row=Mfp_procurement_consolidated::where(['id'=>$sanction->consolidated_id])->first();

                $SanctionLetter = new SanctionLetter();
                $SanctionLetter->sanctioned_amount = $data['sanctioned_amount'];
                $SanctionLetter->file_number = $consolidated_row->file_number;
                //$SanctionLetter->sanction_date = date('Y-m-d',strtotime($data['sanction_date']));
                $SanctionLetter->transaction_id = $data['transaction_id'];
                $SanctionLetter->transaction_date = Carbon::createFromFormat('d/m/Y', $data['transaction_date']);
                $SanctionLetter->consolidated_id = $sanction->consolidated_id;
                $SanctionLetter->created_by = $user_id;
                $SanctionLetter->updated_by = $user_id;
                $SanctionLetter->save();

                $total_sancioned=Mfp_procurement_sanctioned::where(['consolidated_id'=>$sanction->consolidated_id])->sum('sanctioned_amount');
                
                
                
                
                $consolidated_row->sanctioned_amount=$total_sancioned;
                $consolidated_row->balance_amount=$consolidated_row->approved_amount-$total_sancioned;
                $consolidated_row->save();
               

                $lookup=[
                    'consolidated_id'=>$consolidated_row->id,
                    'assigned_to'=>$user_id,
                ];


                $already_existed=Mfp_procurement_fund_released::where($lookup)->first();
                if(empty($already_existed))
                {
                    Mfp_procurement_fund_released::insert(
                        [
                        
                            'consolidated_id'=>$consolidated_row->id,
                            'assigned_to'=>$user_id,
                            'approved_amount'=>$consolidated_row->approved_amount,
                            'sanctioned_amount'=>$total_sancioned,
                            'max_can_release'=>$total_sancioned,
                            'is_released'=>0,
                        ]
                    );
                }else{
                    $already_existed->sanctioned_amount=$total_sancioned;
                    $already_existed->max_can_release=$total_sancioned;
                    $already_existed->is_released=0;
                    $already_existed->save();
                }
            }
            //==Add User Activity
            $consolidated=Mfp_procurement_consolidated::where('id',$sanction->consolidated_id)->first();
            $activity='Sanction Rs.'.$data['sanctioned_amount'].' of consolidation id '.$consolidated->reference_number;
            $module='mfp_procurement_fund_sanctioned';
            $this->addUserActivity($activity,$module);
            DB::commit();
            return $sanction;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function viewMfpProcurementSanctionHistory($id)
    {
        $sanctioned_data= Mfp_procurement_sanctioned::findOrFail($id);
        $consolidated_id=$sanctioned_data->consolidated_id;
        return SanctionLetter::where('consolidated_id',$consolidated_id)->get();
    }
    public function getMfpProcurementReleaseList($request)
    {
        $user_id = Auth::user()->id;
        $columns = array(
            0 => 'id',
            1 => 'file_number',
            2 => 'transaction_id',
            6 => 'sanctioned_amount',
            8 => 'created_at',
        );
        $limit = isset($request['length']) ? $request['length'] : 10;


        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 'id';
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC';
        $query = Mfp_procurement_fund_released::where('assigned_to',$user_id);
        $query = $query->orderBy($order, $dir);

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            $search = $request['search']['value'];
            $query->where(DB::raw("CONCAT(`file_number`,`transaction_id`,`sanctioned_amount`)"), 'LIKE', "%".$search."%");
        }
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
        return Mfp_procurement_fund_released::where(['assigned_to'=>$user_id,'id'=>$id])->first();
        
    }
    public function getUserSanctionedList($consolidated_id)
    {
        $user_id = Auth::user()->id;
        return SanctionLetter::where(['created_by'=>$user_id,'consolidated_id'=>$consolidated_id])->get();
        
    }

    public function getSanctionedListAmountLog($request)
    {
        $user = Auth::user();
        $user_id = $user->id;
        $user_role = $user->role;
        $where=array();
        if(isset($request['assigned_to']) && !empty($request['assigned_to']))
        {
            $where['created_by']=$request['assigned_to'];
        }
        if(isset($request['consolidated_id']) && !empty($request['consolidated_id']))
        {
            $where['consolidated_id']=$request['consolidated_id'];
        }
        return SanctionLetter::where($where)->get();
        
    }
}
