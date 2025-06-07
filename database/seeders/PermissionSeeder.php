<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create Permissions
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-view',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permission]);
        }

        //Create Roles and assign created permissions
        $adminRoles= [
            'Admin' => [
                'user-list',
                'user-create',
                'user-edit',
                'user-delete',
                'user-view',
                'role-list',
                'role-create',
                'role-edit',
                'role-delete',
            ],
            'User' => [
                'user-list',
                'user-view',
            ],
        ];

        foreach ($adminRoles as $role => $permissions) {
            $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => $role]);
            $role->syncPermissions($permissions);
        }

       // Asign all permissions to Admin
        $adminRole = \Spatie\Permission\Models\Role::findByName('Admin');
        // $adminRole->givePermissionTo(\Spatie\Permission\Models\Permission::all());
        // $adminRole->syncPermissions(\Spatie\Permission\Models\Permission::all());
        // $adminRole->givePermissionTo(\Spatie\Permission\Models\Permission::pluck('name'));
        $adminRole->syncPermissions( $adminRoles);

        // Create a default user and assign the Admin role
        $user = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('11112222'),
        ]);
        $user->assignRole('Admin');
    }
}
