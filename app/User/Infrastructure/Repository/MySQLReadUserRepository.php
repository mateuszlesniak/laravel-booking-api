<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Repository;

use App\User\Application\DTO\UserDTO;
use App\User\Application\Repository\ReadUserRepositoryInterface;
use App\User\Infrastructure\Model\User;
use App\User\Infrastructure\Repository\Transformer\UserTransformer;

class MySQLReadUserRepository implements ReadUserRepositoryInterface
{
    public function __construct(
        private readonly UserTransformer $transformer,
    ) {
    }

    #[\Override]
    public function findUserById(int $id): ?UserDTO
    {
        $user = User::whereId($id)->first();

        if (!$user) {
            return null;
        }

        return $this->transformer->createUserDTOFromEntity($user);
    }
}
