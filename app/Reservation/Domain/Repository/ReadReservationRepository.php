<?php

declare(strict_types=1);

namespace App\Reservation\Domain\Repository;

use App\Common\Domain\ValueObject\Date;
use App\User\Domain\Model\User;
use Illuminate\Support\Collection;

interface ReadReservationRepository
{
    public function filterDateFrom(Date $dateFrom): self;

    public function filterDateTo(Date $dateTo): self;

    public function filterUser(User $user): self;

    public function findAll(): Collection;
}
