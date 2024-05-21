<?php

declare(strict_types=1);

namespace App\User\Application\Mapper;

use App\User\Application\DTO\UserDTO;
use App\User\Infrastructure\Model\User;

final class UserMapper
{
    public function fromEntity(User $user): UserDTO
    {
        return (new UserDTO())
            ->setId($user->id);
    }
}
