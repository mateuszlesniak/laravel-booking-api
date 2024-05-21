<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Repository\MySQL;

use App\User\Application\DTO\UserDTO;
use App\User\Application\Mapper\UserMapper;
use App\User\Domain\Repository\ReadUserRepository as ReadUserRepositoryInterface;
use App\User\Infrastructure\Model\User;

class ReadUserRepository implements ReadUserRepositoryInterface
{
    public function __construct(
        private readonly UserMapper $transformer,
    ) {
    }

    #[\Override]
    public function findUserById(int $id): ?UserDTO
    {
        $user = User::whereId($id)->first();

        if (!$user) {
            return null;
        }

        return $this->transformer->fromEntity($user);
    }
}
