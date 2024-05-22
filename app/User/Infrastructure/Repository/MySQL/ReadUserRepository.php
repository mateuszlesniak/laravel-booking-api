<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Repository\MySQL;

use App\User\Application\Mapper\UserMapper;
use App\User\Domain\Model\User;
use App\User\Domain\Repository\ReadUserRepository as ReadUserRepositoryInterface;
use App\User\Infrastructure\Model\Eloquent\UserEntity;

class ReadUserRepository implements ReadUserRepositoryInterface
{
    public function __construct(
        private readonly UserMapper $transformer,
    ) {
    }

    #[\Override]
    public function findById(int $id): User
    {
        $user = UserEntity::whereId($id)->firstOrFail();

        return $this->transformer->fromEloquent($user);
    }
}
