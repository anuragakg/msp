<?php

namespace App\Services\Proposals;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Proposals\Mfp_procurement;
use App\Models\Actualdetail\Mfp_procurement_actual_detail;
use App\Models\Actualdetail\Mfp_procurement_generate_receipt;
use App\Services\Service;
use App\Queries\ProcurementReceiptQuery;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;


use DB;

class MfpProcurementGenerateReceiptService extends Service
{
    
    public function __construct(ProcurementReceiptQuery $procurementReceiptQuery=null)
    {
        $this->procurementReceiptQuery = $procurementReceiptQuery;
    }
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getAll($request)
    {
        $columns = array(
            0 => 'id',
            1 => 'id',
            //6 => 'storage_capacity',
        );
        $limit = isset($request['length']) ? $request['length'] : 10;


        $order = isset($columns[$request['order'][0]['column']]) ? $columns[$request['order'][0]['column']] : 'id';
        $dir = isset($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'DESC';
        $query = $this->procurementReceiptQuery->viewAllQuery();
        $query = $query->orderBy($order, $dir);

        if (isset($request['actual_detail_ref_id']) && !empty($request['actual_detail_ref_id'])) {
            $actual_detail=Mfp_procurement_actual_detail::where('ref_id',$request['actual_detail_ref_id'])->first();
            if(!empty($actual_detail))
            {
                $actual_detail_id=$actual_detail->id;
                $query->where('actual_detail_id', $actual_detail_id);
            }
        }

        if (isset($request['from_date']) && !empty($request['from_date'])) {
            $from_date=Carbon::createFromFormat('d/m/Y', $request['from_date']);
            $query->whereDate('dated','>=', $from_date);
            
        }
        if (isset($request['to_date']) && !empty($request['to_date'])) {
            $to_date=Carbon::createFromFormat('d/m/Y', $request['to_date']);
            $query->whereDate('dated','<=', $to_date);
        }
        

       

        if (isset($request['search']['value']) && !empty($request['search']['value'])) {
            $search = $request['search']['value'];
            $query->where(DB::raw("CONCAT(`receipt_id`)"), 'LIKE', "%".$search."%");
        }
        if (isset($request['page']) && !empty($request['page'])) {
            return $query->paginate($limit);
        } else {
            //$query=$query->where('status','1');
            return $query->get();
        }
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
            $actual_detail=Mfp_procurement_actual_detail::where('ref_id',$data['actual_detail_id'])->first();
            $total_amount_paid_earlier=Mfp_procurement_generate_receipt::where('actual_detail_id',$actual_detail->id)->sum('amount');
            $receipt = new Mfp_procurement_generate_receipt();
            
           
            $receipt->ref_id = (string) Str::uuid();
            
            //$actual_detail_amount_payable=$actual_detail->amount_payable;
            $receipt->actual_detail_id = $actual_detail->id;
            $receipt->receipt_id = $data['receipt_id'];
            $receipt->dated = Carbon::createFromFormat('d/m/Y', $data['dated']);
            $receipt->shg_id = $data['shg_id'];
            $receipt->name_of_tribal = $data['name_of_tribal'];
            $receipt->amount_of_rupees = $data['amount_of_rupees'];
            $receipt->amount = $data['amount'];
            $receipt->rest_amount = $data['rest_amount'];
            $receipt->created_by = $user_id;
            $receipt->save();


            // $total_amount_paid=Mfp_procurement_generate_receipt::where('actual_detail_id',$actual_detail->id)->sum('amount');
            // //yha check krenge ki total amount paid khi actual_detail_amount_payable se jada to nhi hai
            // if($total_amount_paid > $actual_detail_amount_payable)
            // {
            //     $balance_can_paid=$actual_detail_amount_payable-$total_amount_paid_earlier;
            //     throw new \Exception("Earlier you have already paid  $total_amount_paid_earlier.You can now pay maximum Rs. $balance_can_paid");   
            // }
            //agar full payment ho gya hai to actual detail wali table me has_receipt_generated column ko 1 kr denge,nhi to 2 krenge kr denge
            // if($total_amount_paid==$actual_detail_amount_payable)
            // {
                $actual_detail->has_receipt_generated=1;
            // }else{
            //     $actual_detail->has_receipt_generated=2;
            // }
            $actual_detail->save();

            //==Add User Activity
            $activity='Generated Receipt of Actual detail reference id '.$actual_detail->ref_id;
            $module='mfp_procurement_tribal_detail_form';
            $this->addUserActivity($activity,$module);
            DB::commit();
            return $actual_detail->getMfpProcurement;    
            //return Mfp_procurement_generate_receipt::where([
            //     'id' => $receipt->id
            // ])->firstOrFail();
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
        return Mfp_procurement_generate_receipt::where('ref_id', $id)->firstOrFail();
    }

    

    /**
     * Validates for creating a record.
     *
     * @param Array $data
     * @return mixed
     */
    public function validateCreate($data)
    {
        return Validator::make(
            $data,
            [
                'receipt_id' => 'required|unique:mfp_procurement_generate_receipt',
                'actual_detail_id' => 'required|exists:mfp_procurement_actual_detail,ref_id',
                'dated' => 'required|date_format:d/m/Y',
                'shg_id' => 'required|exists:mysql2.shg_gatherers,id',
                'name_of_tribal' => 'required|string',
                'amount_of_rupees' => 'required|string',
                'amount' => 'required|numeric',
                'rest_amount' => 'required|numeric',
                


            ]
        );
    }

    
    
}
