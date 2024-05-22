<?php

declare(strict_types=1);

namespace App\Location\Domain\Repository;

use App\Location\Domain\Model\Location;
use Illuminate\Support\Collection;

interface ReadLocationRepository
{
    public function findAll(): Collection;

    public function findByLocationCode(string $locationCode): Location;

    public function restrictDates(\DateTimeInterface $dateFrom, \DateTimeInterface $dateTo): self;
}
