<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'           => 'SENG Sourng',
                'username'       => 'superadmin',
                'phone_no'       => '092771244',
                'email'          => 'superadmin@gmail.com',
                'password'       => bcrypt('11112222'),
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
