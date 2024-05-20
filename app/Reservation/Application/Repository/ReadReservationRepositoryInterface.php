<?php

declare(strict_types=1);

namespace App\Reservation\Application\Repository;

use App\Reservation\Application\DTO\ReservationDTO;
use App\User\Application\DTO\UserDTO;

interface ReadReservationRepositoryInterface
{
    /**
     * @param UserDTO $user
     * @return array|ReservationDTO[]
     */
    public function findUserReservations(UserDTO $user): array;
}
