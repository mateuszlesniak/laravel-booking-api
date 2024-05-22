<?php

declare(strict_types=1);

namespace App\Reservation\Application\DTO;

use App\Location\Application\DTO\LocationData;
use App\User\Infrastructure\Model\User;
use Illuminate\Support\Collection;

final readonly class ReservationData
{
    public function __construct(
        public int $id,
        public User $user,
        public \DateTimeInterface $startDate,
        public \DateTimeInterface $endDate,
        public LocationData $locationData,
        public int $persons,
        public Collection $reservationVacancies,
    ) {
    }
}
