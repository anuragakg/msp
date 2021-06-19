<?php

use Illuminate\Database\Seeder;

class CategoryMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            'Category 1',
            'Category 2',
            'Category 3',
            'Category 4',
            
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
