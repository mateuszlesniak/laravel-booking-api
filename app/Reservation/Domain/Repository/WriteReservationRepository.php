<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Repository;

use App\Reservation\Domain\Model\Reservation;

interface WriteReservationRepository
{
    public function store(Reservation $reservation): void;
}
