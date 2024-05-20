<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Repository;

use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\Application\Repository\ReadReservationRepositoryInterface;
use App\Reservation\Infrastructure\Model\Reservation;
use App\Reservation\Infrastructure\Repository\Transformer\ReservationTransformer;
use App\User\Application\DTO\UserDTO;

final class MySQLReadReservationRepository implements ReadReservationRepositoryInterface
{
    public function __construct(
        private readonly ReservationTransformer $transformer,
    ) {
    }

    /**
     * @return array|ReservationDTO[]
     */
    #[\Override]
    public function findUserReservations(UserDTO $user): array
    {
        $reservations = [];
        foreach (Reservation::whereUserId($user->getId())->get() as $reservation) {
            $reservations[] = $this->transformer->createReservationDTO($reservation);
        }

        return $reservations;
    }
}
