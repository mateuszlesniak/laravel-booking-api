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
        $locationDTO = $this->locationRepository->findByLocationCode($command->request->string('location_code')->toString());

        if (!$locationDTO) {
            throw new LocationNotFound($command->request->string('location_code')->toString());
        }

        $reservationDTO = (new ReservationDTO())
            ->setStartDate($command->request->date('start_date'))
            ->setEndDate($command->request->date('end_date'))
            ->setLocationDTO($locationDTO)
            ->setPersons($command->request->integer('persons'));

        $this->reservationService->validateReservationDetails($reservationDTO);

        $this->reservationService->createReservation($reservationDTO);
    }
}
