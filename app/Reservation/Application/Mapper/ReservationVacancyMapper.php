<?php

declare(strict_types=1);

namespace App\Reservation\Application\Mapper;

use App\Common\Domain\ValueObject\Date;
use App\Location\Domain\Model\Entity\LocationVacancy;
use App\Reservation\Domain\Model\Entity\ReservationVacancy;
use App\Reservation\Infrastructure\Model\Eloquent\ReservationVacancyEntity;

final readonly class ReservationVacancyMapper
{
    public function fromEloquent(
        ReservationVacancyEntity $entity,
    ): ReservationVacancy {
        return new ReservationVacancy(
            vacancyId: $entity->vacancy->id,
            date: new Date($entity->vacancy->date->format('Y-m-d')),
            persons: $entity->persons,
        );
    }

    public function toEloquent(
        ReservationVacancy $reservationVacancy,
        ?ReservationVacancyEntity $entity = new ReservationVacancyEntity(),
    ): ReservationVacancyEntity {
        $entity->vacancy_id = $reservationVacancy->vacancyId;
        $entity->persons = $reservationVacancy->persons;

        return $entity;
    }

    public function fromLocationVacancy(
        LocationVacancy $locationVacancy,
        int $persons,
    ): ReservationVacancy {
        return new ReservationVacancy(
            vacancyId: $locationVacancy->id,
            date: $locationVacancy->date,
            persons: $persons,
        );
    }
}
