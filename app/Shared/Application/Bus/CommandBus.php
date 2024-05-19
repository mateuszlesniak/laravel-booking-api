<?php

declare(strict_types=1);

namespace App\Shared\Application\Bus;

use App\Shared\Application\Bus\Command\Command;

interface CommandBus
{
    public function dispatch(Command $command): void;

    public function register(array $map): void;
}
