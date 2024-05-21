<?php

namespace App\Location\Application\Service;

use App\Location\Application\DTO\LocationDTO;
use App\Location\Application\Exception\LocationNotFound;
use App\Location\Domain\Repository\ReadLocationRepository;
use App\Location\Domain\Repository\ReadLocationVacancyRepository;
use DateTimeInterface;

final readonly class ReserveLocationService
{

    public function __construct(
        private ReadLocationRepository $locationRepository,
        private ReadLocationVacancyRepository $locationVacancyRepository,
    )
    {
    }

    public function getLocationWithVacancies(
        string $locationCode,
        DateTimeInterface $startDate,
        DateTimeInterface $endDate,
    ): LocationDTO
    {
        $locationDTO = $this->locationRepository->findByLocationCode($locationCode);

        if (!$locationDTO) {
            throw new LocationNotFound($locationCode);
        }

        $locationVacancyDTOs = $this->locationVacancyRepository->findBetweenDates(
            $locationDTO->getId(),
            $startDate,
            $endDate,
        );

        $locationDTO->setVacancies($locationVacancyDTOs->toArray());

        return $locationDTO;
    }
}
