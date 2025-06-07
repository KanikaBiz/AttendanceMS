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
                'title' => 'Super Admin',
            ],
            [
                'id'    => 2,
                'title' => 'Teacher',
            ],
            [
                'id'    => 3,
                'title' => 'Student',
            ],
            [
                'id'    => 4,
                'title' => 'Parent',
            ],

        ];

        Role::insert($roles);
    }
}
