<?php

declare(strict_types=1);

namespace App\Location\Domain\Repository;

use DateTimeInterface;
use Illuminate\Support\Collection;

interface ReadLocationVacancyRepository
{
    public function findBetweenDates(
        int $locationId,
        DateTimeInterface $startDate,
        DateTimeInterface $endDate,
    ): Collection;
}
