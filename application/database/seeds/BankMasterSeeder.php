<?php

use Illuminate\Database\Seeder;

class BankMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            'PBN',
            'SBI',
            'BOB',
            'Syndicate',
            
        ];
        foreach ($category as $cat) {
            DB::table('bank_master')->insert([
                'title'      => $cat,
                'ifsc_code'      => $cat,
                'status'     => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
