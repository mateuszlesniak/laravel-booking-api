<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\User;
use App\Models\Vacancy;
use DateTimeImmutable;
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

        $date = new DateTimeImmutable();

        Location::factory()
            ->count(20)
            ->has(
                Vacancy::factory()->count(rand(15, 100))
                    ->sequence(function (Sequence $sequence) use (&$date) {
                        $date = $date->modify('+1 day');
                        return ['date' => $date->format('Y-m-d')];
                    })
                    ->afterCreating(function () use (&$date) {
                        $date = new DateTimeImmutable();
                    })
            )
            ->create();
    }
}
