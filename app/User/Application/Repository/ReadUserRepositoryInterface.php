<?php

declare(strict_types=1);

namespace App\User\Application\Repository;

use App\User\Application\DTO\UserDTO;

interface ReadUserRepositoryInterface
{
    public function findUserById(int $id): ?UserDTO;
}
