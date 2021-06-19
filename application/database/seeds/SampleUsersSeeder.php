<?php

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SampleUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('user_details')->truncate();
        DB::table('user_bank_details')->truncate();
        $faker = Factory::create();

        $superAdmin = DB::table('user_roles')->where('slug', 'super_admin')->first();
        $trifed_user = DB::table('user_roles')->where('slug', 'trifed_user')->first();
        $ministry_user = DB::table('user_roles')->where('slug', 'ministry_user')->first();
        $nd = DB::table('user_roles')->where('slug', 'nd')->first();
        $sia = DB::table('user_roles')->where('slug', 'sia')->first();
        $dia = DB::table('user_roles')->where('slug', 'district_inspection_agency')->first();
        $pa = DB::table('user_roles')->where('slug', 'procurement_agent')->first();

        

        $sample_users = [
            [
                'user_name' => 'super.admin',
                'name' => 'Super',
                'middle_name' => '',
                'last_name' => 'Admin',
                'email' => 'super@yopmail.com',
                'email_verify_token' => 'testemailtoken1',
                'role' => $superAdmin->id,
                'mobile_no' => 9910785273,
                'created_by' => 0,
                'updated_by' => 0,
                'password' => bcrypt(hash('sha256', 'password')),
            ],
     
        ];

        foreach ($sample_users as $user) {
            $insert=DB::table('users')->insert($user);
            
            $exists = DB::table('users')->where('email', $user['email'])->first();

            if ($exists) {
                $data_id = $exists->id;

                
                    $user_details = [
                        'state' => 1,
                        'district' => 1,
                        'block' => 1,
                        'id_proof_type' => 1,
                        'id_proof_value' => 1,
                        'created_by' => 0,
                        'updated_by' => 0
                    ];
                    
                    $user_details['user_id'] = $data_id;
                    

                    DB::table('user_details')->insert($user_details);
                    
                
            }

            
        }

        /*DB::table('users')->truncate();
        DB::table('user_details')->truncate();
        DB::table('user_bank_details')->truncate();*/
        
        
        
        //$this->superAdminSeeder($sample_users[0], $user_details);
        
        
        
    }

    private function superAdminSeeder($sample_user, $user_details) {

        $user_bank_details = [
            'bank_name' => 'HDFC',
            'branch_name' => 'Noida',
            'bank_ac_no' => '2174070359',
            'mobile_no' => 9910785273,
            'ifsc_code' => 'HDFC231946',
            'created_by' => 0,
            'updated_by' => 0
        ];

        $super_admin_details = [
            'user_type' => 1,
            'survey_for' => 1,
            'supervising_for' => 2,
            'alternate_no' => 9191919191,
            'phone_type' => 1,
            'is_phone_self_owned' => 1,
            'created_by' => 0,
            'updated_by' => 0
        ];

        $exists = DB::table('users')->where('email', $sample_user['email'])->exists();
        if (!$exists) {
            $data_id = DB::table('users')->insertGetId($sample_user);

            $user_details['user_id'] = $data_id;
            $user_bank_details['user_id'] = $data_id;
            $super_admin_details['user_id'] = $data_id;

            DB::table('user_details')->insert($user_details);
            DB::table('user_bank_details')->insert($user_bank_details);
            
        }
    }

    
}
