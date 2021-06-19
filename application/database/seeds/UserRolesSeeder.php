<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_roles')->truncate();

        $availableRoles = [
            [
                'title' => 'Super Administrator',
                'slug' => 'super_admin',
                'role_type' => 0
            ],
            [
                'title' => 'TRIFED User',
                'slug' => 'trifed_user',
                'role_type' => 1
            ],
            [
                'title' => 'Ministry User',
                'slug' => 'ministry_user',
                'role_type' => 1
            ],
            [
                'title' => 'Nodal Department',
                'slug' => 'nd',
                'role_type' => 1
            ],
          
            [
                'title' => 'State Implementing Agent',
                'slug' => 'sia',
                'role_type' => 1
            ],
           
            [
                'title' => 'District Implementation Agency/Implementation Agency',
                'slug' => 'district_inspection_agency',
                'role_type' => 1
            ],
            [
                'title' => 'Procurement Agent',
                'slug' => 'procurement_agent',
                'role_type' => 1
            ],
            [
                'title' => 'Auction Committee',
                'slug' => 'auction_committee',
                'role_type' => 1
            ],
            [
                'title' => 'Warehouse User',
                'slug' => 'warehouse_user',
                'role_type' => 1
            ],
            [
                'title' => 'Buyer',
                'slug' => 'buyer',
                'role_type' => 1
            ],
            [
                'title' => 'Trade Surveyors',
                'slug' => 'trade_surveyor',
                'role_type' => 1
            ],
            
        ];

        foreach ($availableRoles as $key => $role) {
            DB::table('user_roles')->insert([
                'title' => $role['title'],
                'slug' => $role['slug'],
                'description' => '',
                'role_type' => (string) $role['role_type'],
                'status' => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
