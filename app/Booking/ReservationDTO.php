<?php

namespace App\Booking;

use App\Models\Location;
use DateTimeImmutable;

final readonly class ReservationDTO
{
    public function __construct(
        public DateTimeImmutable $startDate,
        public DateTimeImmutable $endDate,
        public Location $location,
        public int $persons,
    )
    {
    }
}
