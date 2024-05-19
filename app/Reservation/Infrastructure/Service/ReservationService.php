<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Service;

use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\Application\Repository\WriteReservationRepositoryInterface;

final readonly class ReservationService
{
    public function __construct(
        private WriteReservationRepositoryInterface $writeReservationRepository,
    ) {
    }

    public function validateReservationDetails(ReservationDTO $reservationDTO): void
    {
        return;
    }

    public function createReservation(ReservationDTO $reservationDTO): void
    {
        $this->writeReservationRepository->makeNewReservation($reservationDTO);
    }
}
