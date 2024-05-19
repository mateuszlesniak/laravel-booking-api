<?php

declare(strict_types=1);

namespace App\Booking\Command;

use App\Application\Bus\CommandHandler;
use App\Booking\ReadLocationRepositoryInterface;
use App\Booking\ReservationDTO;
use App\Booking\ReservationService;

final readonly class CreateReservationCommandHandler implements CommandHandler
{
    public function __construct(
        private ReservationService $reservationService,
        private ReadLocationRepositoryInterface $locationRepository,
    ) {
    }

    public function handle(CreateReservationCommand $command): void
    {
        $location = $this->locationRepository->findByLocationCode($command->payload->getLocationCode());

        if (!$location) {
            // exception
        }

        $reservationDTO = new ReservationDTO(
            $command->payload->getStartDate(),
            $command->payload->getEndDate(),
            $location,
            $command->payload->getPersons(),
        );

        $this->reservationService->validateReservationDetails($reservationDTO);

        $this->reservationService->createReservation($reservationDTO);
    }
}
