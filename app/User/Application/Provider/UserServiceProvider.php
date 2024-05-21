<?php

declare(strict_types=1);

namespace App\User\Application\Provider;

use App\User\Infrastructure\Repository\MySQL\ReadUserRepository;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $bindings = [
            \App\User\Domain\Repository\ReadUserRepository::class => ReadUserRepository::class,
        ];

        foreach ($bindings as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
