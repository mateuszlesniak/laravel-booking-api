<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Repository\MySQL;

use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\Application\DTO\ReservationStatus;
use App\Reservation\Application\Mapper\ReservationMapper;
use App\Reservation\Domain\Repository\WriteReservationRepository as WriteReservationRepositoryInterface;
use App\Reservation\Domain\Repository\WriteReservationVacancyRepository as WriteReservationVacancyRepositoryInterface;
use App\Reservation\Infrastructure\Model\Reservation;
use App\Shared\Application\Repository\BaseRepository;
use Illuminate\Support\Facades\DB;

final class WriteReservationRepository extends BaseRepository implements WriteReservationRepositoryInterface
{
    public function __construct(
        private readonly WriteReservationVacancyRepositoryInterface $writeReservationVacancyRepository,
        private readonly ReservationMapper $reservationTransformer,
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

            $reservationDTO = $this->reservationTransformer->fromEntity($reservation);
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
