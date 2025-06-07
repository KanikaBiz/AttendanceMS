<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Admin',
            ],
            [
                'id'    => 2,
                'title' => 'User',
            ],
            [
                'id'    => 3,
                'title' => 'Librarian',
            ],
            [
                'id'    => 4,
                'title' => 'Member',
            ],
            [
                'id'    => 5,
                'title' => 'Super Admin',
            ],
            [
                'id'    => 6,
                'title' => 'Staff',
            ],
            [
                'id'    => 7,
                'title' => 'Guest',
            ],
            [
                'id'    => 8,
                'title' => 'Manager',
            ],
            [
                'id'    => 9,
                'title' => 'Editor',
            ],
            [
                'id'    => 10,
                'title' => 'Viewer',
            ],
        ];

        Role::insert($roles);
    }
}
