<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
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
            'street' => $this->faker->streetName,
            'number' => $this->faker->randomNumber(2),
            'city' => $this->faker->city,
            'country' => 'The Netherlands',
            'postal_code' => $this->faker->postcode,
        ];
    }
}
