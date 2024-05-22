<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Model\Entity;

use App\Common\Domain\Entity;
use App\Reservation\Domain\Model\ValueObject\Date;

class ReservationVacancy extends Entity
{
    public function __construct(
        public readonly int $vacancyId,
        public readonly Date $date,
        public readonly int $persons,
        public readonly ?int $reservationId = null,
    ) {
    }

    #[\Override]
    public function toArray(): array
    {
        return [
            'reservationId' => $this->reservationId,
            'vacancyId' => $this->vacancyId,
            'date' => $this->date,
            'persons' => $this->persons,
        ];
    }
}
