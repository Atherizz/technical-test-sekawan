<?php

namespace Database\Seeders;

use App\Models\SiteLocation;
use App\Models\SiteLocations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteLocation::insert([
            [
                'location_name' => 'Head Office Jakarta',
                'location_type' => 'head_office',
                'address' => 'Jl. Jendral Sudirman No. 1, Jakarta',
            ],
            [
                'location_name' => 'Branch Office Surabaya',
                'location_type' => 'branch',
                'address' => 'Jl. Ahmad Yani No. 88, Surabaya',
            ],
            [
                'location_name' => 'Mine Site A',
                'location_type' => 'mine',
                'address' => 'Kalimantan Timur',
            ],
            [
                'location_name' => 'Mine Site B',
                'location_type' => 'mine',
                'address' => 'Sulawesi Tenggara',
            ],
            [
                'location_name' => 'Mine Site C',
                'location_type' => 'mine',
                'address' => 'Papua Barat',
            ],
            [
                'location_name' => 'Mine Site D',
                'location_type' => 'mine',
                'address' => 'Maluku Utara',
            ],
            [
                'location_name' => 'Mine Site E',
                'location_type' => 'mine',
                'address' => 'Kalimantan Selatan',
            ],
            [
                'location_name' => 'Mine Site F',
                'location_type' => 'mine',
                'address' => 'Sulawesi Tengah',
            ],
        ]);
    }
}
