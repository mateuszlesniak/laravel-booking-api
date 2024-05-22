<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Validation;

use App\Reservation\Domain\Model\Reservation;

interface ReservationValidationStrategy
{
    public function validate(Reservation $reservation): void;
}
