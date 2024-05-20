<?php

namespace App\User\Application\Repository;

use App\User\Application\DTO\UserDTO;

interface ReadUserRepositoryInterface
{
    public function findUserById(int $id): ?UserDTO;
}
