<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Repository;

use App\Reservation\Application\DTO\ReservationDTO;

interface WriteReservationRepository
{
    public function makeNewReservation(ReservationDTO $reservationDTO): ReservationDTO;
}
