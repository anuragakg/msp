<?php

namespace App\Lib;

class PermissionMappings
{

    public function getMappings()
    {
        return [
            'trifed_admin' => $this->superAdmin(),
            'trifed_user' => $this->trifedUsers(),
            'snd' => $this->sndUser(),
            'ministry_user' => [],
            'regional_manager' => [],
            'sio' => $this->sioUser(),
            'mo' => $this->mentoringOrg(),
            'inspection_agency' => $this->inspectionUser(),
            'evaluation_authority' => $this->evaluationUser(),
            'surveyor' => [],
            'supervisor' => [],
            'dio' => $this->dioUser(),
            'pa' => [],
            'trifed_user_1' => $this->trifedUsers(),
            'trifed_user_2' => $this->trifedUsers(),
            'trifed_user_3' => $this->trifedUsers(),
            'trifed_financial_user' => $this->financialUser(),
        ];
    }

    private function superAdmin()
    {
        return [
            'master_management_view',
            'master_management_add',
            'master_management_edit',
            'master_management_status',

            'role_mapping_view',
            'role_mapping_add',
            'role_mapping_edit',
            'role_mapping_status',

            'user_management_view',
            'user_management_add',
            'user_management_edit',
            'user_management_status',

            'mo_management_view',
            'mo_management_mapping_with_evaluation_user',
            'mo_management_mapping_with_inspection_user',
            'mo_management_mapping_with_supervisor_user',

            'surveyor_management_view',
            'supervisor_management_view',
            'shg_management_view',
            'haat_bazaar_management_view',
            'warehouse_management_view',
            'shg_group_management_view',
            'pmvdy_proposal_management_view',

            'fund_management_view',
            'fund_management_add',

            'generate_sanction_letter_view',
            'generate_sanction_letter_add',

            'release_funds_view',
            'release_funds_add',

            'utilization_management_view',

            'fund_distribution_view',
            'fund_distribution_add',

            'checklist_management_view',
            'inspection_management_view',
            'evaluation_management_view',
            'mis_reports_view',
            'mis_reports_status',
            'vdvk_demo_unit_view',
            'verify_utilisation_view',

        ];
    }

    public function dioUser()
    {
        return [
            "master_management_view",
            "equipment_master_add",
            "equipment_master_edit",
            "equipment_master_status",
            "mo_type_master_add",
            "mo_type_master_edit",
            "mo_type_master_status",
            "designation_master_add",
            "designation_master_edit",
            "designation_master_status",

            "user_management_view",
            "user_management_add",

            "mo_management_view",
            "mo_management_add",
            "mo_management_edit",
            "mo_management_status",
            "mo_management_mapping_with_inspection_user",
            "mo_management_mapping_with_supervisor_user",

            "surveyor_management_view",
            "surveyor_management_add",
            "surveyor_management_edit",
            "surveyor_management_status",
            "surveyor_management_mapping_with_supervisor",

            "supervisor_management_view",
            "supervisor_management_add",
            "supervisor_management_edit",
            "supervisor_management_status",

            "shg_management_view",
            "haat_bazaar_management_view",
            "warehouse_management_view",
            "shg_group_management_view",

            "pmvdy_proposal_management_view",
            "pmvdy_proposal_management_approval_management",
            "fund_management_view",
            "generate_sanction_letter_view",

            "release_funds_view",
            "release_funds_add",

            "utilization_management_view",
            "utilization_management_add",

            "fund_distribution_view",
            "fund_distribution_add",
            "fund_distribution_edit",

            "checklist_management_view",
            "checklist_management_add",
            "checklist_management_edit",
            "checklist_management_status",

            "inspection_management_view",
            "inspection_management_add",
            "inspection_management_edit",
            "inspection_management_status",

            "evaluation_management_view",
            "mis_reports_view",
            "vdvk_demo_unit_view",
            "verify_utilisation_view",
            "verify_utilisation_add",
            "verify_utilisation_edit",
        ];
    }

