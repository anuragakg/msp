<?php

namespace App\Lib;

use Illuminate\Support\Arr;

class AdditionalPermissions
{
    private $user;

    /**
     * 
     * @param \App\Models\User $user
     */
    function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Grants or revokes permission based on logic.
     * @param mixed $permission 
     * @return void|array 
     */
    public function grantPermissions(&$permission)
    {
        if (in_array($this->user->role, [11, 12])) {
           // return $this->surveyorSupervisorPermissions($permission);
        }
        return [];
    }

    public function surveyorSupervisorPermissions(&$permission)
    {

        $mappings = [
            1 => [
                "shg_management",
                "shg_management_view",
                "shg_management_add",
                "shg_management_edit",
                "shg_management_status",
                "shg_group_management",
                "shg_group_management_view",
                "shg_group_management_add",
                "shg_group_management_edit",
                "shg_group_management_status"
            ],
            2 => [
                'haat_bazaar_management', "haat_bazaar_management_view",
                "haat_bazaar_management_add",
                "haat_bazaar_management_edit",
                "haat_bazaar_management_status",
            ],
            3 => [
                'warehouse_management', "warehouse_management_view",
                "warehouse_management_add",
                "warehouse_management_edit",
                "warehouse_management_status",
            ],
            4 => ['capture_location_management', 'capture_location_management_view', 'capture_location_management_add', 'capture_location_management_edit', 'capture_location_management_status'],
        ];

        $details = $this->user->getSurveyorSupervisorDetails;

        /**
         * Will contain permission to remove.
         */
        $toRemove = [];

        if ($this->user->role == 11) {
            $toRemove = array_diff([1, 2, 3, 4], $details->survey_for);
        }
        /** Supervisor */
        if ($this->user->role == 12) {
            $toRemove = array_diff([1, 2, 3, 4], $details->supervising_for);
        }

        /**
         * Loop through indexes and create array of permissions to remove.
         */
        $toRemove = array_map(function ($v) use ($mappings) {
            return $mappings[$v];
        }, $toRemove);

        $toRemove = Arr::flatten($toRemove);
        /**
         * Finally filter the array of permissions.
         */
        $permission = array_filter($permission, function ($p) use ($toRemove) {
            return !in_array($p, $toRemove);
        });
    }
}
