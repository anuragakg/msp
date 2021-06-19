<?php

namespace App\Imports;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon;

$shgPartOneData = [];

class ShgPartOneImport implements ToCollection, WithHeadingRow
{
    // use Importable, SkipsFailures;

    private $data; public $records = [];
    // public $errors = ['1'];

    public function __construct(array $data = [])
    {
        $this->data = $data; 
    }
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function collection(Collection $data)
    {
        $GLOBALS['shgPartOneData'] = [];
        $jsonDecode = json_decode($data);
        $x=0;

        try{
        
        foreach($jsonDecode as $jd){
            //print_r($jsonDecode); die();
            if (!array_key_exists("reference_id",$jsonDecode[$x]))
            {
                return false;
            }
            $GLOBALS['shgPartOneData'][$x]['reference_id'] = $jsonDecode[$x]->reference_id;
            $GLOBALS['shgPartOneData'][$x]['name_of_tribal'] = $jsonDecode[$x]->name_of_tribal;
            $GLOBALS['shgPartOneData'][$x]['gender'] = $jsonDecode[$x]->gender;

            if (empty($jsonDecode[$x]->dob)) {
                $GLOBALS['shgPartOneData'][$x]['dob'] = null;
            } else {
                try {
                    $dobObj = Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($jsonDecode[$x]->dob));
                    $GLOBALS['shgPartOneData'][$x]['dob'] = $dobObj->format('d/m/Y');
                } catch (\Throwable $th) {
                    $GLOBALS['shgPartOneData'][$x]['dob'] = null;
                }
            }
            $GLOBALS['shgPartOneData'][$x]['birth_year'] = $jsonDecode[$x]->birth_year;
            $GLOBALS['shgPartOneData'][$x]['age'] = 10;
            $GLOBALS['shgPartOneData'][$x]['id_type'] = $jsonDecode[$x]->id_type;
            $GLOBALS['shgPartOneData'][$x]['id_value'] = $jsonDecode[$x]->id_value;
            $GLOBALS['shgPartOneData'][$x]['father'] = $jsonDecode[$x]->father;
            $GLOBALS['shgPartOneData'][$x]['mother'] = $jsonDecode[$x]->mother;
            $GLOBALS['shgPartOneData'][$x]['address'] = $jsonDecode[$x]->address;
            // $GLOBALS['shgPartOneData'][$x]['group_name'] = $jsonDecode[$x]->group_name;
            //$GLOBALS['shgPartOneData'][$x]['state'] = $jsonDecode[$x]->state;
            $GLOBALS['shgPartOneData'][$x]['district'] = $jsonDecode[$x]->district;
            $GLOBALS['shgPartOneData'][$x]['block'] = $jsonDecode[$x]->block;
            $GLOBALS['shgPartOneData'][$x]['village'] = $jsonDecode[$x]->village;
            $GLOBALS['shgPartOneData'][$x]['pin_code'] = $jsonDecode[$x]->pin_code;
            $GLOBALS['shgPartOneData'][$x]['gram_panchayat'] = $jsonDecode[$x]->gram_panchayat;
            $GLOBALS['shgPartOneData'][$x]['occupation'] = $jsonDecode[$x]->occupation;
            $GLOBALS['shgPartOneData'][$x]['education'] = $jsonDecode[$x]->education;
            $GLOBALS['shgPartOneData'][$x]['existing_membership'] = $jsonDecode[$x]->existing_membership;
            $GLOBALS['shgPartOneData'][$x]['shg_name'] = $jsonDecode[$x]->shg_name;
            $GLOBALS['shgPartOneData'][$x]['shg_nrlm_id'] = $jsonDecode[$x]->shg_nrlm_id;
            $GLOBALS['shgPartOneData'][$x]['shg_other_id'] = $jsonDecode[$x]->shg_other_id;
            $GLOBALS['shgPartOneData'][$x]['is_office_bearer'] = $jsonDecode[$x]->is_office_bearer;
            $GLOBALS['shgPartOneData'][$x]['bearer_role'] = $jsonDecode[$x]->bearer_role;
            $GLOBALS['shgPartOneData'][$x]['category'] = $jsonDecode[$x]->category;
            $GLOBALS['shgPartOneData'][$x]['is_ews'] = $jsonDecode[$x]->is_ews;
            $GLOBALS['shgPartOneData'][$x]['st_name'] = $jsonDecode[$x]->st_name;
            $GLOBALS['shgPartOneData'][$x]['is_gathering_mfp'] = $jsonDecode[$x]->is_gathering_mfp;
            // $GLOBALS['shgPartOneData'][$x]['is_married'] = $jsonDecode[$x]->is_married;
            $GLOBALS['shgPartOneData'][$x]['vehicle_type'] = $jsonDecode[$x]->vehicle_type;
            $GLOBALS['shgPartOneData'][$x]['bank_name'] = $jsonDecode[$x]->bank_name;
            $GLOBALS['shgPartOneData'][$x]['branch_name'] = $jsonDecode[$x]->branch_name;
            $GLOBALS['shgPartOneData'][$x]['bank_ifsc'] = $jsonDecode[$x]->bank_ifsc;
            $GLOBALS['shgPartOneData'][$x]['bank_account_no'] = $jsonDecode[$x]->bank_account_no;
            $GLOBALS['shgPartOneData'][$x]['bank_ifsc'] = $jsonDecode[$x]->bank_ifsc;
            $GLOBALS['shgPartOneData'][$x]['bank_mobile_no'] = $jsonDecode[$x]->bank_mobile_no;
            $GLOBALS['shgPartOneData'][$x]['landline_no'] = $jsonDecode[$x]->landline_no;
            $GLOBALS['shgPartOneData'][$x]['is_self'] = $jsonDecode[$x]->is_self;
            $GLOBALS['shgPartOneData'][$x]['specify_other'] = $jsonDecode[$x]->specify_other;
            $GLOBALS['shgPartOneData'][$x]['phone_type'] = $jsonDecode[$x]->phone_type;
            $GLOBALS['shgPartOneData'][$x]['no_of_members'] = $jsonDecode[$x]->no_of_members;
            $GLOBALS['shgPartOneData'][$x]['name_of_proposed'] = $jsonDecode[$x]->name_of_proposed;
            $GLOBALS['shgPartOneData'][$x]['financial_year'] = $jsonDecode[$x]->financial_year;
            $GLOBALS['shgPartOneData'][$x]['latitude'] = $jsonDecode[$x]->latitude;
            $GLOBALS['shgPartOneData'][$x]['longitude'] = $jsonDecode[$x]->longitude;
            $x++;
            // }
        }
    }
        catch(\Exception $e) {
            throw $e;
            // var_dump("S"); die;
        }
    }

    public function headingRow(): int
    {
        return 2;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function rules(): array
    {
        return [
            '0' => 'required'
        ];
    }

    public function validationMessages()
    {
        return [
            '0.required' => trans('user.first_name_is_required')
        ];
    }
}