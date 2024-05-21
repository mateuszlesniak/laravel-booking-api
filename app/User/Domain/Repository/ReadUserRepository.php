<?php

declare(strict_types=1);

namespace App\User\Domain\Repository;

use App\User\Application\DTO\UserDTO;

interface ReadUserRepository
{
    public function findUserById(int $id): ?UserDTO;
}
