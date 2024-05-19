<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Provider;

use App\Reservation\Application\Repository\WriteReservationRepositoryInterface;
use App\Reservation\Infrastructure\Bus\Command\CreateReservationCommand;
use App\Reservation\Infrastructure\Bus\Command\CreateReservationCommandHandler;
use App\Reservation\Infrastructure\Repository\MySQLWriteReservationRepository;
use App\Shared\Application\Bus\CommandBus;
use App\Shared\Application\Bus\QueryBus;
use Illuminate\Support\ServiceProvider;

class ReservationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(WriteReservationRepositoryInterface::class, MySQLWriteReservationRepository::class);
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
