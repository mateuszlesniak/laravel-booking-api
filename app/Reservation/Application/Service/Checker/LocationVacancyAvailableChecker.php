<?php

declare(strict_types=1);

namespace App\Reservation\Application\Service\Checker;

use App\Reservation\Application\DTO\ReservationDTO;

final class LocationVacancyAvailableChecker implements ReservationChecker
{
    #[\Override]
    public function __invoke(ReservationDTO $reservationDTO): void
    {
        foreach ($reservationDTO->getLocationDTO()->getVacancies() as $locationVacancy) {

        }
    }
}
