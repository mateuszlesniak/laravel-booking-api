<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Model;

use App\Common\Domain\AggregateRoot;
use App\Reservation\Domain\Exception\IncorrectDateRange;
use App\Reservation\Domain\Exception\NotSelectedPersons;
use App\Reservation\Domain\Model\ValueObject\DateIn;
use App\Reservation\Domain\Model\ValueObject\DateOut;
use App\Reservation\Domain\Model\ValueObject\Location;
use App\Reservation\Domain\Model\ValueObject\ReservationVacancies;
use App\Reservation\Domain\Model\ValueObject\User;

class Reservation extends AggregateRoot
{
    public readonly int $persons;

    public function __construct(
        public readonly ?int $id,
        public readonly User $user,
        public readonly Location $location,
        public readonly DateIn $dateIn,
        public readonly DateOut $dateOut,
        int $persons,
        public readonly ReservationVacancies $reservationVacancies,
    ) {
        if ($persons < 1) {
            throw new NotSelectedPersons();
        }

        if ($this->dateOut->toDate()->lt($this->dateIn->toDate())) {
            throw new IncorrectDateRange();
        }

        $this->persons = $persons;
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
