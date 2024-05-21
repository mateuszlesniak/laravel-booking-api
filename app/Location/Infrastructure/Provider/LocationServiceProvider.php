<?php

declare(strict_types=1);

namespace App\Location\Infrastructure\Provider;

use App\Location\Infrastructure\Repository\MySQL\ReadLocationRepository;
use App\Location\Infrastructure\Repository\MySQL\ReadLocationVacancyRepository;
use Illuminate\Support\ServiceProvider;

class LocationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $bindings = [
            \App\Location\Domain\Repository\ReadLocationRepository::class => ReadLocationRepository::class,
            \App\Location\Domain\Repository\ReadLocationVacancyRepository::class => ReadLocationVacancyRepository::class,
        ];

        foreach ($bindings as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }
}
