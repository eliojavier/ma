<?php

use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder {

    public function run()
    {
        $PermissionIds = App\Permission::lists('id')->toArray();
        $RoleAdminId = App\Role::where('name','admin')->lists('id')->first();

        foreach ($PermissionIds as $id){
            DB::table('permission_role')->insert([
                'permission_id' => $id,
                'role_id' => $RoleAdminId
            ]);
        }
    }
}