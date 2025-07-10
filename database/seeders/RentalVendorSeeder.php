<?php

namespace Database\Seeders;

use App\Models\RentalVendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalVendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RentalVendor::insert([
            [          
                'vendor_name' => 'PT Sewa Mobil Amanah',
                'contact' => '081234567890',
                'address' => 'Jl. Merdeka No. 10, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vendor_name' => 'CV Rentalin Aja',
                'contact' => '085678912345',
                'address' => 'Jl. Veteran No. 123, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'vendor_name' => 'Sewa Mobil Cepat',
                'contact' => '082112345678',
                'address' => 'Jl. Slamet Riyadi No. 77, Malang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
