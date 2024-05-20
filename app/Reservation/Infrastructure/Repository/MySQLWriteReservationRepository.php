<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Repository;

use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\Application\DTO\ReservationStatus;
use App\Reservation\Application\Repository\WriteReservationRepositoryInterface;
use App\Reservation\Application\Repository\WriteReservationVacancyRepositoryInterface;
use App\Reservation\Infrastructure\Model\Reservation;
use App\Reservation\Infrastructure\Repository\Transformer\ReservationTransformer;
use App\Shared\Infrastructure\Repository\BaseRepository;
use Illuminate\Support\Facades\DB;

final class MySQLWriteReservationRepository extends BaseRepository implements WriteReservationRepositoryInterface
{
    public function __construct(
        private readonly WriteReservationVacancyRepositoryInterface $writeReservationVacancyRepository,
        private readonly ReservationTransformer $reservationTransformer,
        Reservation $model,
    ) {
        parent::__construct($model);
    }

    #[\Override]
    public function makeNewReservation(ReservationDTO $reservationDTO): ReservationDTO
    {
        DB::beginTransaction();

        try {
            $reservation = $this->model->create([
                'user_id' => 1,
                'location_id' => $reservationDTO->getLocationDTO()->getId(),
                'date_in' => $reservationDTO->getStartDate()->format('Y-m-d'),
                'date_out' => $reservationDTO->getEndDate()->format('Y-m-d'),
                'status' => ReservationStatus::PLACED,
            ]);

            $reservationDTO = $this->reservationTransformer->createReservationDTO($reservation, $reservationDTO);
            $reservationDTO = $this->writeReservationVacancyRepository
                ->createReservationVacancies($reservationDTO, $reservation);
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }

        DB::commit();

        return $reservationDTO;
    }
}
