<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\StateLevel as ServiceModel;
use App\Models\Masters\Role as RoleModel;
use App\Models\Masters\StateRoleSubLevel;
use App\Models\Proposals\Mfp_procurement;
use App\Models\Proposals\Mfp_procurement_consolidated;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;
use DB;
class StateLevelRoleService extends Service
{
    /**
     * Get all items from database
     *
     * @return mixed
     */
    function getListing($request)
    {
        // return $query;
        $columns = array( 
            0 =>'state_id', 
            1=> 'state'
            
        );
        $limit = $request['length'];
        $start = $request['start'];
        $order = $columns[$request['order'][0]['column']];
        $dir = $request['order'][0]['dir'];

        $search = $request['search']['value']; 
        $db2 = env('DB_DATABASE2');    
        $model = new ServiceModel();
        $table = $model->getTable();
        $query= DB::table($table .' AS t')
                ->select('t.role_id','r.title as role_name','l.title as level','t.level_id','t.state_id','s.title as state')
                ->leftJoin('user_roles as r', 't.role_id', '=', 'r.id')
                ->leftJoin('levels_master as l', 't.level_id', '=', 'l.id')
                ->leftJoin($db2.'.states_master as s', 't.state_id', '=', 's.id');
        if(isset($request['state']) && !empty($request['state'])){
            $query->where('state_id',$request['state']);   
        }
                $query->groupBy("t.state_id");
                $query->orderBy($order,$dir);
    
    
        return $query->paginate($limit);
        // $query = DB::table($table .' AS t')
        //         ->select('t.role_id','r.title as role_name','l.title as level','t.level_id','t.state_id','s.title as state')
        //         ->leftJoin('user_roles as r', 't.role_id', '=', 'r.id')
        //         ->leftJoin('levels_master as l', 't.level_id', '=', 'l.id')
        //         ->leftJoin($db2.'.states_master as s', 't.state_id', '=', 's.id');
     
    //    return $query->get();
    }

    /**
     * Creates a new item in table
     *
     * @param Array $data
     * @return mixed
     */
    public function createItem($data)
    {
        $item = new ServiceModel($data);
        $item->save();
        return $item;
    }
    public function createSublevelItem($data)
    {
        $item = new StateRoleSubLevel($data);
        $item->save();
        return $item;
    }

    /**
     * Get a single item from database
     *
     * @param number $id
     * @return mixed
     */
    public function getOne($id)
    {
        return ServiceModel::findOrFail($id);
    }

    public function getStateLevel($state_id)
    {
        return ServiceModel::where('state_id',$state_id)->get();
    }
    /**
     * Get a single item from database
     *
     * @param number $id
     * @return mixed
     */
    public function get_state_data($state_id)
    {
        $model = new ServiceModel();
        $table=$model->getTable();
        $db2 = env('DB_DATABASE2');
        $query = DB::table($table .' AS t')
            ->select('t.role_id','r.title as role_name','l.title as level','t.level_id','t.state_id','s.title as state')
           ->leftJoin('user_roles as r', 't.role_id', '=', 'r.id')
           ->leftJoin('levels_master as l', 't.level_id', '=', 'l.id')
           ->leftJoin($db2.'.states_master as s', 't.state_id', '=', 's.id')
           ->where('t.state_id',$state_id)
           ->get();

           
        return $query;
        //return ServiceModel::findOrFail($id);
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
        dd($data);
        //$item = $this->delete_state_level_role($id);
        $item = 1;
      
        if($item){
            $state_id = $data['state_id'];
            $status = 1; 
            $updated_by = 0;
           
            foreach ($data['level_id'] as $key => $level)
            {
                $level_id=$level;
                $role_id=isset($data['role_id'][$key])?$data['role_id'][$key]:'0';
                $insert_data=array(
                    'state_id'=>$state_id,
                    'level_id'=>$level_id,
                    'role_id'=>$role_id,
                    'status'=>$status,
                    'updated_by'=>$updated_by,
                );
                
                $item = $this->createItem($insert_data);
            }
        }
        
        return $item;
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
        $model = new ServiceModel();
        return Validator::make($data, [
            'state_id' => [
                'required',
                Rule::unique($model->getTable())
               
                
            ],
            'level_id.*' => 'required|distinct|min:1',
            'role_id.*' => 'required|distinct|min:1',
            'sublevel.*.*' => 'required',
        ],
        [
            'state_id.required' => 'Please enter state name',
            'state_id.unique' => 'This state name already taken',
            'level_id.*.required' => 'Please enter level',
            'role_id.*.required' => 'Please enter role',            
            'role_id.*.distinct' => 'The Role Type field has a duplicate value.',

        ]
    );
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
        //dd($data);
        //$model = new ServiceModel();
        return Validator::make($data, [
            'state_id' => [
                'required',
                 //Rule::unique($model->getTable())->ignore($id)
            ],
            'level_id.*' => 'required|distinct|min:1',
            'role_id.*' => 'required|distinct|min:1',
            'sublevel.*.*' => 'required',
        
        ],
        [
            'state_id.required' => 'Please provide state name',
            'role_id.*.distinct' => 'The Role Type field has a duplicate value.',
            
        ]);
        
    }

    public function delete_state_level_role($state_id)
    {
        $model = new ServiceModel();
        $table=$model->getTable();
        
        $is_deleted = DB::statement("DELETE FROM $table where state_id=$state_id");
        return $is_deleted;
    } 

    public function delete_state_sublevellevel($state_id)
    {
        $model = new StateRoleSubLevel();
        $table=$model->getTable();
        
        $is_deleted = DB::statement("DELETE FROM $table where state_id=$state_id");
        return $is_deleted;
    } 

    /**
     * Switch the status of the given user id.
     *
     * @param integer $id
     * @return string|integerpack
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

    // public function scrutinyRoles(){
    //     $data = RoleModel::whereIn('id',['2','3','4','5','6'])->get();
    //     return $data;
    // }

    public function is_proposal_completed($request){

        $is_procurement_not_completed = DB::table('mfp_procurement')
                                        ->select('mfp_procurement.id')
                                        ->join('user_details','user_details.user_id','=','mfp_procurement.user_id')
                                        ->whereIn("status",[0,2])
                                        ->where("state",$request['state_id'])
                                        ->get();

        $is_infrastructure_not_completed = DB::table('infrastructure_development')
                                        ->select('infrastructure_development.id')
                                        ->join('user_details','user_details.user_id','=','infrastructure_development.user_id')
                                        ->whereIn("status",[0,2])
                                        ->where("state",$request['state_id'])
                                        ->get();

        if(count($is_procurement_not_completed) || count($is_infrastructure_not_completed)){
            return true;
        }


       
  

    }

  
}
