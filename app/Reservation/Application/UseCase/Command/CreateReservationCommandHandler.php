<?php

declare(strict_types=1);

namespace App\Reservation\Application\UseCase\Command;

use App\Location\Application\Exception\LocationNotFound;
use App\Location\Application\Service\ReserveLocationService;
use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\Application\Service\ReservationService;
use App\Reservation\Domain\Exception\LocationVacancyNotAvailable;
use App\Shared\Application\Bus\Command\CommandHandler;

final readonly class CreateReservationCommandHandler implements CommandHandler
{
    public function __construct(
        private ReservationService $reservationService,
        private ReserveLocationService $reserveLocationService,
    )
    {
    }

    /**
     * @throws LocationVacancyNotAvailable
     * @throws LocationNotFound
     */
    public function handle(CreateReservationCommand $command): void
    {
        $locationDTO = $this->reserveLocationService->getLocationWithVacancies(
            $command->request->string('location_code')->toString(),
            $command->request->date('start_date'),
            $command->request->date('end_date'),
        );

        $reservationDTO = (new ReservationDTO())
            ->setStartDate($command->request->date('start_date'))
            ->setEndDate($command->request->date('end_date'))
            ->setLocationDTO($locationDTO)
            ->setPersons($command->request->integer('persons'));

        $this->reservationService->checkIfReservationBePlaced($reservationDTO);
        $this->reservationService->createReservation($reservationDTO);
    }
}
