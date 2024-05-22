<?php

declare(strict_types=1);

namespace App\Location\Application\Mapper;

use App\Common\Domain\ValueObject\Date;
use App\Location\Domain\Model\Entity\LocationVacancy;
use App\Location\Infrastructure\Model\Eloquent\LocationVacancyEntity;

class LocationVacancyMapper
{
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
