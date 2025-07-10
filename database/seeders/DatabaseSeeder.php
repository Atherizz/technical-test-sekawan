<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\MaintenanceSchedule;
use App\Models\RentalVendor;
use App\Models\Role;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleBooking;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(
            [
            RoleSeeder::class,
            SiteLocationSeeder::class,
            UserSeeder::class,
            RentalVendorSeeder::class
            ]
    );

        Driver::factory(5)->create();
        Vehicle::factory(20)->create();
        MaintenanceSchedule::factory(10)->create();
        VehicleBooking::factory(10)->create();

    }
}
