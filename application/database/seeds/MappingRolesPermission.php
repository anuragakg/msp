<?php

use App\Lib\PermissionMappings;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MappingRolesPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $mappings = new PermissionMappings();
        $permissions = $mappings->getMappings();

        /** TRUNCATE Table */
        DB::table('role_permissions_relationship')->truncate();

        /** Get list of all roles */
        $roles = DB::table('user_roles')->get();

        /**
         * Loop through each roles and assign the permissions.
         */
        foreach ($roles as $role) {

            if (isset($permissions[$role->slug])) {

                $getPermissions = $permissions[$role->slug];

                foreach ($getPermissions as $key => $alias) {
                    $permissionObj = DB::table('permissions')->where('alias', $alias);

                    if ($permissionObj->exists()) {

                        $p = $permissionObj->first();

                        /** Assign Permission */
                        DB::table('role_permissions_relationship')->insert([
                            'role_id' => $role->id,
                            'permission_id' => $p->id,
                        ]);
                    }
                }
            }
        }
    }
}
