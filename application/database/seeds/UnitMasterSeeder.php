<?php

use Illuminate\Database\Seeder;

class UnitMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            'Lit',
            'KG',
        ];
        foreach ($category as $cat) {
            DB::table('category')->insert([
                'title'      => $cat,
                'status'     => 1,
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
