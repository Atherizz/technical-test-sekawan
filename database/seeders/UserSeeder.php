<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(),
                'role_id' => 1,
                'site_location_id' => 1,
            ],
            [
                'name' => 'Supervisor User',
                'email' => 'supervisor@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role_id' => 2,
                'site_location_id' => 1,
            ],
            [
                'name' => 'Manager User',
                'email' => 'manager@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role_id' => 3,
                'site_location_id' => 1,
            ],
            [
                'name' => 'Employee User',
                'email' => 'employee@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role_id' => 4,
                'site_location_id' => 1,
            ],
        ]);
    }
}
