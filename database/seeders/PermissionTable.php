<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleUser = Role::where('name', 'Nutzer')->first();
        $roleManager = Role::where('name', 'Manager')->first();
        $roleAdministrator = Role::where('name', 'Administrator')->first();


        if (isset($roleUser) && isset($roleManager) && isset($roleAdministrator) ){
            /*
             * users permissions
             */
            $permission = Permission::create(['name' => 'view contacts']);
            $permission->assignRole($roleUser);
            $permission->assignRole($roleManager);
            $permission->assignRole($roleAdministrator);

            $permission = Permission::create(['name' => 'create contacts']);
            $permission->assignRole($roleUser);
            $permission->assignRole($roleManager);
            $permission->assignRole($roleAdministrator);

            $permission = Permission::create(['name' => 'edit contacts']);
            $permission->assignRole($roleUser);
            $permission->assignRole($roleManager);
            $permission->assignRole($roleAdministrator);

            $permission = Permission::create(['name' => 'delete contacts']);
            $permission->assignRole($roleManager);
            $permission->assignRole($roleAdministrator);


        }
    }
}
