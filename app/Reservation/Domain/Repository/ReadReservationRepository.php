<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Repository;

use Illuminate\Support\Collection;

interface ReadReservationRepository
{
    public function restrictDates(\DateTimeInterface $dateFrom, \DateTimeInterface $dateTo): self;

    public function findAll(): Collection;
}
