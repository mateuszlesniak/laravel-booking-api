<?php

declare(strict_types=1);

namespace App\Location\Application\Mapper;

use App\Common\Domain\ValueObject\Date;
use App\Location\Domain\Model\Location;
use App\Location\Domain\Model\ValueObject\Address;
use App\Location\Domain\Model\ValueObject\Country;
use App\Location\Domain\Model\ValueObject\LocationCode;
use App\Location\Domain\Model\ValueObject\LocationVacancies;
use App\Location\Domain\Model\ValueObject\Name;
use App\Location\Infrastructure\Model\Eloquent\LocationEntity;
use App\Location\Infrastructure\Model\Eloquent\LocationVacancyEntity;

final readonly class LocationMapper
{
    public function __construct(
        private LocationVacancyMapper $vacancyMapper,
    ) {
    }

    public function fromEloquent(
        LocationEntity $entity,
        bool $withVacancies = false,
        ?Date $vacancyDateFrom = null,
        ?Date $vacancyDateTo = null,
    ): Location {
        $locationVacancies = [];

        if ($withVacancies) {
            $locationVacancies = $entity->vacancies();

            if ($vacancyDateFrom) {
                $locationVacancies->whereDate('date', '>=', $vacancyDateFrom->toDate()->toDateString());
            }

            if ($vacancyDateTo) {
                $locationVacancies->whereDate('date', '<=', $vacancyDateTo->toDate()->toDateString());
            }

            $locationVacancies = $locationVacancies->get()
                ->map(function (LocationVacancyEntity $vacancyEntity) {
                    return $this->vacancyMapper->fromEloquent($vacancyEntity);
                })
                ->toArray();
        }

        return new Location(
            id: $entity->id,
            name: new Name($entity->name),
            address: new Address($entity->address),
            country: new Country($entity->country),
            locationCode: new LocationCode($entity->location_code),
            vacancies: new LocationVacancies($locationVacancies),
            isActive: $entity->is_active,
        );
    }
}
