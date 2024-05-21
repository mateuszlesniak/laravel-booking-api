<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Bus\Command;

use App\Location\Application\Exception\LocationNotFound;
use App\Location\Domain\Repository\ReadLocationRepository;
use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\Application\Exception\InsufficientSpaceException;
use App\Reservation\Application\Service\ReservationService;
use App\Shared\Application\Bus\Command\CommandHandler;

final readonly class CreateReservationCommandHandler implements CommandHandler
{
    public function __construct(
        private ReservationService $reservationService,
        private ReadLocationRepository $locationRepository,
    ) {
    }

    /**
     * @throws InsufficientSpaceException
     * @throws LocationNotFound
     */
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

        if (!$this->reservationService->canReservationBePlaced($reservationDTO)) {
            throw new InsufficientSpaceException();
        }

        $this->reservationService->createReservation($reservationDTO);
    }
}
