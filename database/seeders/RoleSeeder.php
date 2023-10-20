<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{

    public function run(): void
    {
        $role1 = Role::create(
            ['name' => 'Admin']
        );
        $role2 = Role::create(
            ['name' => 'Proveedor']
        );

        //Permisos
        Permission::create(['name'=>'dashboard'])->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'providers.loadProviders'])->assignRole($role1);
        Permission::create(['name'=>'providers.exportExcel'])->assignRole($role1);
        Permission::create(['name'=>'providers.edit'])->assignRole($role1);
        Permission::create(['name'=>'providers.delete'])->assignRole($role1);
        Permission::create(['name' => 'solicitudes.view'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'view.files'])->assignRole($role1);
        Permission::create(['name' => 'solicitudes.exportExcel'])->assignRole($role1);
        Permission::create(['name' => 'solicitudes.delete'])->assignRole($role1);
        Permission::create(['name' => 'answers.view'])->assignRole($role1);
        Permission::create(['name' => 'answers.exportExcel'])->assignRole($role1);
        Permission::create(['name' => 'notifications.viewNotifications'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'notifications.readNotifications'])->syncRoles([$role1, $role2]);


    }
}
