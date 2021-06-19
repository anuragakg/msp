<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /** User management seeders */
        $this->call(UserRolesSeeder::class);
        $this->call(SampleUsersSeeder::class);
        $this->call(UserPermissionsSeeder::class);
        $this->call(MappingRolesPermission::class);
        $this->call(MasterDataSeeder::class);
        $this->call(ExtraDataSeeder::class);

        /** Email Template seeder **/
         $this->call(EmailTemplatesSeeder::class);
    }
}
