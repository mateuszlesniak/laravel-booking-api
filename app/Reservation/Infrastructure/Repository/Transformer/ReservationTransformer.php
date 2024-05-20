<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Repository\Transformer;

use App\Location\Infrastructure\Repository\Transformer\LocationTransformer;
use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\Application\DTO\ReservationVacancyDTO;
use App\Reservation\Infrastructure\Model\Reservation;
use App\Reservation\Infrastructure\Model\ReservationVacancy;

final readonly class ReservationTransformer
{
    public function __construct(
        private LocationTransformer $locationTransformer,
    ) {
    }

    public function createReservationDTO(
        Reservation $reservation,
        ?ReservationDTO $reservationDTO = null,
    ): ReservationDTO {
        $reservationDTO = $reservationDTO ?? new ReservationDTO();

        $reservationDTO
            ->setId($reservation->id)
            ->setUser($reservation->user)
            ->setStartDate(new \DateTimeImmutable($reservation->date_in))
            ->setEndDate(new \DateTimeImmutable($reservation->date_out))
            ->setStatus($reservation->status);

        $reservationDTO->setLocationDTO(
            $this->locationTransformer->createLocationDTOFromEntity($reservation->location)
        );

        foreach ($reservation->reservationVacancies() as $reservationVacancy) {
            $reservationDTO->addReservationVacancies(
                $this->createReservationVacancyDTO($reservationVacancy)
            );
        }

        return $reservationDTO;
    }

    public function createReservationVacancyDTO(
        ReservationVacancy $reservationVacancy,
        ?ReservationVacancyDTO $reservationVacancyDTO = null,
    ): ReservationVacancyDTO {
        $reservationVacancyDTO = $reservationVacancyDTO ?? new ReservationVacancyDTO();

        $reservationVacancyDTO->setVacancyDTO(
            $this->locationTransformer->createVacancyDTOFromEntity($reservationVacancy->vacancy)
        );

        return $reservationVacancyDTO;
    }
}
