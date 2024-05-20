<?php

namespace App\User\Infrastructure\Repository\Transformer;

use App\User\Application\DTO\UserDTO;
use App\User\Infrastructure\Model\User;

final class UserTransformer
{
    public function createUserDTOFromEntity(
        User $user,
        ?UserDTO $userDTO = null): UserDTO
    {
        $userDTO = $userDTO ?? new UserDTO();

        $userDTO
            ->setId($user->id);

        return $userDTO;
    }
}
