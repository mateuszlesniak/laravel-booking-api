<?php

declare(strict_types=1);

namespace App\Reservation\Application\Provider;

use App\Common\Application\Bus\CommandBus;
use App\Common\Application\Bus\QueryBus;
use App\Reservation\Application\Service\ReservationService;
use App\Reservation\Application\UseCase\Command\StoreReservationCommand;
use App\Reservation\Application\UseCase\Command\StoreReservationCommandHandler;
use App\Reservation\Application\UseCase\Query\FindAllUserReservationsQuery;
use App\Reservation\Application\UseCase\Query\FindAllUserReservationsQueryHandler;
use App\Reservation\Domain\Validation\ReservationValidationStrategy;
use App\Reservation\Domain\Validation\ValidateLocation;
use App\Reservation\Domain\Validation\ValidateLocationVacancies;
use App\Reservation\Infrastructure\Repository\MySQL\ReadReservationRepository;
use App\Reservation\Infrastructure\Repository\MySQL\WriteReservationRepository;
use Illuminate\Support\ServiceProvider;

class ReservationServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerRepositories();
        $this->registerValidationStrategy();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->bootCommands();
        $this->bootQueries();
    }

    private function bootCommands(): void
    {
        /** @var CommandBus $commandBus */
        $commandBus = app(CommandBus::class);

        $commandBus->register([
            StoreReservationCommand::class => StoreReservationCommandHandler::class,
        ]);
    }

    private function bootQueries(): void
    {
        /** @var QueryBus $queryBus */
        $queryBus = app(QueryBus::class);

        $queryBus->register([
            FindAllUserReservationsQuery::class => FindAllUserReservationsQueryHandler::class,
        ]);
    }

    private function registerRepositories(): void
    {
        $bindings = [
            \App\Reservation\Domain\Repository\WriteReservationRepository::class => WriteReservationRepository::class,
            \App\Reservation\Domain\Repository\ReadReservationRepository::class => ReadReservationRepository::class,
        ];

        foreach ($bindings as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    private function registerValidationStrategy(): void
    {
        $this->app->when(ReservationService::class)
            ->needs(ReservationValidationStrategy::class)
            ->give([
                ValidateLocation::class,
                ValidateLocationVacancies::class,
            ], );
    }
}
