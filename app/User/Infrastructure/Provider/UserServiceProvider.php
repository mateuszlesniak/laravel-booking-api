<?php

namespace App\User\Infrastructure\Provider;

use App\User\Application\Repository\ReadUserRepositoryInterface;
use App\User\Infrastructure\Repository\MySQLReadUserRepository;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $bindings = [
            ReadUserRepositoryInterface::class => MySQLReadUserRepository::class,
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
