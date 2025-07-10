<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VehicleBooking>
 */
class VehicleBookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
public function definition(): array
{
    $status = $this->faker->randomElement(['pending', 'approved_1', 'approved_2']);

    $departure = $this->faker->dateTimeBetween('now', '+3 days');

    return [
        'user_id'       => null,
        'vehicle_id'    => Vehicle::inRandomOrder()->value('id'),
        'departure_time'=> $departure,
        'purpose'       => $this->faker->sentence(),
        'driver_id'     => Driver::inRandomOrder()->value('id'),
        'status'        => $status,
    ];
}

}
