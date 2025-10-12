<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            // Dashboard permissions
            'view dashboard',

            // User permissions
            'view users',
            'create users',
            'edit users',
            'delete users',

            // Role permissions
            'view roles',
            'create roles',
            'edit roles',
            'delete roles',

            // Permission permissions
            'view permissions',
            'create permissions',
            'edit permissions',
            'delete permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $editorRole = Role::firstOrCreate(['name' => 'Editor']);
        $viewerRole = Role::firstOrCreate(['name' => 'Viewer']);

        // Admin gets all permissions
        $adminRole->givePermissionTo(Permission::all());

        // Editor gets limited permissions
        $editorRole->givePermissionTo([
            'view dashboard',
            'view users',
            'create users',
            'edit users',
            'view roles',
            'view permissions',
        ]);

        // Viewer gets read-only permissions
        $viewerRole->givePermissionTo([
            'view dashboard',
            'view users',
            'view roles',
            'view permissions',
        ]);
    }
}
