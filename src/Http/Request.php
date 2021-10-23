<?php

declare(strict_types=1);

namespace Dev\Support\Http;

use Dev\Support\Contracts\IRequest;

class Request implements IRequest
{
    private array $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * {@inheritDoc}
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * {@inheritDoc}
     */
    public function clear(): self
    {
        $this->items = [];

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $key, $default = null): mixed
    {
        return $this->items[$key] ?? $default;
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $key): bool
    {
        return isset($this->items[$key]);
    }

    /**
     * {@inheritDoc}
     */
    public function add(string $key, mixed $item): self
    {
        $this->items[$key] = $item;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function fill(array $items): self
    {
        $this->items = $items;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function remove(string $key): self
    {
        unset($this->items[$key]);

        return $this;
    }
}
