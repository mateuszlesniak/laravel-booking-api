<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Http;

final readonly class JsonResponseData implements \JsonSerializable
{
    private function __construct(
        private mixed $data = null,
        private ?\Exception $error = null,
        private bool $isError = false,
    ) {
    }

    public static function fromException(\Exception $exception): self
    {
        return new self(
            null,
            $exception,
            true,
        );
    }

    public static function withData(mixed $data): self
    {
        return new self(
            $data,
        );
    }

    #[\Override]
    public function jsonSerialize(): array
    {
        if ($this->isError) {
            return [
                'error' => $this->isProductionEnv() || !$this->error ? true : get_class($this->error),
                'errorMessage' => $this->error?->getMessage(),
            ];
        }

        return [
            'data' => $this->data,
        ];
    }

    private function isProductionEnv(): bool
    {
        return 'production' === config('app.env');
    }
}
