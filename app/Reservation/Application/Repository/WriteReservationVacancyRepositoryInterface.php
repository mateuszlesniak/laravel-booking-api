<?php

declare(strict_types=1);

namespace App\Reservation\Application\Repository;

use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\Infrastructure\Model\Reservation;

interface WriteReservationVacancyRepositoryInterface
{
    public function createReservationVacancies(
        ReservationDTO $reservationDTO,
        Reservation $reservation,
    ): ReservationDTO;
}
