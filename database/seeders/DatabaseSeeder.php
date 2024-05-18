<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Location::factory()
            ->count(20)
            ->has(
                Room::factory()->count(rand(5, 15))
                    ->sequence(fn (Sequence $sequence) => ['number' => $sequence->index])
            )->create();
    }
}
