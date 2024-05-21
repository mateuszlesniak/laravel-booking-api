<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Bus\Query;

use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\UI\Controller\Request\SearchReservationRequest;
use App\Shared\Application\Bus\Query\Query;

final class SearchUserReservationQuery implements Query
{
    /**
     * @var array|ReservationDTO[]
     */
    private array $reservations = [];

    public function __construct(
        public readonly SearchReservationRequest $request,
    ) {
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
