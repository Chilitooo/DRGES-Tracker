<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::firstOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@carsu.edu.ph')],
            [
                'name' => env('ADMIN_NAME', 'Admin User'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'password')),
                'role' => 'admin',
                'status' => 'active',
            ]);

    }
}
