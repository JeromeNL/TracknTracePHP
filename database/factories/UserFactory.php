<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
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
            'name' => $this->faker->userName,
            'email' => $this->faker->unique()->email,
            'email_verified_at' => now(),
            'password' => bcrypt("welkom"), // password
            'remember_token' => Str::random(10),
            'webshop_id' => $this->faker->numberBetween(1, 10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
