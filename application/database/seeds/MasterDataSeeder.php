<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('id_proof_master')->truncate();

        $idProofs = [
            'Aadhaar ID',
            'Voter ID',
            'PAN ID',
            'Other Govt ID'
        ];

        foreach ($idProofs as $idProof) {
            DB::table('id_proof_master')->insert([
                'title' => $idProof,
                'status' => 1,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
       
        /*...............................Designations Master Seeder.................*/

        DB::table('designation_master')->truncate();

        $designations = [
            'Designation A',
            'Designation B',
            'Designation C',
            'Designation D',
        ];

        foreach ($designations as $designation) {
            DB::table('designation_master')->insert([
                'title'      => $designation,
                'status'     => 1,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => now(),
                'updated_at' => now(),                
            ]);
        }

        /*...............................Departments Master Seeder.................*/

        DB::table('department_master')->truncate();

        $departments = [
            'B Tech A',
            'MCA'
        ];

        foreach ($departments as $department) {
            DB::table('department_master')->insert([
                'title'      => $department,
                'status'     => 1,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => now(),
                'updated_at' => now(),                
            ]);
        }

        
        

        /*...............................Educations Master Seeder.................*/

       

        $educations = [
			'Illiterate',
			'Primary',
			'Upper Primary',
			'High School',
			'Class XII',
			'Diploma',
			'Graduate',
			'Post-Graduate',
        ];

        foreach ($educations as $education) {
            DB::table('education_master')->insert([
                'title'      => $education,
                'status'     => 1,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => now(),
                'updated_at' => now(),                
            ]);
        }

        

        /*...............................Year Seeder.................*/

        DB::table('year_master')->truncate();

        $years = [
            '2016',
            '2017',
            '2018',
            '2019',
            '2020',
            '2021',
        ];

        foreach ($years as $year) {
            DB::table('year_master')->insert([
                'title'      => $year,
                'status'     => 1,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