    private function financialUser()
    {
        return [
            'master_management_view',
            'role_mapping_view',
            "user_management_view",
            "mo_management_view",
            "surveyor_management_view",
            "supervisor_management_view",
            "shg_management_view",
            "haat_bazaar_management_view",
            "warehouse_management_view",
            "shg_group_management_view",
            "pmvdy_proposal_management_view",

            "fund_management_view",
            "fund_management_add",

            "generate_sanction_letter_view",

            "release_funds_view",
            "release_funds_add",
            "release_funds_edit",

            "utilization_management_view",

            "fund_distribution_view",
            "fund_distribution_add",
            "fund_distribution_edit",

            "checklist_management_view",
            "inspection_management_view",
            "evaluation_management_view",
            "mis_reports_view", "mis_reports_status",
            "vdvk_demo_unit_view",
            "verify_utilisation_view",
        ];
    }

    private function mentoringOrg()
    {
        return [
            "master_management_view",
            "equipment_master_add",
            "equipment_master_edit",

            "surveyor_management_view",
            "surveyor_management_add",
            "surveyor_management_edit",
            "surveyor_management_status",
            "surveyor_management_mapping_with_supervisor",

            "supervisor_management_view",
            "supervisor_management_add",
            "supervisor_management_edit",
            "supervisor_management_status",

            "shg_management_view",
            "shg_management_add",
            "shg_management_edit",
            "shg_management_status",

            "haat_bazaar_management_view",
            "haat_bazaar_management_add",
            "haat_bazaar_management_edit",
            "haat_bazaar_management_status",

            "warehouse_management_view",
            "warehouse_management_add",
            "warehouse_management_edit",
            "warehouse_management_status",

            "shg_group_management_view",
            "shg_group_management_add",
            "shg_group_management_edit",
            "shg_group_management_status",

            "pmvdy_proposal_management_view",
            "pmvdy_proposal_management_add",
            "pmvdy_proposal_management_edit",

            "fund_management_view",
            "release_funds_view",
            "generate_sanction_letter_view",
            "release_funds_view",

            "utilization_management_view",
            "utilization_management_add",
            "utilization_management_edit",

            "fund_distribution_view",
            "checklist_management_view",
            "inspection_management_view",
            "evaluation_management_view",
            "mis_reports_view",
            "vdvk_demo_unit_view",
            "verify_utilisation_view",

        ];
    }

    private function evaluationUser()
    {
        return [
            "master_management_view",
            "role_mapping_view",
            "user_management_view",
            "mo_management_view",
            "surveyor_management_view",
            "supervisor_management_view",
            "shg_management_view",
            "haat_bazaar_management_view",
            "warehouse_management_view",
            "shg_group_management_view",
            "pmvdy_proposal_management_view",
            "fund_management_view",
            "generate_sanction_letter_view",
            "release_funds_view",
            "utilization_management_view",
            "fund_distribution_view",
            "checklist_management_view",
            "inspection_management_view",

            "evaluation_management_view",
            "evaluation_management_add",
            "evaluation_management_edit",

            "mis_reports_view",
            "vdvk_demo_unit_view",
            "verify_utilisation_view",
        ];
    }

    private function inspectionUser()
    {
        return [
            "master_management_view",
            "role_mapping_view",
            "user_management_view",
            "mo_management_view",
            "surveyor_management_view",
            "supervisor_management_view",
            "shg_management_view",
            "haat_bazaar_management_view",
            "warehouse_management_view",
            "shg_group_management_view",
            "pmvdy_proposal_management_view",
            "fund_management_view",
            "generate_sanction_letter_view",
            "release_funds_view",
            "utilization_management_view",
            "fund_distribution_view",
            "checklist_management_view",

            "inspection_management_view",
            "inspection_management_add",
            "inspection_management_edit",

            "evaluation_management_view",
            "mis_reports_view",
            "vdvk_demo_unit_view",
            "verify_utilisation_view",
        ];
    }

