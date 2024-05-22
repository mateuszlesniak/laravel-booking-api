<?php

namespace Database\Factories;

use App\Location\Infrastructure\Model\Eloquent\LocationEntity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Location\Infrastructure\Model\Eloquent\LocationEntity>
 */
class LocationFactory extends Factory
{
    protected $model = LocationEntity::class;

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
            'location_code' => strtoupper(fake()->unique()->bothify('???###')),
            'is_active' => fake()->boolean(),
        ];
    }
}
