<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Service;

use App\Reservation\Application\DTO\ReservationDTO;

final class ReservationService
{
    public function validateReservationDetails(ReservationDTO $reservationDTO): void
    {
        throw new \Exception();
    }

    public function createReservation(ReservationDTO $reservationDTO): void
    {
    }
}
