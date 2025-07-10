<?php

namespace Database\Factories;

use App\Models\RentalVendor;
use App\Models\SiteLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'license_plate' => strtoupper($this->faker->unique()->bothify('B #### ??')),
            'brand' => $this->faker->randomElement(['Toyota', 'Mitsubishi', 'Isuzu', 'Suzuki']),
            'vehicle_type' => $this->faker->randomElement(['passenger', 'cargo']),
            'site_location_id' => SiteLocation::inRandomOrder()->value('id'),
            'ownership_status' => $this->faker->randomElement(['company owned', 'rented']),
            'rental_vendor_id' => RentalVendor::inRandomOrder()->value('id'),
            'operational_status' => $this->faker->randomElement(['active', 'in_service', 'inactive']),
        ];
    }
}
