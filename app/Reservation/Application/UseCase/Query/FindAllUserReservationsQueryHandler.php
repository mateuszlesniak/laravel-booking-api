<?php

declare(strict_types=1);

namespace App\Reservation\Application\UseCase\Query;

use App\Common\Application\Bus\Query\QueryHandler;
use App\Common\Domain\ValueObject\Date;
use App\Location\Domain\Model\ValueObject\LocationCode;
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

        $reservations = $this->reservationRepository->filterUser($user);

        if ($query->request->validated('start_date')) {
            $reservations->filterDateFrom(new Date($query->request->validated('start_date')));
        }

        if ($query->request->validated('end_date')) {
            $reservations->filterDateTo(new Date($query->request->validated('end_date')));
        }

        if ($query->request->validated('location_code')) {
            $reservations->filterLocationCode(new LocationCode($query->request->validated('location_code')));
        }

        $query->setReservations($reservations->findAll());
    }
}
