<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Masters\Village;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Services\Masters\VillageService;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable;
class VillagesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    use Importable;
    private $row = 1;
    public function model(array $data)
    {    
        $row_num=++$this->row;
        $village = new Village();
        $validData = new VillageService();
        $user_data=array();
        //transaction begin
        \DB::beginTransaction();
        try {

            if ($row_num>=1000) {
                $message= "Record should be less than 1000";
                    throw new \Exception($message);         
            }
            else
            { 
                            
            $user_data['title'] = $data['village_name'];
            $user_data['code'] = $data['village_code'];
            $user_data['pincode'] = $data['pin_code'];            
            $valid = $validData->validateCreate($user_data);            
            if ($valid->fails()) {                    
                    $partOne_Error= $valid->errors()->all();
                    $partOne_Error=implode(',',$partOne_Error);
                    $response['status']=0;
                    $message= "In row number ".$row_num." ".$partOne_Error ;
                    throw new \Exception($message);                    
                }

            $data = $valid->validated();
            if (!empty($data['title']) && !empty($data['code']) && !empty($data['pincode']))
              {
            $village->title = trim($data['title']);
            $village->code = trim($data['code']);
            $village->pincode = trim($data['pincode']);
            $village->save();  
            }else
            {
               $message= "Village Name, Village Code and Pincode should not be blank.";
                    throw new \Exception($message);  
            }
        }
                 #saving Village details           
            
            \DB::commit();
            /**
             * Return user object to be used for ApiResource Further.
             */
            return $village;
        } catch (\Exception $e) {
            // something went wrong
            throw $e;
        }
    }

    public function startCell() {
        return A1;
    }
}