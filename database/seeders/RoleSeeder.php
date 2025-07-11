<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Role::insert([
            ['role_name' => 'admin'],
            ['role_name' => 'supervisor'],
            ['role_name' => 'manager'],
            ['role_name' => 'employee'],
        ]);
    }
}
