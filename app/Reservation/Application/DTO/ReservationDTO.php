<?php

declare(strict_types=1);

namespace App\Reservation\Application\DTO;

use App\Location\Infrastructure\Model\Location;

final readonly class ReservationDTO
{
    public function __construct(
        public \DateTimeImmutable $startDate,
        public \DateTimeImmutable $endDate,
        public Location $location,
        public int $persons,
    ) {
    }
}
