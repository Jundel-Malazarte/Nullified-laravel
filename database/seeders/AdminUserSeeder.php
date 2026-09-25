<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'full_name' => 'Admin User',
            'email' => 'admin@nullified.com',
            'password' => Hash::make('Admin@123'),
            'phone' => '09171234567',
            'role' => 'admin',
            'status' => 'active',
            'is_premium' => false,
            'email_verified_at' => now(),
        ]);

        // Create sample customer users
        User::create([
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('Password@123'),
            'phone' => '09181234567',
            'role' => 'customer',
            'status' => 'active',
            'is_premium' => false,
            'email_verified_at' => now(),
        ]);

        User::create([
            'full_name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('Password@123'),
            'phone' => '09191234567',
            'role' => 'customer',
            'status' => 'active',
            'is_premium' => true,
            'email_verified_at' => now(),
        ]);

        // Create technician user
        User::create([
            'full_name' => 'Tech Support',
            'email' => 'tech@nullified.com',
            'password' => Hash::make('Tech@123'),
            'phone' => '09161234567',
            'role' => 'technician',
            'status' => 'active',
            'is_premium' => false,
            'email_verified_at' => now(),
        ]);
    }
}
