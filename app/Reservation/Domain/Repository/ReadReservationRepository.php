<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Repository;

use App\Reservation\Application\DTO\ReservationDTO;
use App\User\Application\DTO\UserDTO;

interface ReadReservationRepository
{
    /**
     * @return array|ReservationDTO[]
     */
    public function findUserReservations(UserDTO $user): array;
}
