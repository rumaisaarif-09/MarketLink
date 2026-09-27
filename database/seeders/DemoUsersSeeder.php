<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUsersSeeder extends Seeder
{
    public function run(): void
    {
        $demoUsers = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'role' => 'admin',
                'password' => '123456789',
                'is_active' => true,
            ],
            [
                'name' => 'Vendor User',
                'email' => 'vendor@example.com',
                'role' => 'vendor',
                'password' => '12345678',
                'is_active' => true,
            ],
            [
                'name' => 'Customer User',
                'email' => 'customer@example.com',
                'role' => 'buyer',
                'password' => '12345678',
                'is_active' => true,
            ],
        ];

        foreach ($demoUsers as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'role' => $user['role'],
                    'password' => Hash::make($user['password']),
                    'is_active' => $user['is_active'],
                ]
            );
        }
    }
}
