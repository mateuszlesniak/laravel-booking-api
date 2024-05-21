<?php

declare(strict_types=1);

namespace App\Reservation\Infrastructure\Repository\MySQL;

use App\Reservation\Application\DTO\ReservationDTO;
use App\Reservation\Application\Mapper\ReservationVacancyTransformer;
use App\Reservation\Domain\Repository\WriteReservationVacancyRepository as WriteReservationVacancyRepositoryInterface;
use App\Reservation\Infrastructure\Model\Reservation;
use App\Reservation\Infrastructure\Model\ReservationVacancy;
use App\Shared\Application\Repository\BaseRepository;

final class WriteReservationVacancyRepository extends BaseRepository implements WriteReservationVacancyRepositoryInterface
{
    public function __construct(
        private readonly ReservationVacancyTransformer $reservationVacancyTransformer,
        ReservationVacancy $model,
    ) {
        parent::__construct($model);
    }

    public function createReservationVacancies(
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
            $reservationVacancy = $this->model->create([
                'reservation_id' => $reservation->id,
                'vacancy_id' => $reservation->location()->first()->vacancies()->where('date', $date)->first()->id,
                'persons' => $reservationDTO->getPersons(),
            ]);

            $reservationVacancies[] =
                $this->reservationVacancyTransformer->fromEntity($reservationVacancy);
        }

        $reservationDTO->setReservationVacancies($reservationVacancies);

        return $reservationDTO;
    }
}
