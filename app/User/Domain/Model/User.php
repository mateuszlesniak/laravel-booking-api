<?php

declare(strict_types=1);

namespace App\User\Domain\Model;

use App\Common\Domain\AggregateRoot;
use App\User\Domain\Model\ValueObject\Email;
use App\User\Domain\Model\ValueObject\Name;

class User extends AggregateRoot
{
    public function __construct(
        public readonly ?int $id,
        public readonly Name $name,
        public readonly Email $email,
        public readonly bool $isActive = true,
    ) {
    }

    #[\Override]
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'is_active' => $this->isActive,
        ];
    }
}
