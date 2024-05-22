<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Bus\Query;

use App\Common\Application\Bus\Query\Query;
use App\Reservation\Application\DTO\ReservationData;
use App\Reservation\UI\Controller\Request\SearchReservationRequest;

final class SearchUserReservationQuery implements Query
{
    /**
     * @var array|ReservationData[]
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
