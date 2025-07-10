<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaintenanceSchedule>
 */
class MaintenanceScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'vehicle_id' => Vehicle::inRandomOrder()->value('id'),
            'maintenance_date' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'description' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['scheduled', 'completed']),
        ];
    }
}
