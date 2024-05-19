<?php

declare(strict_types=1);

namespace App\Reservation\Application\Repository;

use App\Reservation\Application\DTO\ReservationDTO;

interface WriteReservationRepositoryInterface
{
    public function makeNewReservation(ReservationDTO $reservationDTO): ReservationDTO;
}
