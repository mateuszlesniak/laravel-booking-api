<?php

declare(strict_types=1);

namespace App\Reservation\Application\Service;

use App\Reservation\Domain\Model\Reservation;
use App\Reservation\Domain\Validation\ReservationValidationStrategy;

final readonly class ReservationService
{
    /**
     * @var array|ReservationValidationStrategy[]
     */
    private array $reservationValidationStrategy;

    public function __construct(
        ReservationValidationStrategy ...$reservationValidationStrategy,
    ) {
        $this->reservationValidationStrategy = $reservationValidationStrategy;
    }

    public function validateReservation(Reservation $reservation): void
    {
        foreach ($this->reservationValidationStrategy as $reservationStrategy) {
            $reservationStrategy->validate($reservation);
        }
    }
}
