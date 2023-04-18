<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Package>
 */
class PackageFactory extends Factory
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
            'description' => $this->faker->paragraph,
            'weight' => $this->faker->numberBetween(1, 100),
            'customer_id' => $this->faker->numberBetween(1, 10),
            'webshop_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
