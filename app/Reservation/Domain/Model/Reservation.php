<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Model;

use App\Common\Domain\AggregateRoot;
use App\Location\Domain\Model\ValueObject\LocationCode;
use App\Reservation\Domain\Exception\IncorrectDateRange;
use App\Reservation\Domain\Exception\NotSelectedPersons;
use App\Reservation\Domain\Model\ValueObject\DateIn;
use App\Reservation\Domain\Model\ValueObject\DateOut;
use App\Reservation\Domain\Model\ValueObject\ReservationVacancies;
use App\User\Domain\Model\User;

class Reservation extends AggregateRoot
{
    public readonly int $persons;

    public function __construct(
        public readonly ?int $id,
        public readonly User $user,
        public readonly LocationCode $locationCode,
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
            'user_id' => $this->user->id,
            'location_id' => $this->locationCode,
            'date_in' => $this->dateIn,
            'date_out' => $this->dateOut,
            'persons' => $this->persons,
        ];
    }
}
