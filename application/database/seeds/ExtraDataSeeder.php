<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExtraDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('financial_year_master')->truncate();

        $financialYears = [
            '2018-2019',
            '2019-2020',
            '2020-2021'
        ];

        foreach ($financialYears as $financialYear) {
            DB::table('financial_year_master')->insert([
                'title'      => $financialYear,
                'status'     => 1,
                'created_by' => 0,
                'updated_by' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        
    }
}

