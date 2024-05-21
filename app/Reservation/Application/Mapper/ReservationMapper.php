<?php

declare(strict_types=1);

namespace App\Reservation\Application\Mapper;

use App\Location\Application\Mapper\LocationMapper;
use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\Infrastructure\Model\Reservation;

final readonly class ReservationMapper
{
    public function __construct(
        private LocationMapper $locationTransformer,
        private ReservationVacancyTransformer $reservationVacancyTransformer,
    ) {
    }

    public function fromEntity(Reservation $reservation): ReservationDTO
    {
        $reservationDTO = (new ReservationDTO())
            ->setId($reservation->id)
            ->setUser($reservation->user)
            ->setStartDate(new \DateTimeImmutable($reservation->date_in))
            ->setEndDate(new \DateTimeImmutable($reservation->date_out))
            ->setStatus($reservation->status);

        $reservationDTO->setLocationDTO(
            $this->locationTransformer->fromEntity($reservation->location)
        );

        foreach ($reservation->reservationVacancies() as $reservationVacancy) {
            $reservationDTO->addReservationVacancies(
                $this->reservationVacancyTransformer->fromEntity($reservationVacancy)
            );
        }

        return $reservationDTO;
    }
}
