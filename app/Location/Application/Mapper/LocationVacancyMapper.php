<?php

declare(strict_types=1);

namespace App\Location\Application\Mapper;

use App\Location\Application\DTO\VacancyDTO;
use App\Location\Domain\Model\Entity\LocationVacancy;
use App\Location\Infrastructure\Model\Eloquent\LocationVacancyEntity;
use App\Reservation\Domain\Model\ValueObject\Date;

class LocationVacancyMapper
{
    public function fromEntity(LocationVacancyEntity $vacancy): VacancyDTO
    {
        return (new VacancyDTO())
            ->setId($vacancy->id)
            ->setDate(new \DateTimeImmutable($vacancy->date))
            ->setSlots($vacancy->slots);
    }

    public function fromEloquent(
        LocationVacancyEntity $entity
    ): LocationVacancy {
        return new LocationVacancy(
            id: $entity->id,
            date: new Date($entity->date->format('Y-m-d')),
            slots: $entity->slots,
        );
    }
}
