<?php

declare(strict_types=1);

namespace App\Reservation\Application\Service;

use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\Domain\Repository\WriteReservationRepository;

final readonly class ReservationService
{
    public function __construct(
        private WriteReservationRepository $writeReservationRepository,
    ) {
    }

    public function canReservationBePlaced(ReservationDTO $reservationDTO): bool
    {
    }

    public function createReservation(ReservationDTO $reservationDTO): void
    {
        $this->writeReservationRepository->makeNewReservation($reservationDTO);
    }
}
