<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Repository;

abstract class BaseRepository
{
    protected array $filters = [];

    protected function setFilter(string $key, object $filter): self
    {
        $this->filters[$key] = $filter;

        return $this;
    }

    protected function getFilter(string $filterName): ?object
    {
        if (!array_key_exists($filterName, $this->filters)) {
            return null;
        }

        return $this->filters[$filterName];
    }

    protected function resetFilters(): void
    {
        $this->filters = [];
    }
}
