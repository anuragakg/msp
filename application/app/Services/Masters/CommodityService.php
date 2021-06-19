<?php

namespace App\Services\Masters;

use App\Services\Service;
use Illuminate\Support\Facades\Auth;
use App\Models\Masters\Commodity as ServiceModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CommodityService extends Service
{
    /**
     * Get all items from database
     *
     * @return mixed
     */
    public function getAll($data=null)
    {   $status = isset($data['status']) ? $data['status'] : 0;

        $where          = array();
        
        if (isset($data['state'])) {
            $where['state'] = $data['state'];
        }
        if (isset($data['queryTerm'])) {
            $where['title'] = $data['queryTerm'];
        }
        if (isset($data['common'])) {
            $where['common_name'] = $data['common'];
        }
        if ($status){
            return ServiceModel::where($where)->get();
        }
        return ServiceModel::where('status', 1)->orderBy('title', 'asc')->get();
        //return $this->getMasterData(ServiceModel::class);
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
        //==Add User Activity
        $activity='added commodity master  '.$data['title'];
        $module='master';
        $this->addUserActivity($activity,$module);
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

    /**
     * Update one item from database
     *
     * @param number $id
     * @param Array $data
     * @return mixed
     */
    public function updateItem($id, $data)
    {
        $item = ServiceModel::findOrFail($id);

        $item->title = $data['title'];
        $item->unit = $data['unit'];
        $item->state = $data['state'];
        $item->session = $data['session'];
        $item->common_name = $data['common_name'];
        $item->lab_name = $data['lab_name'];
        $item->msp = $data['msp'];
        $item->status = $data['status'] ?? 1;

        if (isset($data['photo'])) {
            $item->photo = $data['photo'];
        }
        if (isset($data['quality'])) {
            $item->quality = $data['quality'];
        }

        $item->save();
        //==Add User Activity
        $activity='updated commodity master  '.$data['title'];
        $module='master';
        $this->addUserActivity($activity,$module);
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

        if (isset($data['session']) && !is_array($data['session'])) {
            $data['session'] = explode(',', $data['session']);
        }

        return Validator::make(
            $data,
            [
                'title' => [
                    'required', 'alpha_spaces',
                    Rule::unique($model->getTable())
                ],
                'unit' => 'required|exists:unit_master,id',
                'state' => 'required|exists:states_master,id',
                // 'session' => 'required',
                'session' => 'required|array|min:1|max:12',
                'common_name' => 'required|alpha_spaces|min:0|max:100',
                'lab_name' => 'required|min:0|max:100|alpha_dash',
                'quality' => 'file|mimes:pdf|max:2048',
                'photo' => 'file|mimes:jpeg,jpg,png|max:2048',
                'msp' => 'required|integer',
            ],
            [
                'title.required' => 'Please provide MFP ITEM/NTFP NAME',
                'title.alpha_spaces' => 'Commodity name may only contain letters and spaces',                
                'session.required' => 'Please Season field is required',
                'common_name.alpha_spaces' => 'Common name may only contain letters and spaces',
                'title.unique' => 'The MFP ITEM/NTFP NAME already exists.',
                'lab_name.required' =>'The Scientific/Botanical Name field is required.',
                'lab_name.alpha_dash' =>'The Scientific/Botanical Name may only contain letters, numbers, dashes and underscores.'
            ]
        );
    }

    /**
     * Validates for updating a record in database.
     *
     * @param integer $id
     * @param Array $data
     * @return mixed
     */
    public function validateUpdate($id, $data)
    {
        $model = new ServiceModel();

        if (isset($data['session']) && !is_array($data['session'])) {
            $data['session'] = explode(',', $data['session']);
        }

        return Validator::make(
            $data,
            [
                'title' => [
                    'required', 'alpha_spaces',
                    Rule::unique($model->getTable())->ignore($id)
                ],
                'unit' => 'required|exists:unit_master,id',
                'state' => 'required|exists:states_master,id',
                'session' => 'required|array|min:1|max:12',
                'common_name' => 'required|alpha_spaces|min:0|max:100',
                'lab_name' => 'required|min:0|max:100|alpha_dash',
                'quality' => 'file|mimes:pdf|max:2048',
                'photo' => 'file|mimes:jpeg,jpg,png|max:2048',
                'msp' => 'required|integer',
            ],
            [
                'title.required' => 'Please provide MFP ITEM/NTFP NAME',
                'session.required' => 'Please Season field is required',
                'title.alpha_spaces' => 'Commodity name may only contain letters and spaces',
                'common_name.alpha_spaces' => 'Common name may only contain letters and spaces',
                'title.unique' => 'The MFP ITEM/NTFP NAME already exists.',
                'lab_name.required' =>'The Scientific/Botanical Name field is required.',
                'lab_name.alpha_dash' =>'The Scientific/Botanical Name may only contain letters, numbers, dashes and underscores.'
            ]
        );
    }
    
    public function getCommodityByName($commodity)
    {
        return ServiceModel::whereTitle($commodity)->first();
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
    
    public function getCommodities()
    {
        return ServiceModel::all();
    }
    public function getCommoditiesWiseState($filters)
    {    $where          = array();
        
        if (isset($filters['state_id'])) {
            $where['state'] = $filters['state_id'];
        }
        return ServiceModel::where($where)->get();
       // print_r($q);
    }
}
