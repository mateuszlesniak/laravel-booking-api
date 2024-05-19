<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Bus;

use App\Shared\Application\Bus\Query\Query;
use App\Shared\Application\Bus\QueryBus;
use Illuminate\Bus\Dispatcher;

readonly class SynchronousQueryBus implements QueryBus
{
    public function __construct(
        protected Dispatcher $bus,
    ) {
    }

    #[\Override]
    public function query(Query $query): void
    {
        $this->bus->dispatch($query);
    }

    #[\Override]
    public function register(array $map): void
    {
        $this->bus->map($map);
    }
}
