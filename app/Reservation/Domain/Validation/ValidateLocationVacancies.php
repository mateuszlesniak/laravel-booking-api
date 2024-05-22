<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Validation;

use App\Location\Domain\Model\Entity\LocationVacancy;
use App\Location\Domain\Repository\ReadLocationRepository;
use App\Reservation\Application\Mapper\ReservationVacancyMapper;
use App\Reservation\Domain\Exception\LocationVacancyNotAvailable;
use App\Reservation\Domain\Model\Entity\ReservationVacancy;
use App\Reservation\Domain\Model\Reservation;
use App\Reservation\Domain\Repository\ReadReservationRepository;
use Illuminate\Support\Collection;

readonly class ValidateLocationVacancies implements ReservationValidationStrategy
{
    public function __construct(
        private ReadLocationRepository $locationRepository,
        private ReadReservationRepository $reservationRepository,
        private ReservationVacancyMapper $reservationVacancyMapper,
    ) {
    }

    #[\Override]
    public function validate(Reservation $reservation): void
    {
        $locationWithVacancies = $this->locationRepository
            ->restrictDates($reservation->dateIn->toDate(), $reservation->dateOut->toDate())
            ->findByLocationCode($reservation->location->value);

        $existingReservations = $this->reservationRepository
            ->restrictDates($reservation->dateIn->toDate(), $reservation->dateOut->toDate())
            ->findAll();

        foreach ($locationWithVacancies->vacancies->toArray() as $vacancy) {
            $reservation->reservationVacancies->add(
                $this->reservationVacancyMapper->fromLocationVacancy($vacancy, $reservation->persons)
            ); // should be extracted to another class, here should be only check

            if ($this->calculateFreeSlots($vacancy, $existingReservations) < $reservation->persons) {
                throw new LocationVacancyNotAvailable();
            }
        }
    }

    /**
     * @param Collection|Reservation[] $reservations
     */
    private function calculateFreeSlots(LocationVacancy $vacancy, Collection $reservations): int
    {
        $filteredReservationsVacancies = [];

        foreach ($reservations as $reservation) {
            foreach ($reservation->reservationVacancies as $reservationVacancy) {
                if ($reservationVacancy->date->toDate()->isSameAs('Y-m-d', $vacancy->date->toDate())) {
                    $filteredReservationsVacancies[] = $reservationVacancy;
                }
            }
        }

        $occupiedSlots = 0;

        array_walk($filteredReservationsVacancies,
            function (ReservationVacancy $reservationVacancy) use (&$occupiedSlots) {
                $occupiedSlots += $reservationVacancy->persons;
            }
        );

        return $vacancy->slots - $occupiedSlots;
    }
}
