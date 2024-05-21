<?php

declare(strict_types=1);

namespace App\Reservation\Application\Service\Checker;

use App\Reservation\Application\DTO\ReservationDTO;

interface ReservationChecker
{
    public function __invoke(ReservationDTO $reservationDTO): void;
}
