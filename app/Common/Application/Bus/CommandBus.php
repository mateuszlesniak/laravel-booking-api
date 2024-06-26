<?php

declare(strict_types=1);

namespace App\Common\Application\Bus;

use App\Common\Application\Bus\Command\Command;

interface CommandBus
{
    public function dispatch(Command $command): void;

    public function register(array $map): void;
}
