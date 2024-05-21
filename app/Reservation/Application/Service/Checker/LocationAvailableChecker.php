<?php

declare(strict_types=1);

namespace App\Reservation\Application\Service\Checker;

use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\Domain\Exception\LocationNotAvailable;

final class LocationAvailableChecker implements ReservationChecker
{
    #[\Override]
    public function __invoke(ReservationDTO $reservationDTO): void
    {
        if (!$reservationDTO->getLocationDTO()->isActive()) {
            throw new LocationNotAvailable();
        }
    }
}
