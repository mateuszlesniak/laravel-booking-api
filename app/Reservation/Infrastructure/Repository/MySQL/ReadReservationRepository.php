<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Repository\MySQL;

use App\Reservation\Application\Mapper\ReservationMapper;
use App\Reservation\Domain\Repository\ReadReservationRepository as ReadReservationRepositoryInterface;
use App\Reservation\Infrastructure\Model\Eloquent\ReservationEntity;
use Illuminate\Support\Collection;

final class ReadReservationRepository implements ReadReservationRepositoryInterface
{
    private ?\DateTimeInterface $restrictedDateFrom = null;
    private ?\DateTimeInterface $restrictedDateTo = null;

    public function __construct(
        private readonly ReservationMapper $reservationMapper,
    ) {
    }

    public function restrictDates(
        \DateTimeInterface $dateFrom,
        \DateTimeInterface $dateTo,
    ): self {
        $this->restrictedDateFrom = $dateFrom;
        $this->restrictedDateTo = $dateTo;

        return $this;
    }

    #[\Override]
    public function findAll(): Collection
    {
        $query = ReservationEntity::query();

        if ($this->restrictedDateTo) {
            $query->where('date_in', '<=', $this->restrictedDateTo->format('Y-m-d'));
        }

        if ($this->restrictedDateFrom) {
            $query->where('date_out', '>=', $this->restrictedDateFrom->format('Y-m-d'));
        }

        return $query->get()
            ->map(function (ReservationEntity $reservationEntity) {
                return $this->reservationMapper->fromEloquent(
                    $reservationEntity,
                    $this->restrictedDateFrom,
                    $this->restrictedDateTo
                );
            });
    }
}
