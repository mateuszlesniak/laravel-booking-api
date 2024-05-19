<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Bus\Command;

use App\Location\Application\Exception\LocationNotFound;
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
        $locationDTO = $this->locationRepository->findByLocationCode($command->payload->getLocationCode());

        if (!$locationDTO) {
            throw new LocationNotFound($command->payload->getLocationCode());
        }

        $reservationDTO = (new ReservationDTO())
            ->setStartDate($command->payload->getStartDate())
            ->setEndDate($command->payload->getEndDate())
            ->setLocationDTO($locationDTO)
            ->setPersons($command->payload->getPersons());

        $this->reservationService->validateReservationDetails($reservationDTO);

        $this->reservationService->createReservation($reservationDTO);
    }
}
