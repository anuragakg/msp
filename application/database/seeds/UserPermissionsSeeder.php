<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $crud = [
            'view', 'add', 'edit',
        ];

        $cruds = array_merge($crud, ['status']);

        $permissionsList = [
            'master_management' => array(
                'view'=>array(
                    'description' => 'View',
                ),
                'add'=>array(
                    'description' => 'add',
                ),
                'edit'=>array(
                    'description' => 'edit',
                ),
                'status'=>array(
                    'description' => 'status',
                ),
            ),
            'role' => array(
                'view'=>array(
                    'description' => 'View',
                ),
                'add'=>array(
                    'description' => 'add',
                ),
                'edit'=>array(
                    'description' => 'edit',
                ),
                'status'=>array(
                    'description' => 'status',
                ),
            ),
            'role_mapping' => array(
                'view'=>array(
                    'description' => 'View',
                ),
                'add'=>array(
                    'description' => 'add',
                ),
                'edit'=>array(
                    'description' => 'edit',
                ),
                'status'=>array(
                    'description' => 'status',
                ),
            ),
            'user_management' => array(
                'add'=>array(
                    'description' => 'add',
                ),
                'edit'=>array(
                    'description' => 'edit',
                ),
                'view'=>array(
                    'description' => 'User Listing View ',
                ),
                'status'=>array(
                    'description' => 'status',
                ),
                'set_user_wise_permission'=>array(
                    'description' => 'set user wise permission',
                ),
            ),
            'mfp_procurement_plan' => array(
                'view'=>array(
                    'description' => 'mfp procurement plan view',
                ),
                'add'=>array(
                    'description' => 'mfp procurement plan add',
                ),
                'edit'=>array(
                    'description' => 'mfp procurement plan edit',
                ),
                'view_mfp_list'=>array(
                    'description' => 'MFP Procurement Listing',
                ),
            ),
            'infrastructure_development' =>array(
                'view'=>array(
                    'description' => 'View',
                ),
                'add'=>array(
                    'description' => 'add',
                ),
                'edit'=>array(
                    'description' => 'edit',
                ),
                'status'=>array(
                    'description' => 'status',
                ),
            ),
            'mfp_details'=>array(
                'add'=>array(
                    'description' => 'add',
                ),
                'view'=>array(
                    'description' => 'view',
                ),
            ),
            'fund_management'=>array(
                'approved_consolidate_view'=>array(
                    'description' => 'MFP Procurement Generate Sanction List',
                ),
                'generate_sanction_letter'=>array(
                    'description' => 'Enable generate sanction letter button',
                ),
                'view_sanction_letter'=>array(
                    'description' => 'Enable generated sanction letter View link',
                ),
                'release_fund'=>array(
                    'description' => 'MFP Procurement Release Fund List',
                ),
                'view_mfp_procurement_received_fund'=>array(
                    'description' => 'view mfp procurement received fund',
                ),
                'view_procurement_agent_fund_details'=>array(
                    'description' => 'view procurement agent fund details',
                ),
                'view_procurement_agent_received_fund'=>array(
                    'description' => 'view procurement agent received fund',
                ),
                'infrastructure_development_received_fund'=>array(
                    'description' => 'infrastructure development received fund',
                ),
            ),
            'mfp_procurement_actual_details'=>array(
                'view'=>array(
                    'description' => 'view',
                ),
                'add'=>array(
                    'description' => 'add',
                ),
                'generate_receipt'=>array(
                    'description' => 'generate receipt',
                ),
                'view_generated_receipt'=>array(
                    'description' => 'View generated receipt',
                ),
               
            ),
            'auction'=>array(
                'create_committe'=>array(
                    'description' => 'create committe',
                ),
                'view_committe'=>array(
                    'description' => 'view committe',
                ),
              
               
            ),
       
            
            
           
        ];

        // $this->dumpToJson($permissionsList);

        /** Clear the table */
        DB::table('permissions')->truncate();

        /** Seed the data */
        foreach ($permissionsList as $group => $permissions) {
            if (is_array($permissions)) {
                foreach ($permissions as $permission=>$per) {

                    DB::table('permissions')->insert([
                        'alias' => $group . '_' . $permission,
                        'name' => ucwords(str_replace('_', ' ', $permission)),
                        'description' => ucwords($per['description']),
                        'group' => $group,
                        'created_by' => 0,
                        'updated_by' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

         $permissionsList = [ 
            'fund_management'=>array(
                'infrastructure_progress_list'=>array(
                    'description' => 'infrastructure progress list',
                ),
                'infrastructure_progress_details'=>array(
                    'description' => 'infrastructure progress details',
                ),
                'infrastructure_transaction_details'=>array(
                    'description' => 'infrastructure transaction details',
                ),
                'received_infrastructure_consolidated_proposal'=>array(
                    'description' => 'received infrastructure consolidated proposal',
                ),
                'view_dia_commission_details'=>array(
                    'description' => 'View commission details of DIA',
                ),
                'view_sia_commission_details'=>array(
                    'description' => 'View commission details of SIA',
                ),
            ),
            'mfp_procurement_transaction_details'=>array(
                'view'=>array(
                    'description' => 'view',
                ),
                'approve_revert_reject'=>array(
                    'description' => 'approve revert reject',
                ),
                'consolidated_transaction_view_PA'=>array(
                    'description' => 'consolidated transaction view PA',
                ),
                'consolidated_transaction_view'=>array(
                    'description' => 'consolidated transaction view',
                ),
            ),
            'auction'=>array(
                'create_transaction_detail'=>array(
                    'description' => 'create transaction detail',
                ),
                'view_transaction_detail'=>array(
                    'description' => 'view transaction detail',
                ),
               
            ),
            'msp_market_price'=>array(
                'approval'=>array(
                    'description' => 'approval',
                ),
                'add'=>array(
                    'description' => 'add',
                ),
                'edit'=>array(
                    'description' => 'edit',
                ),
                'view_pending'=>array(
                    'description' => 'view pending',
                ),
                'view_approved'=>array(
                    'description' => 'view approved',
                ),
               
            ),
            /*'fund_management' => ['infrastructure_progress_list','infrastructure_progress_details','infrastructure_transaction_details','received_infrastructure_consolidated_proposal'],  
            'mfp_procurement_transaction_details'=>['view','approve_revert_reject','consolidated_transaction_view_PA','consolidated_transaction_view'],
            'auction'=>['create_transaction_detail','view_transaction_detail'],
            'msp_market_price'=>['approval','add','edit','view_pending','view_approved'],*/


        ];

        foreach ($permissionsList as $group => $permissions) {
            if (is_array($permissions)) {
                foreach ($permissions as $permission=>$per) {

                    DB::table('permissions')->insert([
                        'alias' => $group . '_' . $permission,
                        'name' => ucwords(str_replace('_', ' ', $permission)),
                        'description' => ucwords($per['description']),
                        'group' => $group,
                        'created_by' => 0,
                        'updated_by' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }

    }

    /**
     * Dumps permission list to json.
     * @param mixed $permissionsList 
     * @return void 
     */
    private function dumpToJson($permissionsList)
    {
        $final = [];
        foreach ($permissionsList as $group => $permissions) {
            if (is_array($permissions)) {
                foreach ($permissions as $permission) {
                    $final[$group][] = $group . '_' . $permission;
                }
            }
        }
        echo json_encode($final);
        die;
    }
}
