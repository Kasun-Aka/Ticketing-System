<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Standard Customer
        User::create([
            'name' => 'Standard User',
            'email' => 'customer@example.com',
            'password' => Hash::make('password'),
            'role' => 'customer'
        ]);

        // 2. Premium Customer
        User::create([
            'name' => 'Premium User',
            'email' => 'premium@example.com',
            'password' => Hash::make('password'),
            'role' => 'premium_customer'
        ]);

        // 3. Admin User
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);
    }
}