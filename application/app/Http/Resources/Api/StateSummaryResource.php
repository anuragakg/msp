<?php

namespace App\Http\Resources\Api;

use App\Http\Resources\Api\Masters\ViewOne\StateResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StateSummaryResource extends JsonResource
{

    private $vdvks;
    private $sanctionLetters;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $getState = $this->getState;       
        $this->sanctionLetters = $getState->getSanctionLetter;
        $proposedLocation = $this->getVdvkProposedLocation;
        $vdvks = $proposedLocation->map(function ($v) {
            return $v->getVdvk;
        });

        $this->vdvks = $vdvks;
        $getTeams=$this->getTeamLeaders;
        $getVdvk=$this->getVdvlData;

        return [
            'id' => $this->id,
            'month_year' => $this->month_year,
            'state' => $this->state,
            'state_name' => isset($getState->title) ? strip_tags($getState->title) : null,
            'total_vdvk_proposals' => $this->getVdvkProposals(), // No. of VDVK Proposal Received
            'vdvk_sanctioned' => $this->getVdvkSanctioned(), // No. of VDVKs Sanctioned
            'sanctioned_grant' => $this->getSanctionedGrant(), // Amount of Grant sanctioned (Rs.Lakhs)
            'total_beneficiaries' => $this->getTotalBeneficiaries(), // Total No. of Beneficiaries in VDVKs
            'state_team_update' => $this->state_team_update,
             // Update from State Team at HO
            'vdvk_target' => $this->vdvk_target, // Target of VDVKs for 2019-20
            'target_day_plan' => $this->target_day_plan, // Target of VDVKs for 100 Day Plan
            'post_sanction' => $this->post_sanction, 
            'post_sanction_remark' => $this->post_sanction_remark, // Post Sanction Advocacy Workshop
            'chiefministry_name' => $this->chiefministry_name,
            'chiefministry_contact' => $this->chiefministry_contact, // Meeting / Letter to Chief Minister
            'meetingCM' => $this->meetingCM,
            'meetingCM_remark' => $this->meetingCM_remark, // Meeting / Letter to State Tribal/ Forest Development Minister
            'state_tribal_name' => $this->state_tribal_name,
            'state_tribal_contact' => $this->state_tribal_contact, // Meeting / Letter to Chief Secretary (SLCMC)
            'meetingST' => $this->meetingST,
            'meetingST_remark' => $this->meetingST_remark, // Meeting / Letter to Principal Secretary/ Secretary Nodal Department
            'chief_secretary_name' => $this->chief_secretary_name,
            'chief_secretary_contact' => $this->chief_secretary_contact, // Meeting / Letter to MD / State Implementing Agency
            'meetingCS' => $this->meetingCS, // Name of the State Implementing Agency 
            'meetingCS_remark' => $this->meetingCS_remark, // Name of the State Level Mentoring Organization (JFMC/LAMPS/ Other NGO)
            'principal_secretary_name' => $this->principal_secretary_name, // Meeting / Letter to District Collector (DLCMC)
            'principal_secretary_address' => $this->principal_secretary_address,
            'meetingND' => $this->meetingND,
            'meetingND_remark' => $this->meetingND_remark, // Meeting / Letter to District Implementing  Agency (JFMC/LAMPS/ Other NGO)
            'appointment_name' => $this->appointment_name,
            'appointment_contact' => $this->appointment_contact, // Identification of 20 member Van Dhan SHGs & Clustering them to VDVKs
            'appointment_email' => $this->appointment_email,
            'appointment' => $this->appointment, // Formation of District VDVK plans & submission to Nodal Department
            'appointment_remark' => $this->appointment_remark,
            'pmu_appointe' => $this->pmu_appointe, 
            //'mtc_name' => $this->mtc_name, // Name of Demo & Model Training Centre 
            'pmu_remark' => $this->pmu_remark, // Date of Grant Release to the SIA/ DIUs from TRIFED
            'district_level' => $this->district_level, // Date of Grant Release to the VDVK from SIA/ DIUs
             'district_level_remark' => $this->district_level_remark,
            'meetingMD' => $this->meetingMD, // Evaluation & Monitoring
            'meetingMD_remark' => $this->meetingMD_remark,
            'MeetingDLCMC' => $this->MeetingDLCMC, // Audit & Utilization Certificate            
            'MeetingDLCMC_remark' => $this->MeetingDLCMC_remark, 
            'MeetingDI' => $this->MeetingDI, // Audit & Utilization Certificate            
            'MeetingDI_remark' => $this->MeetingDI_remark, // Audit & Utilization Certificate            
            'key_issues' => $this->key_issues, // Audit & Utilization Certificate            
            'actionable' => $this->actionable, // Audit & Utilization Certificate     
            'vdvkIds' => $this->vdvk, // Audit & Utilization Certificate     
            'vdvk_data'   =>$getVdvk,
            'teamleaders' =>$getTeams,
        ];
    }  

    private function getVdvkSanctioned()
    {
        return $this->vdvks->whereIn('sanctioned', [1, 2])->count();
    }
    private function getVdvkProposals()
    {
        return $this->vdvks->count();
    }

    private function getSanctionedGrant()
    {
        return $this->sanctionLetters->sum('sanctioned_amount');
    }

    private function getTotalBeneficiaries()
    {
        $shgs = $this->vdvks->map(function ($v) {
            return $v->getShgData;
        });

        return $shgs->flatten()->map(function ($v) {
            return $v->getShgGroup()->withCount('getShgGatherers')->first();
        })->sum('get_shg_gatherers_count');
    }
}
