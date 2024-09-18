<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'it@evsu.com',
                'password' => bcrypt('admin123'),
                'remember_token' => null,

            ],
            [
                'name' => 'Coordinator', //managing ging the roles to the users
                'email' => 'coodinator@evsu.com',
                'password' => bcrypt('admin123'),
                'remember_token' => null,
            ]
        ];

        User::insert($users);

    }
}
