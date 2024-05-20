<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Repository\Transformer;

use App\Location\Infrastructure\Repository\Transformer\VacancyTransformer;
use App\Reservation\Application\DTO\ReservationVacancyDTO;
use App\Reservation\Infrastructure\Model\ReservationVacancy;

final readonly class ReservationVacancyTransformer
{
    public function __construct(
        private VacancyTransformer $vacancyTransformer,
    ) {
    }

    public function createReservationVacancyDTO(
        ReservationVacancy $reservationVacancy,
        ?ReservationVacancyDTO $reservationVacancyDTO = null,
    ): ReservationVacancyDTO {
        $reservationVacancyDTO = $reservationVacancyDTO ?? new ReservationVacancyDTO();

        $reservationVacancyDTO->setVacancyDTO(
            $this->vacancyTransformer->createVacancyDTO($reservationVacancy->vacancy)
        );

        return $reservationVacancyDTO;
    }
}
