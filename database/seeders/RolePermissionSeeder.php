<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'access_users']);
        Permission::create(['name' => 'create_users']);
        Permission::create(['name' => 'edit_users']);
        Permission::create(['name' => 'delete_users']);

        Permission::create(['name' => 'edit_profile']);

        Permission::create(['name' => 'access_roles']);
        Permission::create(['name' => 'create_roles']);
        Permission::create(['name' => 'edit_roles']);
        Permission::create(['name' => 'delete_roles']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'admin'])
            ->givePermissionTo([
                'access_users',
                'create_users',
                'edit_users',
                'edit_profile',
            ]);

        $role = Role::create(['name' => 'user'])
            ->givePermissionTo(['edit_profile']);
    }
}
