<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'dashboard_access',
                'group' => 'Dashboard'
            ],
            [
                'id'    => 2,
                'title' => 'user_management_access',
                'group' => 'User Management'
            ],
            [
                'id'    => 3,
                'title' => 'permission_create',
                'group' => 'Permission'
            ],
            [
                'id'    => 4,
                'title' => 'permission_edit',
                'group' => 'Permission'
            ],
            [
                'id'    => 5,
                'title' => 'permission_show',
                'group' => 'Permission'
            ],
            [
                'id'    => 6,
                'title' => 'permission_delete',
                'group' => 'Permission'
            ],
            [
                'id'    => 7,
                'title' => 'permission_access',
                'group' => 'Permission'
            ],
            [
                'id'    => 8,
                'title' => 'role_create',
                'group' => 'Role'
            ],
            [
                'id'    => 9,
                'title' => 'role_edit',
                'group' => 'Role'
            ],
            [
                'id'    => 10,
                'title' => 'role_show',
                'group' => 'Role'
            ],
            [
                'id'    => 11,
                'title' => 'role_delete',
                'group' => 'Role'
            ],
            [
                'id'    => 12,
                'title' => 'role_access',
                'group' => 'Role'
            ],
            [
                'id'    => 13,
                'title' => 'user_create',
                'group' => 'User'
            ],
            [
                'id'    => 14,
                'title' => 'user_edit',
                'group' => 'User'
            ],
            [
                'id'    => 15,
                'title' => 'user_show',
                'group' => 'User'
            ],
            [
                'id'    => 16,
                'title' => "user_delete",
                "group"   => "User"
            ],
            [
                'id'    => 17,
                'title' => 'user_access',
                'group' => 'User'
            ],
            [
                'id'    => 18,
                'title' => 'profile_password_edit',
                'group' => 'Profile'
            ],

        ];
        Permission::insert($permissions);
    }
}