    private function trifedUsers()
    {
        return [
            "master_management_view",
            "role_mapping_view",
            "user_management_view",
            "mo_management_view",
            "surveyor_management_view",
            "supervisor_management_view",
            "shg_management_view",
            "haat_bazaar_management_view",
            "warehouse_management_view",
            "shg_group_management_view",
            "pmvdy_proposal_management_view",
            "pmvdy_proposal_management_approval_management",
            "fund_management_view",
            "fund_management_add",
            "fund_management_edit",
            "generate_sanction_letter_view",
            "generate_sanction_letter_add",
            "generate_sanction_letter_edit",
            "release_funds_view",
            "utilization_management_view",
            "fund_distribution_view",
            "fund_distribution_add",
            "checklist_management_view",
            "checklist_management_edit",
            "inspection_management_view",
            "inspection_management_add",
            "inspection_management_edit",
            "inspection_management_status",
            "evaluation_management_view",
            "evaluation_management_add",
            "evaluation_management_edit",
            "mis_reports_view", "mis_reports_status",
            "vdvk_demo_unit_view",
            "vdvk_demo_unit_add",
            "vdvk_demo_unit_edit",
            "vdvk_demo_unit_status",
            "verify_utilisation_view",
        ];
    }

    private function sndUser()
    {
        return [
            "master_management_view",
            "equipment_master_add",
            "equipment_master_edit",
            "equipment_master_status",
            "mo_type_master_add",
            "mo_type_master_edit",
            "mo_type_master_status",
            "designation_master_add",
            "designation_master_edit",
            "designation_master_status",
            "department_master_add",
            "department_master_edit",
            "department_master_status",

            "master_management_view",

            "mo_management_view",
            "mo_management_mapping_with_evaluation_user",
            "mo_management_mapping_with_inspection_user",

            "surveyor_management_view",
            "supervisor_management_view",
            "shg_management_view",
            "haat_bazaar_management_view",
            "warehouse_management_view",
            "shg_group_management_view",

            "pmvdy_proposal_management_view",
            "pmvdy_proposal_management_approval_management",
            "fund_management_view",
            "generate_sanction_letter_view",
            "release_funds_view",
            "release_funds_add",
            "utilization_management_view",
            "fund_distribution_view",
            "fund_distribution_add",
            "fund_distribution_edit",
            "checklist_management_view",
            "checklist_management_add",
            "checklist_management_edit",
            "inspection_management_view",
            "inspection_management_add",
            "inspection_management_edit",
            "evaluation_management_view",
            "evaluation_management_add",
            "mis_reports_view",
            "vdvk_demo_unit_view",
            "verify_utilisation_view",
        ];
    }

    private function sioUser()
    {
        return [
            "master_management_view",
            "equipment_master_add",
            "equipment_master_edit",
            "equipment_master_status",
            "mo_type_master_add",
            "mo_type_master_edit",
            "mo_type_master_status",
            "designation_master_add",
            "designation_master_edit",
            "designation_master_status",
            "department_master_add",
            "department_master_edit",
            "department_master_status",

            "user_management_view",
            "user_management_add",
            "user_management_edit",

            "mo_management_view",
            "mo_management_add",
            "mo_management_edit",
            "mo_management_status",
            "mo_management_mapping_with_inspection_user",
            "mo_management_mapping_with_supervisor_user",
            "surveyor_management_view",
            "surveyor_management_add",
            "surveyor_management_edit",
            "surveyor_management_status",
            "surveyor_management_mapping_with_supervisor",
            "supervisor_management_view",
            "supervisor_management_add",
            "supervisor_management_edit",
            "supervisor_management_status",
            "shg_management_view",
            "haat_bazaar_management_view",
            "warehouse_management_view",
            "shg_group_management_view",
            "pmvdy_proposal_management_view",
            "pmvdy_proposal_management_approval_management",
            "fund_management_view",
            "generate_sanction_letter_view",
            "release_funds_view",
            "release_funds_add",
            "release_funds_edit",
            "utilization_management_view",
            "utilization_management_add",
            "utilization_management_edit",
            "fund_distribution_view",
            "fund_distribution_add",
            "fund_distribution_edit",
            "checklist_management_view",
            "checklist_management_add",
            "checklist_management_edit",
            "inspection_management_view",
            "inspection_management_add",
            "inspection_management_edit",
            "evaluation_management_view",
            "mis_reports_view",
            "vdvk_demo_unit_view",
            "verify_utilisation_view",
            "verify_utilisation_add",
            "verify_utilisation_edit",
        ];
    }
}
