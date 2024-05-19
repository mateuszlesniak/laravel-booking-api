<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Bus\Command;

use App\Location\Application\Repository\ReadLocationRepositoryInterface;
use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\Infrastructure\Service\ReservationService;
use App\Shared\Application\Bus\Command\CommandHandler;

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
