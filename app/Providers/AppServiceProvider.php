<?php

namespace App\Providers;

use App\Booking\Command\CreateReservationCommand;
use App\Booking\Command\CreateReservationCommandHandler;
use App\Bus\CommandBus;
use App\Bus\IlluminateCommandBus;
use App\Bus\IlluminateQueryBus;
use App\Bus\QueryBus;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $singletons = [
            CommandBus::class => IlluminateCommandBus::class,
            QueryBus::class => IlluminateQueryBus::class,
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
        $this->registerCommands();
        $this->registerQueries();
    }

    private function registerCommands(): void
    {
        /** @var CommandBus $commandBus */
        $commandBus = app(CommandBus::class);

        $commandBus->register([
            CreateReservationCommand::class => CreateReservationCommandHandler::class,
        ]);
    }

    private function registerQueries(): void
    {
        /** @var QueryBus $queryBus */
        $queryBus = app(QueryBus::class);

        $queryBus->register([
            
        ]);
    }
}
