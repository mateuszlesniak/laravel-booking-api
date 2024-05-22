<?php

namespace Database\Factories;

use App\Location\Infrastructure\Model\Eloquent\LocationVacancyEntity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Location\Infrastructure\Model\Eloquent\LocationVacancyEntity>
 */
class VacancyFactory extends Factory
{
    protected $model = LocationVacancyEntity::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => fake()->date(),
            'slots' => fake()->randomDigit(),
        ];
    }
}
