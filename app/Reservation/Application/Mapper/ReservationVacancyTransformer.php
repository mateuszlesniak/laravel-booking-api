<?php

declare(strict_types=1);

namespace App\Reservation\Application\Mapper;

use App\Location\Application\Mapper\VacancyMapper;
use App\Reservation\Application\DTO\ReservationVacancyDTO;
use App\Reservation\Infrastructure\Model\ReservationVacancy;

final readonly class ReservationVacancyTransformer
{
    public function __construct(
        private VacancyMapper $vacancyTransformer,
    ) {
    }

    public function fromEntity(ReservationVacancy $reservationVacancy): ReservationVacancyDTO
    {
        return (new ReservationVacancyDTO())
            ->setVacancyDTO($this->vacancyTransformer->fromEntity($reservationVacancy->vacancy));
    }
}
