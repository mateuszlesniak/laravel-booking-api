<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Application\Bus\Command\Command;
use App\Shared\Application\Bus\CommandBus;
use Illuminate\Bus\Dispatcher;

readonly class SynchronousCommandBus implements CommandBus
{
    public function __construct(
        protected Dispatcher $bus,
    ) {
    }

    #[\Override]
    public function dispatch(Command $command): void
    {
        $this->bus->dispatch($command);
    }

    #[\Override]
    public function register(array $map): void
    {
        $this->bus->map($map);
    }
}
