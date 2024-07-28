<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear permisos para admin
        $adminPermissions = [
            'view users',
            'view request',
            'view companies',
            'view type of activities',
            'add users',
            'view filter',
            'view convert',
        ];

        // Crear permisos para user
        $userPermissions = [
            'view companies',
            'view type of activities',
            'apply for role',
            'view convert',

        ];

        foreach ($adminPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        foreach ($userPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Asignar permisos a roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::whereIn('name', $adminPermissions)->get());

        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->givePermissionTo(Permission::whereIn('name', $userPermissions)->get());
    }
}
