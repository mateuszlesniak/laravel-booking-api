<?php

namespace App\Reservation\Infrastructure\Bus\Query;

use App\Reservation\Application\Repository\ReadReservationRepositoryInterface;
use App\Shared\Application\Bus\Query\QueryHandler;
use App\User\Application\Exception\UserNotFound;
use App\User\Application\Repository\ReadUserRepositoryInterface;

final readonly class SearchUserReservationQueryHandler implements QueryHandler
{
    public function __construct(
        private ReadReservationRepositoryInterface $reservationRepository,
        private ReadUserRepositoryInterface $userRepository,
    )
    {
    }

    public function handle(SearchUserReservationQuery $query): void
    {
        $userDTO = $this->userRepository->findUserById($query->payload->getUserId());

        if (!$userDTO) {
            throw new UserNotFound();
        }

        $query->setReservations(
            $this->reservationRepository->findUserReservations($userDTO)
        );
    }
}
