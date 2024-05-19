<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' =>
                sprintf('%s %s',
                    fake()->company(),
                    fake()->country(),
                ),
            'address' => fake()->address(),
            'country' => fake()->countryCode(),
            'location_code' => strtoupper(fake()->unique()->bothify('???###'))
        ];
    }
}
