<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Bus\Query;

use App\Reservation\Domain\Repository\ReadReservationRepository;
use App\Shared\Application\Bus\Query\QueryHandler;
use App\User\Application\Exception\UserNotFound;
use App\User\Domain\Repository\ReadUserRepository;

final readonly class SearchUserReservationQueryHandler implements QueryHandler
{
    public function __construct(
        private ReadReservationRepository $reservationRepository,
        private ReadUserRepository $userRepository,
    ) {
    }

    public function handle(SearchUserReservationQuery $query): void
    {
        $userDTO = $this->userRepository->findUserById($query->request->integer('user_id'));

        if (!$userDTO) {
            throw new UserNotFound();
        }

        $query->setReservations(
            $this->reservationRepository->findUserReservations($userDTO)
        );
    }
}
