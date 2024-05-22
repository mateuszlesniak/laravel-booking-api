<?php

declare(strict_types=1);

namespace App\Reservation\Application\UseCase\Query;

use App\Common\Application\Bus\Query\Query;
use Illuminate\Support\Collection;

final class FindAllUserReservationsQuery implements Query, \JsonSerializable
{
    private Collection $reservations;

    public function setReservations(Collection $reservations): void
    {
        $this->reservations = $reservations;
    }

    #[\Override]
    public function jsonSerialize(): mixed
    {
        return $this->reservations;
    }
}
