<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DefaultUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@a.a'],
            [
                'name' => 'Admin Account',
                'password' => Hash::make('secret123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@a.a'],
            [
                'name' => 'User Account',
                'password' => Hash::make('secret123'),
                'role' => 'user',
            ]
        );
    }
}
