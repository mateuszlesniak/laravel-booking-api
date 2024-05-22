<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Model;

use App\Common\Domain\AggregateRoot;
use App\Reservation\Domain\Model\ValueObject\DateIn;
use App\Reservation\Domain\Model\ValueObject\DateOut;
use App\Reservation\Domain\Model\ValueObject\Location;
use App\Reservation\Domain\Model\ValueObject\ReservationVacancies;
use App\Reservation\Domain\Model\ValueObject\User;

class Reservation extends AggregateRoot
{
    public function __construct(
        public readonly ?int $id,
        public readonly User $user,
        public readonly Location $location,
        public readonly DateIn $dateIn,
        public readonly DateOut $dateOut,
        public readonly int $persons,
        public readonly ReservationVacancies $reservationVacancies,
    ) {
    }

    #[\Override]
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user->value,
            'location_id' => $this->location->value,
            'date_in' => $this->dateIn->value,
            'date_out' => $this->dateOut->value,
            'persons' => $this->persons,
        ];
    }
}
