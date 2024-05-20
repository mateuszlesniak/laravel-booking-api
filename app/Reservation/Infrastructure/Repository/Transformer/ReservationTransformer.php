<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Repository\Transformer;

use App\Location\Infrastructure\Repository\Transformer\LocationTransformer;
use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\Infrastructure\Model\Reservation;

final readonly class ReservationTransformer
{
    public function __construct(
        private LocationTransformer $locationTransformer,
        private ReservationVacancyTransformer $reservationVacancyTransformer,
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
            $this->locationTransformer->createLocationDTO($reservation->location)
        );

        foreach ($reservation->reservationVacancies() as $reservationVacancy) {
            $reservationDTO->addReservationVacancies(
                $this->reservationVacancyTransformer->createReservationVacancyDTO($reservationVacancy)
            );
        }

        return $reservationDTO;
    }
}
