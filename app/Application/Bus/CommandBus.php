<?php

declare(strict_types=1);

namespace App\Application\Bus;

interface CommandBus
{
    public function dispatch(Command $command): void;

    public function register(array $map): void;
}
