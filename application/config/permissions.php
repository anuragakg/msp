<?php

$manageMaster = [
    'index' => ['manage_master', 'view_master'],
    'show' => ['manage_master', 'view_master'],
    'store' => ['manage_master', 'add_master'],
    'update' => ['manage_master', 'edit_master'],
    'destroy' => ['manage_master'],
];

return [
    /**
     * Permissions
     */
    'permission' => 'manage_permissions',
    'permission' => [
        'change_status' => 'manage_permissions',
    ],

    /**
     * Masters
     */
    "all-masters" => $manageMaster,
    "access-road" => $manageMaster,
    "bank" => $manageMaster,
    "block" => $manageMaster,
    "block-location" => $manageMaster,
    "boundary-wall" => $manageMaster,
    "budget-master" => $manageMaster,
    "built-up-area" => $manageMaster,
    "category" => $manageMaster,
    "commodity" => $manageMaster,
    "consignment-shop" => $manageMaster,
    "coordinating-agency" => $manageMaster,
    "cost" => $manageMaster,
    "department" => $manageMaster,
    "designation" => $manageMaster,
    "district" => $manageMaster,
    "education" => $manageMaster,
    "equipments" => $manageMaster,
    "financial-year" => $manageMaster,
    "franchise" => $manageMaster,
    "id-proof" => $manageMaster,
    "level" => $manageMaster,
    "location" => $manageMaster,
    "market-regulation" => $manageMaster,
    "market-type" => $manageMaster,
    "data" => $manageMaster,
    "member-relation" => $manageMaster,
    "mfp-use" => $manageMaster,
    "occupation" => $manageMaster,
    "office-bearer-role" => $manageMaster,
    "org-type" => $manageMaster,
    "owned-shop" => $manageMaster,
    "periodicity" => $manageMaster,
    "permission" => $manageMaster,
    "permission-mapping" => $manageMaster,
    "phone-type" => $manageMaster,
    "procurement-agent" => $manageMaster,
    "regulation" => $manageMaster,
    "role" => $manageMaster,
    "ro-name" => $manageMaster,
    "rpm-ownership" => $manageMaster,
    "scheduled-tribes" => $manageMaster,
    "specialisation" => $manageMaster,
    "state" => $manageMaster,
    "status-engagement" => $manageMaster,
    "training-status" => $manageMaster,
    "transportation" => $manageMaster,
    "unit" => $manageMaster,
    "vehicle" => $manageMaster,
    "village" => $manageMaster,
    "warehouse-age" => $manageMaster,
    "warehouse-condition" => $manageMaster,
    "warehouse-premises" => $manageMaster,
    "warehouse-type" => $manageMaster,
    "year" => $manageMaster,

    /**
     * Project proposal
     */
    "project-proposal" => [
        "proposed-location" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "proposed-shg" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "proposed-mfp" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "proposed-value-addition" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "training-details" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "equipments" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "haat-bazaar" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "warehouse" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "financial" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "highlight" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "buyer-tieups" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "fund-request" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "vdvk-demo-unit" => 'mark_vdvk_demo_unit',
        "proposed-vdvk-fund" => [
            "screen-one" => 'fund_management',
            "screen-two" => 'fund_management',
            'index' => 'fund_management',
            'show' => 'fund_management',
            'store' => 'fund_management',
            'update' => 'fund_management',
            'destroy' => 'fund_management',
        ]
    ],

    /**
     * Actual project proposal
     */
    "actual-proposal" => [
        "actual-location" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "actual-shg" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "proposed-mfp" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "proposed-value-addition" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "training-details" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "equipments" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "haat-bazaar" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "warehouse" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "financial" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "highlight" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "buyer-tieups" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
        "fund-request" => [
            'index' => 'monitor_pmvdy_proposal',
            'show' => 'monitor_pmvdy_proposal',
            'store' => 'monitor_pmvdy_proposal',
            'update' => 'monitor_pmvdy_proposal',
            'destroy' => 'monitor_pmvdy_proposal',
        ],
    ],

    "vdvk" => [
        'proposed-vdvk-list' => ['view_verify_pmvdy_proposal', 'verify_pmvdy_proposal', 'view_pmvdy_proposal'],
        'proposed-mo-vdvk-list' => ['view_verify_pmvdy_proposal', 'verify_pmvdy_proposal', 'view_pmvdy_proposal'],
        'proposed-get-all' => ['view_verify_pmvdy_proposal', 'verify_pmvdy_proposal', 'view_pmvdy_proposal'],
    ],

    /**
     * Role Mapping
     */

    "state-level-role" => [
        'index' => 'role_mapping',
        'show' => 'role_mapping',
        'store' => 'role_mapping',
        'update' => 'role_mapping',
        'destroy' => 'role_mapping',
    ],
    "fund-flow-state-level-role" => [
        'index' => 'role_mapping',
        'show' => 'role_mapping',
        'store' => 'role_mapping',
        'update' => 'role_mapping',
        'destroy' => 'role_mapping',
    ],

    /**
     * User Management
     */

    "user" => [
        'index' => ['manage_snd_nd', 'manage_inspection_evaluation_users', 'manage_sio_dio', 'manage_project_administrators', 'manage_users'],
        'show' => ['manage_snd_nd', 'manage_inspection_evaluation_users', 'manage_sio_dio', 'manage_project_administrators', 'manage_users'],
        'store' => ['manage_snd_nd', 'manage_inspection_evaluation_users', 'manage_sio_dio', 'manage_project_administrators', 'manage_users'],
        'update' => '',
        'destroy' => '',
        'update-status' => '',
        'export' => '',
        'import-excel' => '',
        'download-excel' => '',
        'mo-supervisor' => 'manage_mapping_supervisors',
        'get-evaluation-user' => ['manage_mapping_evaluation_users','manage_inspection_evaluation_users'],
        'get-inspection-user' => ['manage_mapping_inspection_users','manage_inspection_evaluation_users'],
    ],

    /**
     * Surveyor / Supervisor
     */

    "surveyor" => [
        'index' => 'manage_surveyor',
        'show' => 'manage_surveyor',
        'store' => 'manage_surveyor',
        'update' => 'manage_surveyor',
        'destroy' => 'manage_surveyor',
        'status' => 'manage_surveyor'
    ],

    "supervisor" => [
        'index' => 'manage_supervisor',
        'show' => 'manage_supervisor',
        'store' => 'manage_supervisor',
        'update' => 'manage_supervisor',
        'destroy' => 'manage_supervisor',
        'status' => 'manage_supervisor',
        'mapping' => 'manage_mapping_surveyors_supervisor'
    ],

    "surveyor-supervisor" => [
        'import' => 'import_surveyor_supervisor'
    ],

    /**
     * Mentoring Organization
     */

    "mentoring-organisation" => [
        'index' => 'manage_mo',
        'show' => 'manage_mo',
        'store' => 'manage_mo',
        'update' => 'manage_mo',
        'destroy' => 'manage_mo',
        'status' => 'manage_mo',
        'import' => ['manage_mo', 'import_mo'],
        'member-details' => 'manage_mo',
        'inspection-mapping' => [
            'index' => ['manage_mapping_inspection_users'],
            'show' => ['manage_mapping_inspection_users'],
            'store' => ['manage_mapping_inspection_users'],
            'update' => ['manage_mapping_inspection_users'],
            'destroy' => ['manage_mapping_inspection_users'],
        ],
        'evaluation-mapping' => [
            'index' => ['manage_mapping_evaluation_users'],
            'show' => ['manage_mapping_evaluation_users'],
            'store' => ['manage_mapping_evaluation_users'],
            'update' => ['manage_mapping_evaluation_users'],
            'destroy' => ['manage_mapping_evaluation_users'],
        ],
        'evaluation-mapping-detail' => 'manage_mapping_evaluation_users',
        'inspection-mapping-detail' => 'manage_mapping_inspection_users',
    ],

    /**
     * SHG Gatherer / SHG Group
     */

    "shg" => [
        "part-one" => [
            'index' => ['manage_shg_gatherers', 'view_shg_gatherers'],
            'show' => ['manage_shg_gatherers', 'view_shg_gatherers'],
            'store' => ['manage_shg_gatherers', 'add_shg_gatherers'],
            'update' => ['manage_shg_gatherers', 'edit_shg_gatherers'],
            'destroy' => '',
        ],
        "part-two" => [
            'index' => ['manage_shg_gatherers', 'view_shg_gatherers'],
            'show' => ['manage_shg_gatherers', 'view_shg_gatherers'],
            'store' => ['manage_shg_gatherers', 'add_shg_gatherers'],
            'update' => ['manage_shg_gatherers', 'edit_shg_gatherers'],
            'destroy' => '',
        ],
        "group" => [
            'index' => ['manage_shg_groups', 'view_shg_groups'],
            'show' => ['manage_shg_groups', 'view_shg_groups'],
            'store' => ['manage_shg_groups', 'add_shg_groups'],
            'update' => ['manage_shg_groups', 'edit_shg_groups'],
            'destroy' => '',
            'download-excel' => '',
            'import-excel' => ['manage_shg_groups', 'import_shg_groups'],
        ],
        "manage" => [
            'index' => 'view_shg_gatherers',
            'show' => 'view_shg_gatherers',
            'store' => 'view_shg_gatherers',
            'update' => 'view_shg_gatherers',
            'destroy' => '',
        ],
        "manage-all" => ['view_shg_gatherers'],
        "gatherer" => [
            'download-excel' => '',
            'import-excel' => ['manage_shg_gatherers', 'import_shg_gatherers'],
        ],
    ],

    /**
     * Haat Bazaar
     */

    "haat-market" => [
        "part-one" => [
            'index' => ['manage_haat_bazaar', 'view_haat_bazaar'],
            'show' => ['manage_haat_bazaar', 'view_haat_bazaar'],
            'store' => ['manage_haat_bazaar', 'add_haat_bazaar'],
            'update' => ['manage_haat_bazaar', 'edit_haat_bazaar'],
            'destroy' => '',
        ],
        "part-two" => [
            'index' => ['manage_haat_bazaar', 'view_haat_bazaar'],
            'show' => ['manage_haat_bazaar', 'view_haat_bazaar'],
            'store' => ['manage_haat_bazaar', 'add_haat_bazaar'],
            'update' => ['manage_haat_bazaar', 'edit_haat_bazaar'],
            'destroy' => '',
        ],
        "part-three" => [
            'index' => ['manage_haat_bazaar', 'view_haat_bazaar'],
            'show' => ['manage_haat_bazaar', 'view_haat_bazaar'],
            'store' => ['manage_haat_bazaar', 'add_haat_bazaar'],
            'update' => ['manage_haat_bazaar', 'edit_haat_bazaar'],
            'destroy' => '',
        ],
        "part-four" => [
            'index' => ['manage_haat_bazaar', 'view_haat_bazaar'],
            'show' => ['manage_haat_bazaar', 'view_haat_bazaar'],
            'store' => ['manage_haat_bazaar', 'add_haat_bazaar'],
            'update' => ['manage_haat_bazaar', 'edit_haat_bazaar'],
            'destroy' => '',
        ],
        "manage" => [
            'index' => 'view_haat_bazaar',
            'show' => 'view_haat_bazaar',
            'store' => 'view_haat_bazaar',
            'update' => 'view_haat_bazaar',
            'destroy' => '',
        ],
        "manage-all" => ['view_haat_bazaar'],
        'download-excel' => '',
        'import-excel' => ['manage_haat_bazaar', 'import_haat_bazaar'],
    ],

    /**
     * Warehouse
     */
    "warehouse" => [
        "part-one" => [
            'index' => ['manage_warehouse', 'view_warehouse'],
            'show' => ['manage_warehouse', 'view_warehouse'],
            'store' => ['manage_warehouse', 'add_warehouse'],
            'update' => ['manage_warehouse', 'edit_warehouse'],
            'destroy' => '',
        ],
        "part-two" => [
            'index' => ['manage_warehouse', 'view_warehouse'],
            'show' => ['manage_warehouse', 'view_warehouse'],
            'store' => ['manage_warehouse', 'add_warehouse'],
            'update' => ['manage_warehouse', 'edit_warehouse'],
            'destroy' => '',
        ],
        "part-three" => [
            'index' => ['manage_warehouse', 'view_warehouse'],
            'show' => ['manage_warehouse', 'view_warehouse'],
            'store' => ['manage_warehouse', 'add_warehouse'],
            'update' => ['manage_warehouse', 'edit_warehouse'],
            'destroy' => '',
        ],
        "manage" => [
            'index' => 'view_warehouse',
            'show' => 'view_warehouse',
            'store' => 'view_warehouse',
            'update' => 'view_warehouse',
            'destroy' => '',
        ],
        "manage-all" => ['view_warehouse'],
        "form-mapping" => [
            'index' => 'view_warehouse',
            'show' => 'view_warehouse',
            'store' => 'view_warehouse',
            'update' => 'view_warehouse',
            'destroy' => '',
        ],
        'download-excel' => '',
        'import-excel' => ['manage_warehouse', 'import_warehouse'],
    ],


    /**
     * Fund Management
     */

    "fund-management" => [
        "vdvk-wise" => [
            'vdvkWise' => 'fund_management'
        ],
        "shg-wise" => [
            'shgWise' => 'fund_management',
        ],
        "sanction-letter" => [
            'index' => ['fund_management', 'view_sanction_letter', 'manage_sanction_letter'],
            'show' => ['fund_management', 'view_sanction_letter', 'manage_sanction_letter'],
            'store' => ['fund_management', 'add_sanction_letter', 'manage_sanction_letter'],
            'update' => ['fund_management'],
            'destroy' => '',
        ],
        'release-funds' => ''
    ],

    /**
     * Fund Distribution
     */
    "fund-distribution" => [
        'distribute' => '',
        'logs' => '',
        'screen-one' => '',
        'screen-two' => '',
        'screen-three' => '',
        'post-monitoring' => [
            'create' => 'submit_post_monitoring',
        ]
    ],

    /**
     * Monthly MFP Submission
     */
    "monthly-mfp" => [
        "get-commodity" => 'monthly_mfp_get_commodity',
        "get-vdvk" => 'monthly_mfp_get_vdvk',
        "get-unit" => 'monthly_mfp_get_unit',
        "submission" => [
            'index' => ['manage_monthly_mfp', 'view_monthly_mfp'],
            'show' => ['manage_monthly_mfp', 'view_monthly_mfp'],
            'store' => ['manage_monthly_mfp', 'add_monthly_mfp'],
            'update' => ['manage_monthly_mfp', 'edit_monthly_mfp'],
            'destroy' => '',
        ]
    ],

    /**
     * State wise summary
     */
    "state-wise-summary" => [
        'index' => 'view_state_wise_summary',
        'show' => 'view_state_wise_summary',
        'store' => 'manage_state_wise_summary',
    ],

    /**
     * Capture Location
     */
    "capture-location" => [
        'index' => 'can_capture_location',
        'show' => 'can_capture_location',
        'store' => 'can_capture_location',
        'update' => 'can_capture_location',
        'destroy' => 'can_capture_location',
    ]

];
