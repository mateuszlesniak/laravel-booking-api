<?php

declare(strict_types=1);

namespace App\Common\Application\Provider;

use App\Common\Application\Bus\CommandBus;
use App\Common\Application\Bus\QueryBus;
use App\Common\Application\Bus\SynchronousCommandBus;
use App\Common\Application\Bus\SynchronousQueryBus;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $singletons = [
            CommandBus::class => SynchronousCommandBus::class,
            QueryBus::class => SynchronousQueryBus::class,
        ];

        foreach ($singletons as $abstract => $concrete) {
            $this->app->singleton($abstract, $concrete);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
