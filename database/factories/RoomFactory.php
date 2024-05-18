<?php

namespace Database\Factories;

use App\Booking\RoomStatus;
use App\Booking\RoomType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'number' => fake()->randomNumber(),
            'status' => fake()->randomElement(RoomStatus::cases()),
            'type' => fake()->randomElement(RoomType::cases()),
            'smoke' => fake()->boolean(),
        ];
    }
}
