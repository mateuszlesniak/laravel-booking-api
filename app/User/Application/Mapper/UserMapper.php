<?php

declare(strict_types=1);

namespace App\User\Application\Mapper;

use App\User\Domain\Model\User;
use App\User\Domain\Model\ValueObject\Email;
use App\User\Domain\Model\ValueObject\Name;
use App\User\Infrastructure\Model\Eloquent\UserEntity;

final class UserMapper
{
    public function fromEloquent(
        UserEntity $entity,
    ): User {
        return new User(
            id: $entity->id,
            name: new Name($entity->name),
            email: new Email($entity->email),
            isActive: true,
        );
    }
}
