<?php

declare(strict_types=1);

namespace App\Reservation\Application\UseCase\Command;

use App\Common\Application\Bus\Command\CommandHandler;
use App\Reservation\Application\Service\ReservationService;
use App\Reservation\Domain\Policy\ReservationPolicy;
use App\Reservation\Domain\Repository\WriteReservationRepository;

final readonly class StoreReservationCommandHandler implements CommandHandler
{
    public function __construct(
        private ReservationService $reservationService,
        private WriteReservationRepository $reservationRepository,
    ) {
    }

    public function handle(StoreReservationCommand $command): void
    {
        authorize('store', ReservationPolicy::class);
        $this->reservationService->validateReservation($command->reservation);
        $this->reservationRepository->store($command->reservation);
    }
}
