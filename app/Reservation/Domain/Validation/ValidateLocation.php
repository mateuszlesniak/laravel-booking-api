<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Validation;

use App\Location\Domain\Repository\ReadLocationRepository;
use App\Reservation\Domain\Exception\LocationNotAvailable;
use App\Reservation\Domain\Exception\LocationNotFound;
use App\Reservation\Domain\Model\Reservation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

readonly class ValidateLocation implements ReservationValidationStrategy
{
    public function __construct(
        private ReadLocationRepository $locationRepository,
    ) {
    }

    #[\Override]
    public function validate(Reservation $reservation): void
    {
        try {
            $locationWithVacancies = $this->locationRepository
                ->findByLocationCode($reservation->locationCode);
        } catch (ModelNotFoundException) {
            throw new LocationNotFound((string) $reservation->locationCode);
        }

        if (!$locationWithVacancies->isActive) {
            throw new LocationNotAvailable();
        }
    }
}
