<?php

namespace App\Reservation\Infrastructure\Bus\Query;

use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\Infrastructure\Http\SearchReservationDTO;
use App\Shared\Application\Bus\Query\Query;

final class SearchUserReservationQuery implements Query
{
    /**
     * @var array|ReservationDTO[]
     */
    private array $reservations = [];

    public function __construct(
        public readonly SearchReservationDTO $payload,
    )
    {
    }

    public function getReservations(): array
    {
        return $this->reservations;
    }

    public function setReservations(array $reservations): SearchUserReservationQuery
    {
        $this->reservations = $reservations;
        return $this;
    }

}
