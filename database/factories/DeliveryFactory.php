<?php

namespace Database\Factories;

use App\Models\Delivery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Delivery>
 */
class DeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker = \Faker\Factory::create('nl_NL');
        return [
            'track_and_trace_code' => $this->faker->uuid,
            'expected_delivery_date' => $this->faker->dateTimeBetween('now', '+1 week'),
            'actual_delivery_date' => $this->faker->dateTimeBetween('now', '+1 week'),
            'package_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}
