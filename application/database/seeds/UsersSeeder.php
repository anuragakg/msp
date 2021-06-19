<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        DB::table('users')->insert([
            'user_name'          => 'super.admin',
            'password' 	         => '$2y$12$kGpu9koK2fTSfbXIvlSk8OuEBc.TpIXr.Q8syd595ksYQb3xpXBWa',
            'name' 			     => 'super_admin',
            'last_name' 		 => 'super_admin',
            'email' 			 => 'superadmin@gmail.com',
            'role' 				 => 1,
            'email_verify_token' => 'testemailtoken',
            'created_by' 		 => 0,
            'updated_by' 		 => 0,
            'created_at'         => now(),
            'updated_at'         => now(),

        ]);
    }
}
