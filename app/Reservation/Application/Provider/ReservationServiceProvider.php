<?php

declare(strict_types=1);

namespace App\Reservation\Application\Provider;

use App\Reservation\Infrastructure\Bus\Command\CreateReservationCommand;
use App\Reservation\Infrastructure\Bus\Command\CreateReservationCommandHandler;
use App\Reservation\Infrastructure\Bus\Query\SearchUserReservationQuery;
use App\Reservation\Infrastructure\Bus\Query\SearchUserReservationQueryHandler;
use App\Reservation\Infrastructure\Repository\MySQL\ReadReservationRepository;
use App\Reservation\Infrastructure\Repository\MySQL\WriteReservationRepository;
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
        $bindings = [
            \App\Reservation\Domain\Repository\WriteReservationRepository::class => WriteReservationRepository::class,
            \App\Reservation\Domain\Repository\ReadReservationRepository::class => ReadReservationRepository::class,
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
            SearchUserReservationQuery::class => SearchUserReservationQueryHandler::class,
        ]);
    }
}
