<?php

declare(strict_types=1);

namespace App\Reservation\Application\Service;

use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\Application\Service\Checker\LocationAvailableChecker;
use App\Reservation\Application\Service\Checker\LocationVacancyAvailableChecker;
use App\Reservation\Domain\Repository\WriteReservationRepository;
use Illuminate\Support\Facades\Pipeline;

final readonly class ReservationService
{
    public function __construct(
        private WriteReservationRepository $writeReservationRepository,
    )
    {
    }

    public function checkIfReservationBePlaced(ReservationDTO $reservationDTO): void
    {
        Pipeline::send($reservationDTO)
            ->through([
                LocationVacancyAvailableChecker::class,
                LocationAvailableChecker::class,
            ])->thenReturn();
    }

    public function createReservation(ReservationDTO $reservationDTO): void
    {
        $this->writeReservationRepository->makeNewReservation($reservationDTO);
    }
}
