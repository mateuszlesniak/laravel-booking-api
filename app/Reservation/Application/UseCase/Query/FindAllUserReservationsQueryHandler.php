<?php

declare(strict_types=1);

namespace App\Reservation\Application\UseCase\Query;

use App\Common\Application\Bus\Query\QueryHandler;
use App\Reservation\Domain\Policy\ReservationPolicy;
use App\Reservation\Domain\Repository\ReadReservationRepository;
use App\User\Domain\Repository\ReadUserRepository;

final readonly class FindAllUserReservationsQueryHandler implements QueryHandler
{
    public function __construct(
        private ReadReservationRepository $reservationRepository,
        private ReadUserRepository $userRepository,
    ) {
    }

    public function handle(FindAllUserReservationsQuery $query): void
    {
        authorize('findAll', ReservationPolicy::class);
        $user = $this->userRepository->findById(1);

        $query->setReservations(
            $this->reservationRepository->findAll($user),
        );
    }
}
