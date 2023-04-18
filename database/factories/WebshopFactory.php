<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Webshop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Webshop>
 */
class WebshopFactory extends Factory
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
            'name' => $this->faker->company,
            'address_id' => Address::factory(),
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'website' => $this->faker->url,
        ];
    }
}
