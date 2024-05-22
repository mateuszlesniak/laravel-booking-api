<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Validation;

use App\Location\Domain\Repository\ReadLocationRepository;
use App\Reservation\Domain\Exception\LocationNotAvailable;
use App\Reservation\Domain\Model\Reservation;

readonly class ValidateLocation implements ReservationValidationStrategy
{
    public function __construct(
        private ReadLocationRepository $locationRepository,
    ) {
    }

    #[\Override]
    public function validate(Reservation $reservation): void
    {
        $locationWithVacancies = $this->locationRepository
            ->findByLocationCode($reservation->location->value);

        if (!$locationWithVacancies->isActive) {
            throw new LocationNotAvailable();
        }
    }
}
