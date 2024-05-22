<?php

declare(strict_types=1);

namespace App\Location\Domain\Repository;

use App\Common\Domain\ValueObject\Date;
use App\Location\Domain\Model\Location;
use App\Location\Domain\Model\ValueObject\LocationCode;
use Illuminate\Support\Collection;

interface ReadLocationRepository
{
    public function findAll(): Collection;

    public function findByLocationCode(
        LocationCode $locationCode,
        bool $withVacancies = false,
        ?Date $dateFrom = null,
        ?Date $dateTo = null,
    ): Location;
}
