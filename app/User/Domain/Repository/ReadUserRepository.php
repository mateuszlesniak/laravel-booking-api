<?php

declare(strict_types=1);

namespace App\User\Domain\Repository;

use App\User\Domain\Model\User;

interface ReadUserRepository
{
    public function findById(int $id): User;
}
