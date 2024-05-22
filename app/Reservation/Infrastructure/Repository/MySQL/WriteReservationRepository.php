<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Repository\MySQL;

use App\Reservation\Application\DTO\ReservationStatus;
use App\Reservation\Application\Mapper\ReservationMapper;
use App\Reservation\Application\Mapper\ReservationVacancyMapper;
use App\Reservation\Domain\Model\Reservation;
use App\Reservation\Domain\Repository\WriteReservationRepository as WriteReservationRepositoryInterface;
use Illuminate\Support\Facades\DB;

final readonly class WriteReservationRepository implements WriteReservationRepositoryInterface
{
    public function __construct(
        private ReservationMapper $reservationMapper,
        private ReservationVacancyMapper $reservationVacancyMapper,
    ) {
    }

    #[\Override]
    public function store(Reservation $reservation): void
    {
        DB::transaction(function () use ($reservation) {
            $reservationEntity = $this->reservationMapper->toEloquent($reservation);
            $reservationEntity->status = ReservationStatus::PLACED;
            $reservationEntity->save();

            foreach ($reservation->reservationVacancies as $reservationVacancy) {
                $reservationVacancyEntity = $this->reservationVacancyMapper->toEloquent($reservationVacancy);
                $reservationVacancyEntity->reservation_id = $reservationEntity->id;
                $reservationVacancyEntity->save();
            }
        });
    }
}
