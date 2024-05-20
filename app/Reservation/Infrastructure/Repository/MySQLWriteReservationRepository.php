<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Repository;

use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\Application\DTO\ReservationStatus;
use App\Reservation\Application\Repository\WriteReservationRepositoryInterface;
use App\Reservation\Infrastructure\Model\Reservation;
use App\Reservation\Infrastructure\Model\ReservationVacancy;
use App\Reservation\Infrastructure\Repository\Transformer\ReservationTransformer;
use Illuminate\Support\Facades\DB;

final readonly class MySQLWriteReservationRepository implements WriteReservationRepositoryInterface
{
    public function __construct(
        private ReservationTransformer $reservationTransformer
    ) {
    }

    #[\Override]
    public function makeNewReservation(ReservationDTO $reservationDTO): ReservationDTO
    {
        DB::beginTransaction();

        try {
            $reservationDTO = $this->createNewReservation($reservationDTO);
        } catch (\Exception $exception) {
            DB::rollBack();

            throw $exception;
        }

        DB::commit();

        return $reservationDTO;
    }

    private function createReservationVacancies(
        ReservationDTO $reservationDTO,
        Reservation $reservation,
    ): ReservationDTO {
        $datePeriod = new \DatePeriod(
            $reservationDTO->getStartDate(),
            new \DateInterval('P1D'),
            $reservationDTO->getEndDate(),
        );

        $reservationVacancies = [];
        foreach ($datePeriod as $date) {
            $reservationVacancy = ReservationVacancy::create([
                'reservation_id' => $reservation->id,
                'vacancy_id' => $reservation->location()->first()->vacancies()->where('date', $date)->first()->id,
                'persons' => $reservationDTO->getPersons(),
            ]);

            $reservationVacancies[] =
                $this->reservationTransformer->createReservationVacancyDTO($reservationVacancy);
        }

        $reservationDTO->setReservationVacancies($reservationVacancies);

        return $reservationDTO;
    }

    private function createNewReservation(ReservationDTO $reservationDTO): ReservationDTO
    {
        $reservation = Reservation::create([
            'user_id' => 1,
            'location_id' => $reservationDTO->getLocationDTO()->getId(),
            'date_in' => $reservationDTO->getStartDate()->format('Y-m-d'),
            'date_out' => $reservationDTO->getEndDate()->format('Y-m-d'),
            'status' => ReservationStatus::PLACED,
        ]);

        $reservationDTO = $this->reservationTransformer->createReservationDTO($reservation, $reservationDTO);
        $reservationDTO = $this->createReservationVacancies($reservationDTO, $reservation);

        return $reservationDTO;
    }
}
