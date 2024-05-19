<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Providers;

use App\Location\Application\Repository\ReadLocationRepositoryInterface;
use App\Location\Infrastructure\Repository\MySQLReadLocationRepository;
use App\Reservation\Infrastructure\Bus\Command\CreateReservationCommand;
use App\Reservation\Infrastructure\Bus\Command\CreateReservationCommandHandler;
use App\Shared\Application\Bus\CommandBus;
use App\Shared\Application\Bus\QueryBus;
use App\Shared\Infrastructure\Bus\SynchronousQueryBus;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $singletons = [
            CommandBus::class => CommandBus::class,
            QueryBus::class => SynchronousQueryBus::class,
        ];

        foreach ($singletons as $abstract => $concrete) {
            $this->app->singleton($abstract, $concrete);
        }

        $this->app->bind(ReadLocationRepositoryInterface::class, MySQLReadLocationRepository::class);
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
