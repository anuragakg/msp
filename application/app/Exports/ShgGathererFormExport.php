<?php

namespace App\Exports;

use App\Models\UserDetail;
use App\Models\Shg\ShgGatherers;
use App\Models\Shg\ShgHouseholdMember;
use App\Models\Masters\Commodity;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromArray;

class ShgGathererFormExport implements FromArray, WithTitle
{

    public function __construct($shg_gatherers) 
    { 
        $this->shg_gatherers = $shg_gatherers;
    }

    public function array(): array
    {
        $cols = [];


        $heading = [
            'Refrence Id',
            'Name of Tribal',
            'Gender',
            'Date of Birth',
            'Birth Year',
            'Age',
            'ID Type',
            'ID Value',
            'Mobile Number',
            'Landline Number',
            'Is Smart Phone',
            'Address',
            'State',
            'District',
            'Block',
            'Gram Panchayat',
            'Village',
            'Pincode',
            'Mother',
            'Father',     
            'Education',
            'Occupation',
            'Existing Membership',            
            'Category',
            'ST Name',
            'SHG Name',
            'Bearer Role',
            'SHG NRLM ID',
            'SHG Other ID',
            'Bearer Office',
            'Vehicle Type',            
            'Bank name',
            'IFSC Code',
            'Branch name',
            'Account No.',
            'Self / Other',
            'Self / Other Name',
            'Household Members',
            'Household name',
            'Household Gender',
            'Household Dob',
            'Household Age',
            'Household Education',
            'Household Occupation',
            'Relationship With Member',
            'Is Gathering',            
            'latitude',
            'longitude',
            'Name of Proposed VDVK',
            'Financial Year',
        ];

        array_push($cols, $heading);

        foreach ($this->shg_gatherers as $shg_gatherer) {
            $col = [
                $shg_gatherer['id'],
                $shg_gatherer['name_of_tribal']?? null,
                $shg_gatherer['gender'] == 'M' ? 'Male' : 'Female' ?? null,
                $shg_gatherer['dob']?? null,
                $shg_gatherer['get_year']['title'] ?? null,
                $shg_gatherer['age'] ?? null,
                $shg_gatherer['get_i_d']['title']?? null,
                $shg_gatherer['id_value']?? null,
                $shg_gatherer['get_bank_details']['mobile_no']?? null,
                $shg_gatherer['get_bank_details']['landline_no']?? null,
                $shg_gatherer['get_bank_details']['phone_type']?? null,
                $shg_gatherer['address']?? null,
                $shg_gatherer['get_state']['title']?? null,
                $shg_gatherer['get_district']['title']?? null,
                $shg_gatherer['get_block']['title']?? null,
                $shg_gatherer['gram_panchayat']?? null,
                $shg_gatherer['get_village']['title']?? null, 
                $shg_gatherer['pin_code']?? null,
                $shg_gatherer['mother']?? null,
                $shg_gatherer['father']?? null,
                $shg_gatherer['get_education']['title']?? null,
                $shg_gatherer['get_occupation']['title']?? null,
                $shg_gatherer['existing_membership']?? null  == 1 ? 'Yes' : 'No',
                $shg_gatherer['get_category']['title']?? null,
                $shg_gatherer['get_schedule_cast']['title'] ?? null,
                $shg_gatherer['shg_name']?? null,
                $shg_gatherer['bearer_role']?? null,
                $shg_gatherer['shg_nrlm_id']?? null,
                $shg_gatherer['shg_other_id']?? null,
                $shg_gatherer['get_office_bearer']['title']?? null,
                $shg_gatherer['get_vehical']['title']?? null,
                $shg_gatherer['get_bank_details']['name']?? null,
                $shg_gatherer['get_bank_details']['ifsc_code']?? null,
                $shg_gatherer['get_bank_details']['branch']?? null,
                $shg_gatherer['get_bank_details']['account_no']?? null,
                $shg_gatherer['get_bank_details']['is_self']?? null == 1 ? 'Self' : 'Other',
                $shg_gatherer['get_bank_details']['specify_other']?? null,
                $shg_gatherer['no_of_members']?? null,
                $shg_gatherer['get_house_hold_members'][0]['name'] ?? null,
                $shg_gatherer['get_house_hold_members'][0]['gender']?? null == 'M' ? 'Male' : 'Female',
                $shg_gatherer['get_house_hold_members'][0]['dob'] ?? null,
                $shg_gatherer['get_house_hold_members'][0]['age'] ?? null,
                $shg_gatherer['get_education']['title'] ?? null,
                $shg_gatherer['get_occupation']['title']?? null,
                $shg_gatherer['get_house_hold_members'][0]['relationship_with_member'] ?? null,
                $shg_gatherer['is_gathering_mfp']?? null == 1 ? 'Yes' : 'No',
                $shg_gatherer['latitude']?? null,
                $shg_gatherer['longitude']?? null,
                $shg_gatherer['name_of_proposed']?? null,
                $shg_gatherer['financial_year']?? null,

            ];

            array_push($cols, $col);
        }

        return $cols;
    }

    public function title(): string
    {
        return 'Shg Gatherer Data';
    }
}