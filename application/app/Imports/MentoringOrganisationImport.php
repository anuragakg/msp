<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\MentoringOrganisation;
use App\Models\SurveyorSupervisor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Services\Masters\OrgTypeService;
use App\Services\Masters\StateService;
use App\Services\Masters\DistrictService;

class MentoringOrganisationImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $data)
    {
        $user = new User();
        $user_detail = new UserDetail();
        $mentoring_org_detail = new MentoringOrganisation();

        //transaction begin
        \DB::beginTransaction();
        try {
            #saving user
            $user->user_name = $data['user_name'];
            $user->name = $data['name'];
            $user->last_name = null;
            $user->role = 8;
            $user->email = $data['email'];
            $user->email_verify_token = $data['email'];
            $user->created_by = Auth::user()->id;
            $user->updated_by = Auth::user()->id;
            $user->save();
            
            #get userId
            $user_id = $user->id;

            // #saving user details
            $user_detail->user_id = $user_id;

            $stateService    = new StateService();
            $districtService = new DistrictService();
            $orgTypeService  = new OrgTypeService();

            $state    = $stateService->getStateByName($data['state']);
            $district = $districtService->getDistrictByName($state['id'],$data['district']);
            $orgType  = $orgTypeService->getOrgTypeByName($data['org_type']);


            $user_detail->state = $state['id'];
            $user_detail->district = $district['id'];
            $user_detail->block = 0;
            $user_detail->official_address = $data['official_address'];
            $user_detail->pin_code = $data['pin_code'];
            $user_detail->created_by = Auth::user()->id;
            $user_detail->updated_by = Auth::user()->id;
            $user_detail->save();

            #saving Organisation details
            $mentoring_org_detail->user_id = $user_id;
            $mentoring_org_detail->org_type = $orgType['id'];
            $mentoring_org_detail->registration_no = $data['registration_no'];
            $mentoring_org_detail->chairman_name = $data['chairman_name'];
            $mentoring_org_detail->chairman_mobile = $data['chairman_mobile'];
            $mentoring_org_detail->chairman_email = $data['chairman_email'];
            $mentoring_org_detail->secretary_name = $data['secretary_name'];
            $mentoring_org_detail->secretary_mobile = $data['secretary_mobile'];
            $mentoring_org_detail->secretary_email = $data['secretary_email'];

            $mentoring_org_detail->registration_date = Carbon::parse('11/22/2019')->format('Y-m-d');
            $mentoring_org_detail->registration_expiry = Carbon::parse('11/22/2019')->format('Y-m-d');
            $mentoring_org_detail->gst_or_tan = $data['gst_or_tan'];
            $mentoring_org_detail->created_by = Auth::user()->id;
            $mentoring_org_detail->updated_by = Auth::user()->id;
            $mentoring_org_detail->save();
           
            \DB::commit();
            /**
             * Return user object to be used for ApiResource Further.
             */
            return $user;
        } catch (\Exception $e) {
            // something went wrong
            throw $e;
        }
    }

    public function startCell() {
        return A1;
    }
}