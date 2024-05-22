<?php

declare(strict_types=1);

namespace App\Reservation\Application\UseCase\Query;

use App\Common\Application\Bus\Query\Query;
use App\Reservation\UI\Controller\Request\FindUserReservationsRequest;
use Illuminate\Support\Collection;

final class FindAllUserReservationsQuery implements Query
{
    private Collection $reservations;

    public function __construct(
        public readonly FindUserReservationsRequest $request
    ) {
    }

    public function setReservations(Collection $reservations): void
    {
        $this->reservations = $reservations;
    }

    public function toArray(): array
    {
        return $this->reservations->toArray();
    }
}
